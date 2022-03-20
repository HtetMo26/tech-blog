<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class VerificationController extends Controller
{
    public function verifyMail(Request $request) {

        $key = $request->key;
        $id = $request->id;
        $real_key = User::find($id)->verified_key;
        $userId = $id;

        if ($key == $real_key) {
            User::find($id)->update(['is_verified' => '1']);
            return redirect('login')->with('success', 'Your account is verified successfully!');
        }      
        else {
            return view('verification', compact('userId'))->with('error', 'The verification number is incorrect. Try again!');
        }      
    }
}
