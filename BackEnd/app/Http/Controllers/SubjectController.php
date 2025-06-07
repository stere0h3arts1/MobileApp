<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
   /**
     * User registration
     */
    public function register(Request $request){
        $user = new User;
		$user->username = $request->username;
		// $user->password = bcrypt($request->password);
        $user->password = Hash::make($request->password);
		$user->fullname = $request->fullname;
        $user->token = '';
		$user->save();
		return response()->json([
			'msg' => 'User successfully register.'
		], 200);
    }

    /**
     * User login
     */
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $user = User::where('username', $username)->first();
        if($user){
            if ($password && Hash::check($password, $user->password)) {
                $token = bin2hex(random_bytes(8));
                $user->token = $token;
                $user->save();
                return response()->json([
                    'token' => $token
                ], 200);
            }
            else {
                return response()->json([
                    'msg' => 'Access Denied.'
                ], 400);
            }    
        }
        else {
            return response()->json([
                'msg' => 'Access Denied.'
            ], 400);
        }
    }

    /**
     * User logout
     */
    public function logout(Request $request){
        $tokenh = $request->bearerToken();
        if($tokenh){
            $token = $request->token;
            if($tokenh == $token){
                $user = User::where('token', $token)->first();
                if($user){
                    $user->token = '';
                    $user->save();
                    return response()->json([
                        'msg' => 'Thank you.'
                    ], 200);
                }
                else {
                    return response()->json([
                        'msg' => 'Access Denied'
                    ], 400);
                }
            }
            else{
                return response()->json([
                    'msg' => 'Invalid Token.'
                ], 400);
            }
        }
        else {
            return response()->json([
                'msg' => 'No Token Provided.'
            ], 400);
        }
    }

    /**
     * Product create
     */
    public function create(Request $request){
        $token = $request->bearerToken();
        if($token){
            $user = User::where('token', $token)->first();
            if($user){
                $subject = new Subject();
                $subject->subject_code = $request->input('subject_code');
                $subject->description = $request->input('description');
                $subject->units = $request->input('units');
                $subject->save();
                return response()->json([
                    'msg' => 'New product was successfully saved.'
                ], 201);
            }
            else {
                return response()->json([
                    'msg' => 'Invalid Token.'
                ], 400);
            }
        }
        else {
            return response()->json([
                'msg' => 'No Token Provided.'
            ], 400);
        }
    }

    /**
     * Product read
     */
    public function read(Request $request){
        $token = $request->bearerToken();
        if($token){
            $user = User::where('token', $token)->first();
            if($user){
                $subjects = Subject::all();
                return response()->json($subjects, 200);
            }
            else {
                return response()->json([
                    'msg' => 'Invalid Token.'
                ], 400);
            }
        }
        else {
            return response()->json([
                'msg' => 'No Token Provided.'
            ], 400);
        }
    }

    /**
     * Product read by id
     */
    public function read_id(Request $request, $id){
        $token = $request->bearerToken();
        if($token){
            $user = User::where('token', $token)->first();
            if($user){
                $subjects = Subject::find($id);
                if($subjects){
                    return response()->json($subjects, 200);
                }
                else {
                    return response()->json([
                        'msg' => 'Subject not found.'
                    ], 400);
                }
            }
            else {
                return response()->json([
                    'msg' => 'Invalid Token.'
                ], 400);
            }
        }
        else {
            return response()->json([
                'msg' => 'No Token Provided.'
            ], 400);
        }
    }

    /**
     * Product delete
     */
    public function destroy(Request $request){
        $token = $request->bearerToken();
        if($token){
            $user = User::where('token', $token)->first();
            if($user){
                $sub_id = $request->sub_id;
                $subject = Subject::find($sub_id);
                if ($subject) {
                    $subject->delete();
                    return response()->json([
                        'msg' => 'Product was successfully deleted.'
                    ], 200);
                } else {
                    return response()->json([
                        'msg' => 'Subject not found.'
                    ], 404);
                }
            }
            else {
                return response()->json([
                    'msg' => 'Invalid Token.'
                ], 400);
            }
        }
        else {
            return response()->json([
                'msg' => 'No Token Provided.'
            ], 400);
        }
    }

    /**
     * Product update
     */
    public function update(Request $request, $id){
        $token = $request->bearerToken();
        if($token){
            $user = User::where('token', $token)->first();
            if($user){
                $id = $request->id;
                $subject_code = $request->subject_code;
                $description = $request->description;
                $units = $request->units;
                $subject = Subject::find($id);
                if (!$subject) {
                    return response()->json([
                        'msg' => 'Subject not found.'
                    ], 404);
                }

                $subject->subject_code = $subject_code;
                $subject->description = $description;
                $subject->units = $units;
                $subject->save();

                return response()->json([
                    'msg' => 'Subject was successfully updated.'
                ], 200);
            }
            else {
                return response()->json([
                    'msg' => 'Invalid Token.'
                ], 400);
            }
        }
        else {
            return response()->json([
                'msg' => 'No Token Provided.'
            ], 400);
        }
    }
}
