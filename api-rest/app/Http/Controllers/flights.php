<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use File;



class flights extends Controller
{
    
	public function create_flights (request $request){
		
  			$name  = $request->input("flights.name");
  			$code  = $request->input("flights.code");
			$price = $request->input("flights.price");
			$plane = $request->input("flights.id_plane");
			$time  = $request->input("flights.time");
			$image = $request->input("flights.image");



    		$search = DB::table('flights')
    		    ->where('code', '=', $code)
    		    ->first();
			echo $search;
    		if (!$search) {

    		     $create = DB::table('flights')
            			->insert([
							'code'	=>		$code,                      
							'name'	=>		$name,                     
							'price'	=>		$price,	    
							'id_plane'	=>		$plane,		    
							'time'	=>		$time,				    
							'image'	=>		$image,	
						 ]);


            	$data = array(
					'status'	=> 'success',
					'code'		=> 200,	
					'message'	=> 'la ruta se ha creado correctamente'
				);
				


			}else{
					$data = array(
						'status'	=> 'Error',
						'code'		=> 400,	
						'message' 	=> 'Los datos no son correctos'
					);				
				}
		
		return response()->json($data, $data['code']);
	}

    public function routes (Request $request)
    {
        $search = DB::table('flights')
            ->get();
        return response()->json(['status' => 'ok', 'search' => $search], 200);
    }



    public function plane (Request $request)
    {
        $search = DB::table('plane')
            ->get();
        return response()->json(['status' => 'ok', 'search' => $search], 200);
    }

}
