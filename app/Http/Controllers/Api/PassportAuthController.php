<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Installer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Auth;
class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $userId = $user->id;
        $token = $user->createToken('LaravelAuthApp')->accessToken;
 
        return response()->json(['token' => $token], 200);
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {	
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $response = array();

        if (auth()->attempt($data)) {
            $user_request = array('email'=>$request->email,'password'=>$request->password);       
                        $tokens = $this->generate_tokens($user_request);  

                        if(count($tokens) > 0)
                        {
                            $access_token = $tokens['access_token']; 
                            $refresh_token = $tokens['refresh_token']; 
                            $expires_in = $tokens['expires_in']; 

                            $response = array('access_token'=>$access_token,'refresh_token'=>$refresh_token,'expires_in'=>$expires_in);
                        }

            return response()->json($response, 200); 
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    } 

     public function installer_login(Request $request)
    {       
        $installer_count = Installer::where('email',$request->email)->count();

        if($installer_count < 1)
        {
            return response()->json(['status'=>404,'message' => 'Installer Not Found'], 404);
        }

        $platform_type = request()->header('platform-type');
        $os_version = request()->header('os-version');
        $application_version = request()->header('application-version');
        
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $response = array();

        if (auth()->attempt($data)) {

            $user_update_header = array('platform_type'=>$platform_type,'os_version'=>$os_version,'application_version'=>$application_version);

           $installer =  Installer::where('email',$request->email)->update($user_update_header);
           $installer =  Installer::where('email',$request->email)->first();

           
            $user_request = array('email'=>$request->email,'password'=>$request->password);       
                        $tokens = $this->generate_tokens($user_request);  

                        if(count($tokens) > 0)
                        {
                            $access_token = $tokens['access_token']; 
                            $refresh_token = $tokens['refresh_token']; 
                            $expires_in = $tokens['expires_in']; 

                            $response = array('installer'=>$installer,'access_token'=>$access_token,'expires_in'=>$expires_in);
                            return response()->json($response, 200); 
                        }
                        else
                        {
                            return response()->json(['status'=>400,'message' => 'Something Went Wrong'], 400); 
                        }

            
        } else {
            return response()->json(['status'=>401,'message' => 'Username Or Password Incorrect'], 401);
        }
    } 


     public function generate_tokens($user)
 {

    // $http = new \GuzzleHttp\Client;
    $password = Hash::make($user['password']); 
    $response = Http::asForm()->post('http://103.101.59.95/dev_techno_forms/public/oauth/token', [
            'grant_type' => 'password', 
            'client_id' => 3,
            'client_secret' => 'UaxQUIiYQHtAmzmjTApiiG3m8W2gmUe1QdEa9pRp	',
            'username' => $user['email'],
            'password' => $user['password'],
            'scope' => '',
        ]); 

    $return = json_decode($response->getBody(), true);

    $response = array();
    if(count($return) > 0)
    {
      $response = $return;  
    }
    return $response;
 }




  public function generate_auth_token_using_refresh_token(Request $request)
 {

   

    $refresh_token = $request->refresh_token; 

    

    $response2 = Http::asForm()->post('http://103.101.59.95/dev_techno_forms/public/oauth/token', [
        'grant_type' => 'refresh_token',
        'refresh_token' => $refresh_token,
        'client_id' => 4,
        'client_secret' => '4NYdyiIiMHk020rllfM8cM5MOqO2sAgRNAz66dhV',
        'scope' => '',
    ]); 
 

     $return = json_decode($response2->getBody(), true);

     echo "<pre>";
     print_r($return);
     echo "</pre>";
     exit();

    $response2 = array('access_token'=>$return['access_token'],'refresh_token'=>$return['refresh_token'],'expires_in'=>$return['expires_in']);
    
    return $this->sendResponse('200','Token Generated Successfully',$response2);
 }


public function api_logout(){  

	if (!isset(Auth::guard('api')->user()->id)) {
        return response()->json(['status'=>400,'message' => 'You must be logged in to Logout'], 400); 
    }

    if (Auth::check()) {
        Auth::user()->token()->revoke();
        return response()->json(['status'=>200,'message' =>'Logged Out Successfully'],200); 
    }else{
        return response()->json(['status'=>500,'message' =>'something went wrong'], 500);
    }
}


}