<?php

namespace App\Http\Controllers\Frontend;

use App\Models\WebUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('frontend.login');
    }

    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider String
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider string
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     * @throws \Exception
     */
    public function handleProviderCallback($provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->user();
        } catch (\Throwable | \Exception $e) {
            // Send actual error message in development
            if (config('app.debug')) {
                throw $e;
            }
            // Lets suppress this error
            return redirect()->route('login')
                ->with('error', __('Unable to authenticate. Please try again.'));
        }
        $user = $this->findOrCreateUser($provider, $providerUser);
        Auth::loginUsingId($user->id, true);
        if (strpos(\Session::get('url.intended', url('/')), 'home') !== false) {
            return redirect('/');
        }
        return redirect()->intended('/');
    }

    /**
     * Create a user if does not exist
     *
     * @param $providerName string
     * @param $providerUser
     * @return mixed
     */
    protected function findOrCreateUser($providerName, $providerUser)
    {
        $user = WebUser::where([
            'email' => $providerUser->email
        ])->first();
        if (!$user) {
            $user = new WebUser();
            $user->provider = $providerName;
            $user->provider_id = $providerUser->id;
        }
        $user->email = $providerUser->email;
        $user->name = $providerUser->name;
        $user->avatar = $this->saveAvatar($providerUser);
        $user->save();
        return $user;
    }

    /**
     * @param $user
     * @return string
     */
    protected function saveAvatar($user)
    {
        $fileContents = file_get_contents($user->getAvatar());
        File::put(public_path() . '/uploads/profile/' . $user->getId() . ".jpg", $fileContents);
        return 'uploads/profile/' . $user->getId() . ".jpg";
    }

    /**
     * @param Request $request
     * @return string
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('frontend.home');
    }
}