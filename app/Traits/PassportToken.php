<?php

namespace App\Traits;

use App\Models\User;
use DateTime;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Events\Dispatcher;
use Laravel\Passport\Bridge\AccessToken;
use Laravel\Passport\Bridge\AccessTokenRepository;
use Laravel\Passport\Bridge\Client;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Passport;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;
use League\OAuth2\Server\ResponseTypes\BearerTokenResponse;
use GuzzleHttp\Client as TokenClient;

# https://github.com/laravel/passport/issues/71

/**
 * Trait PassportToken
 *
 * @package App\Traits
 */
trait PassportToken
{
    /**
     * Generate a new unique identifier.
     *
     * @param int $length
     *
     * @throws OAuthServerException
     *
     * @return string
     */
    private function generateUniqueIdentifier($length = 40)
    {
        try {
            return bin2hex(random_bytes($length));
            // @codeCoverageIgnoreStart
        } catch (\TypeError $e) {
            throw OAuthServerException::serverError('An unexpected error has occurred');
        } catch (\Error $e) {
            throw OAuthServerException::serverError('An unexpected error has occurred');
        } catch (\Exception $e) {
            // If you get this message, the CSPRNG failed hard.
            throw OAuthServerException::serverError('Could not generate a random string');
        }
        // @codeCoverageIgnoreEnd
    }

    private function issueRefreshToken(AccessTokenEntityInterface $accessToken)
    {
        $maxGenerationAttempts = 10;
        $refreshTokenRepository = app(RefreshTokenRepository::class);

        $refreshToken = $refreshTokenRepository->getNewRefreshToken();
        $refreshToken->setExpiryDateTime((new \DateTime())->add(Passport::refreshTokensExpireIn()));
        $refreshToken->setAccessToken($accessToken);

        while ($maxGenerationAttempts-- > 0) {
            $refreshToken->setIdentifier($this->generateUniqueIdentifier());
            try {
                $refreshTokenRepository->persistNewRefreshToken($refreshToken);

                return $refreshToken;
            } catch (UniqueTokenIdentifierConstraintViolationException $e) {
                if ($maxGenerationAttempts === 0) {
                    throw $e;
                }
            }
        }
    }

    protected function createPassportTokenByUser(User $user, $clientId)
    {
        $accessToken = new AccessToken($user->id);
        $accessToken->setIdentifier($this->generateUniqueIdentifier());
        $accessToken->setClient(new Client($clientId, null, null));
        $accessToken->setExpiryDateTime((new DateTime())->add(Passport::tokensExpireIn()));

        $accessTokenRepository = new AccessTokenRepository(new TokenRepository(), new Dispatcher());
        $accessTokenRepository->persistNewAccessToken($accessToken);
        $refreshToken = $this->issueRefreshToken($accessToken);

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ];
    }

    protected function sendBearerTokenResponse($accessToken, $refreshToken)
    {
        $response = new BearerTokenResponse();
        $response->setAccessToken($accessToken);
        $response->setRefreshToken($refreshToken);

        $privateKey = new CryptKey('file://' . Passport::keyPath('oauth-private.key'), null, false);

        $response->setPrivateKey($privateKey);
        $response->setEncryptionKey(app('encrypter')->getKey());

        return $response->generateHttpResponse(new Response);
    }

    /**
     * @param \App\Entities\User $user
     * @param $clientId
     * @param bool $output default = true
     * @return array | \League\OAuth2\Server\ResponseTypes\BearerTokenResponse
     */
    protected function getBearerTokenByUser(User $user, $clientId, $output = true)
    {
        $passportToken = $this->createPassportTokenByUser($user, $clientId);
        $bearerToken = $this->sendBearerTokenResponse($passportToken['access_token'], $passportToken['refresh_token']);

        if (!$output) {
            $bearerToken = json_decode($bearerToken->getBody()->__toString(), true);
        }

        return $bearerToken;
    }

    protected function refreshAccessToken($token)
    {
        $http = new TokenClient();
        try {
            $response = $http->post(config('app.url') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $token,
                    'client_id' => 15,
                    'client_secret' => '8L4e9HSYNrI5NyJ16w4ksR85gScrA9m7AMaIKlQi',
                    'scope' => '',
                ],
            ]);
            $response = json_decode((string)$response->getBody(), true);
            $data = [
                'access_token' => $response['access_token'],
                'refresh_token' => $response['refresh_token']
                ];
            $res = [
                'success' => true,
                'data' => $data,
                'message' => 'Token refreshed successfully.'
            ];
            return response()->json($res, 200);
        } catch (ClientException $e) {
            $res = [
                'success' => false,
                'message' => 'The refresh token is invalid.'
            ];
            if (!empty($data)) {
                $res['data'] = $data;
            }
            return response()->json($res, 401);
        }
    }
}