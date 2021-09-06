<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;




class AuthController extends Controller
{


	public function forgot_password(Request $request)
	{  
        $email = $request->email;
        $user_count = User::where('email',$email)->count();

        if($user_count > 0)
        {
            $credentials = request()->validate(['email' => 'required|email']);

            Password::sendResetLink($credentials);

            return response()->json(['status'=>200,'message' => 'Reset password link sent on your email id.'], 200);
        }
        else
        {
            return response()->json(['status'=>404,'message' => 'User Not Found.'], 404); 
        }
        
	}

	public function change_password(Request $request)
{
    if (!isset(Auth::guard('api')->user()->id)) {
        return response()->json(['status'=>400,'message' => 'You must be logged in to change password'], 400); 
    }
    $input = $request->all();
    $userid = Auth::guard('api')->user()->id;
    $rules = array(
        'old_password' => 'required',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
    );
    $validator = Validator::make($input, $rules);
    if ($validator->fails()) {
        return response()->json(['status'=>400,'message' => $validator->errors()->first()], 400); 
    } else {
        try {
            if ((Hash::check(request('old_password'), Auth::guard('api')->user()->password)) == false) {
                return response()->json(['message' => 'Check your old password.'], 400); 

            } else if ((Hash::check(request('new_password'), Auth::guard('api')->user()->password)) == true) {
                return response()->json(["status" => 400,'message' => 'Please enter a password which is not similar then current password.'], 400); 
            } else {
                User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                return response()->json(["status" => 200,'message' => 'Password updated successfully.'], 200); 
            }
        } catch (\Exception $ex) {
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            } else {
                $msg = $ex->getMessage();
            }
            return response()->json(["status" => 400,'message' => $msg], 400);
        }
    }
}


}
