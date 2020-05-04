<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Kawankoding\Fcm\Fcm;


/**
 * @OA\Info(
 *     description="This is a sample Petstore server.  You can find
out more about Swagger at
[http://swagger.io](http://swagger.io) or on
[irc.freenode.net, #swagger](http://swagger.io/irc/).",
 *     version="1.0.0",
 *     title="Swagger Petstore",
 *     termsOfService="http://swagger.io/terms/",
 *     @OA\Contact(
 *         email="apiteam@swagger.io"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

/**
 * Class ApiController
 *
 * @package App\Http\Controllers
 *
 * @SWG\Swagger(
 *     basePath="",
 *     host="laravel.localhost",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0",
 *         title="Sample API",
 *         @SWG\Contact(name="Marco Raddatz", url="https://www.marcoraddatz.com"),
 *     ),
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\JsonResponse
 *
 * @SWG\Get(
 *     path="/api/dashboard",
 *     description="Returns dashboard overview.",
 *     operationId="api.dashboard.index",
 *     produces={"application/json"},
 *     tags={"dashboard"},
 *     @SWG\Response(
 *         response=200,
 *         description="Dashboard overview."
 *     ),
 *     @SWG\Response(
 *         response=401,
 *         description="Unauthorized action.",
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
//        if (Auth::check()) {
//            $findImage = User::find(Auth::id());
//            View::share('findImage', $findImage);
//        }
    }

    /**
     * @return mixed
     */
    public function getCurrentCountryCode()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $dataArray = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        return $dataArray->geoplugin_countryCode;
    }

    /**
     * @param $id
     * @return string
     * Encrypt data
     */
    public function encrypt($data)
    {
        return Crypt::encrypt($data);
    }

    /**
     * @param $id
     * @return string|void
     * Decrypt data
     */
    public function decrypt($data)
    {
        try {
            $decrypted = Crypt::decrypt($data);
            return $decrypted;
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * @param $string
     * @return string
     */
    public function encryptToBase64($string)
    {
        return base64_encode($string);
    }

    /**
     * @param $string
     * @return bool|string
     */
    public function decryptFromBase64($string)
    {
        return base64_decode($string);
    }

    /**
     * @param string $message
     * @param mixed $data
     *
     * @return array
     */
    public function makeResponse($message = '', $data = [], $code = '')
    {
        $res = [
            'success' => true,
            'data' => $data,
            'message' => $message
        ];
        return response()->json($res, $code);
    }

    /**
     * @param string $message
     * @param array $data
     *
     * @return array
     */
    public function makeError($message = '', array $data = [], $code = '')
    {
        $res = [
            'success' => false,
            'message' => $message
        ];
        if (!empty($data)) {
            $res['data'] = $data;
        }
        return response()->json($res, $code);
    }

    /**
     * @param $path
     * @param $content
     * @return string
     */
    public function saveBase64File($path, $content)
    {
        $filename = time();
        $fileContents = file_get_contents($content);
        File::put(public_path() . $path . $filename . ".jpg", $fileContents);
        return $path . $filename . ".jpg";
    }

    /**
     * @param $phone
     * @return array
     */
    public function setNumber($phone, $cid)
    {
        $countryId = $cid;
        $number = $phone;
        if ($phone[0] == '+') {
            try {
                $phone = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $phone);
                $parseNumber = PhoneNumber::parse('+' . $phone);
                $number = $parseNumber->getNationalNumber();
                $code = $parseNumber->getCountryCode();
                $country = Country::where('code', $code)->first();
                if ($country) {
                    $countryId = $country->id;
                }
            } catch (PhoneNumberException $e) {
                return ['cid' => $countryId, 'phone' => $number];
            }
        } else {
            $number = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $phone);
        }
        return ['cid' => $countryId, 'phone' => $number];
    }

    /**
     * @param $tokens
     * @param $title
     * @param $body
     * @param array $data
     * @return bool
     */
    public function sendPushNotification($tokens, $title, $body, $data = [])
    {
        $fcm = new Fcm();
        try {
            if (empty($data) || count($data) == 0) {
                $fcm->to($tokens)
                    ->notification([
                        'title' => $title,
                        'body' => $body
                    ])->send();
            } else {
                $fcm->to($tokens)
                    ->data($data)
                    ->notification([
                        'title' => $title,
                        'body' => $body
                    ])->send();
            }
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
