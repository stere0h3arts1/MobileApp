<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * User registration
     */
    public function register(Request $request){
        $user = new User;
		$user->username = $request->username;
		$user->password = bcrypt($request->password);
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
                $product = new Product;
                $product->product_name = $request->product_name;
                $product->product_price = $request->product_price;
                $product->product_description = $request->product_description;
                $product->save();
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
                $product = Product::all();
                return response()->json($product, 200);
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
                $product = Product::find($id);
                if($product){
                    return response()->json($product, 200);
                }
                else {
                    return response()->json([
                        'msg' => 'Product not found.'
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
    public function delete(Request $request){
        $token = $request->bearerToken();
        if($token){
            $user = User::where('token', $token)->first();
            if($user){
                $product_id = $request->product_id;
                $product = Product::find($product_id);
                $product->delete();
                return response()->json([
                    'msg' => 'Product was successfully deleted.'
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

    /**
     * Product update
     */
    public function update(Request $request){
        $token = $request->bearerToken();
        if($token){
            $user = User::where('token', $token)->first();
            if($user){
                $product_id_old = $request->product_id_old;
                $product_id = $request->product_id;
                $product_name = $request->product_name;
                $product_price = $request->product_price;
                $product_description = $request->product_description;
                $product = Product::find($product_id_old);
                $product->product_id = $product_id;
                $product->product_name = $product_name;
                $product->product_price = $product_price;
                $product->product_description = $product_description;
                $product->save();
                return response()->json([
                    'msg' => 'Product was successfully updated.'
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
