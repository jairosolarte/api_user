<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;

class UsersController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    return response()->json(User::all(), 200);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{   
	    
	    $rules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
        ];
        try {
            $validator = \Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return response()->json([
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ],500);
            }
            
            $user = new User; 
            $user->name = trim($request->name); 
            $user->email = trim($request->email);
            $user->Image = trim($request->Image); 
            $user->save();
            return response()->json($user, 200);
            
        }catch (Exception $e) {
            //\Log::info('Error creating user: '.$e);
            
            return response()->json(['created' => false,'errors'=>$e->getMessage()], 500);
        }

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$user=User::find($id);

		if (!$user){
		    return response()->json(['errors'=>'Model not found'],404);
		}
		return response()->json($user,200);
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
	 
		$user=User::find($id);

		if (!$user){
		    return response()->json(['errors'=>'Model not found'],404);
		}
		
		$rules = [
            'name'=> 'required',
            'email'=> 'required|email|unique:users,email,'.$id,
        ];
        
        try {
            $validator = \Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return response()->json([
                    'update' => false,
                    'errors'  => $validator->errors()->all()
                ],500);
            }
            
            
            $user->name = trim($request->name); 
            $user->email = trim($request->email);
            $user->Image = trim($request->Image); 
            $user->save();
            return response()->json($user, 200);
            
        }catch (Exception $e) {
            return response()->json(['update' => false,'errors'=>$e->getMessage()], 500);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    $user=User::find($id);

		if (!$user){
		    return response()->json(['errors'=>'Model not found'],404);
		}
		
		$response = $user->delete(); 
		
		return response()->json($response,200);
	}
	
	public function upload(Request $request, $id){
	    
	    
	    $user=User::find($id);

		if (!$user){
		    return response()->json(['errors'=>'Model not found'],404);
		}
		
	    $rules = [
            'image' => 'required|mimes:jpeg,bmp,png',
        ];
        
        try {
            $validator = \Validator::make($request->all(), $rules);
                
            if ($validator->fails()) {
                return response()->json([
                    'upload' => false,
                    'errors'  => $validator->errors()->all()
                ],500);
            }
    	    
            $extension = $request->file('image')->getClientOriginalExtension();
            $directory = public_path().'/images/';
            $imageName = sha1(time().time()).".{$extension}";
            $file = $request->file('image')->move($directory, $imageName);
            
            $user->Image = url('image/'.$imageName);  
            $user->save(); 
            return response()->json(url('image/'.$imageName), 200);
            
        }catch (Exception $e) {
            return response()->json(['update' => false,'errors'=>$e->getMessage()], 500);
        }
        
        

        
	}
}
