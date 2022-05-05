<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
  public function redirectToFacebook()  {

return Socialite::driver('facebook')->redirect();
  }

  public function callbackToFacebook() {
try {
    $facebookUser = Socialite::driver('facebook')->user();

   $findUser = User::where('fb_id', $facebookUser->id)->first();

   if ($findUser) {
       Auth::login($findUser);
       return redirect()->intended('dashboard');
   } else {
       $newUser = User::create([
           'name' => $facebookUser->name,
           'email' => $facebookUser->email,
           'fb_id' => $facebookUser->id,
'password' => encrypt('12345656'),

       ]);
       Auth::login($newUser);
       return redirect()->intended('dashboard');

   }
} catch (Exception $e) {
    dd($e->getMessage());
}
  }


   public function redirectToGithub()  {

return Socialite::driver('github')->redirect();
  }

  public function callbackToGithub() {
try {
    $githubUser = Socialite::driver('github')->user();

   $findUser = User::where('gh_id', $githubUser->id)->first();

   if ($findUser) {
       Auth::login($findUser);
       return redirect()->intended('dashboard');
   } else {
       $newUser = User::create([
           'name' => $githubUser->name,
           'email' => $githubUser->email,
           'fb_id' => $githubUser->id,
'password' => encrypt('12345656'),

       ]);
       Auth::login($newUser);
       return redirect()->intended('dashboard');

   }
} catch (Exception $e) {
    dd($e->getMessage());
}
  }

}
