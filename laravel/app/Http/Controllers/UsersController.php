<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\User;

class UsersController extends Controller
{
    /**
	 * Display a listing of the user.
	 *
	 * @return Response
	 */
	public function index()
	{
	   
	    return response()->json(User::all(), 200);
	    
	}


	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{   
	    
	    $rules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
        ];
        
        $validator = \Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            
            Log::error('createUser '.json_encode($request->all()).' '.json_encode($validator->errors()->all()));
            
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
        Log::debug('createUser '.$user->toJson());
        return response()->json($user, 200);
            
        

	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$user=User::find($id);

		if (!$user){
		    Log::error('showUser '.json_encode(array("id"=>$id)));
		    return response()->json(['errors'=>'Model not found'],404);
		}
		return response()->json($user,200);
	}
	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
	 
		$user=User::find($id);

		if (!$user){
		    Log::error('updateUser '.json_encode(array("id"=>$id)));
		    return response()->json(['errors'=>'Model not found'],404);
		}
		
		$rules = [
            'name'=> 'required',
            'email'=> 'required|email|unique:users,email,'.$id,
        ];
        
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            
            Log::error('updateUser '.json_encode($request->all()).' '.json_encode($validator->errors()->all()));
            return response()->json([
                'update' => false,
                'errors'  => $validator->errors()->all()
            ],500);
            
        }
        
        Log::debug('updateUser '.$user->toJson());
        
        $user->name = trim($request->name); 
        $user->email = trim($request->email);
        $user->Image = trim($request->Image); 
        $user->save();
        
        return response()->json($user, 200);
            
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    $user=User::find($id);

		if (!$user){
		    Log::error('deleteUser '.json_encode(array("id"=>$id)));
		    return response()->json(['errors'=>'Model not found'],404);
		}
		
		Log::debug('deleteUser '.$user->toJson());
		$response = $user->delete(); 
		return response()->json($response,200);
	}
	
	/**
	 * Upload file user`s Image 
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function upload(Request $request, $id){
	    
	    
	    $user=User::find($id);

		if (!$user){
		    Log::error('deleteUser '.json_encode(array("id"=>$id)));
		    return response()->json(['errors'=>'Model not found'],404);
		}
		
	    $rules = [
            'image' => 'required|mimes:jpeg,bmp,png',
        ];
        
        try {
            $validator = \Validator::make($request->all(), $rules);
                
            if ($validator->fails()) {
                Log::error('uploadImage '.json_encode($request->all()).' '.json_encode($validator->errors()->all()));
                
                return response()->json([
                    'upload' => false,
                    'errors'  => $validator->errors()->all()
                ],500);
            }
    	    
            $extension = $request->file('image')->getClientOriginalExtension();
            $directory = public_path().'/images/';
            $imageName = sha1(time().time()).".{$extension}";
            $file = $request->file('image')->move($directory, $imageName);
            
            Log::debug('uploadImage '.$user->toJson());
            
            $user->Image = url('image/'.$imageName);  
            $user->save(); 
            
            return response()->json(url('image/'.$imageName), 200);
            
        }catch (Exception $e) {
            return response()->json(['update' => false,'errors'=>$e->getMessage()], 500);
        }
        
        

        
	}
}
