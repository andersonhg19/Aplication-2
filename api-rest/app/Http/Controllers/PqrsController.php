<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use File;



class PqrsController extends Controller
{
    
	public function create_flights (request $request){

				$name_user  =  $request->input("pqrsname_user");
				$type       =  $request->input("pqrstype");
				$mail       =  $request->input("pqrsmessage");
				$message    =  $request->input("pqrsphone");
				$phone      =  $request->input("pqrsmail");

    		

    		     $create = DB::table('pqrs')
            			->insert([
						
							'name_user'			=>	$name_user,  
							'type'			=>	$type,       
							'message'			=>	$message,    
							'phone'			=>	$phone,      
							'mail'			=>	$mail,       
						 ]);,

		return response()->json($data, $data['code']);
	}




}
