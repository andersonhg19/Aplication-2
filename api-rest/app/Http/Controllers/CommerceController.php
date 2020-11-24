<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use File;

class CommerceController extends Controller
{
   
	public $commerceName;

	public function _construct() {
		 $this->commerceName='';
	}

	public function register (request $request){
		
			$nit                      =  $request->input("commerce.nit");
			$name                     =  $request->input("commerce.name");
			$phone                    =  $request->input("commerce.phone");
			$email                    =  $request->input("commerce.email");
			$redes_sociales           =  $request->input("commerce.redes_sociales");
			$id_class_commerce	      =  $request->input("commerce.id_class_commerce");
			$main_activity		      =  $request->input("commerce.main_activity");
			$address				  =  $request->input("commerce.address");
			$country				  =  $request->input("commerce.country");
			$department			      =  $request->input("commerce.department");
			$city					  =  $request->input("commerce.city");
			$neighborhood			  =  $request->input("commerce.neighborhood");
			$apple				      =  $request->input("commerce.apple");
			$description			  =  $request->input("commerce.description");
			$id_service			   	  =  $request->input("commerce.id_service");
			$id_state_commerce	   	  =  $request->input("commerce.id_state_commerce");
			$start_date			   	  =  $request->input("commerce.start_daate");
			$end_date				  =  $request->input("commerce.end_daate");
			$lat	        		  =  $request->input("commerce.lat");
			$long 				      =  $request->input("commerce.long");
			$id_type_comunication	  =  $request->input("commerce.id_type_comunication");
			$id_type_content_commerce =  $request->input("commerce.id_type_content_commerce");
		//	$image 					  =  $request->file("image");

			echo $this->commerceName = $name;


    		$search = DB::table('commerce')
    		    ->where('nit', '=', $nit)
    		    ->first();
			
    		if (!$search) {

    		     $create = DB::table('commerce')
            			->insert([
							'nit'						=>		$nit,                      
							'name'						=>		$name,                     
							'id_class_commerce'			=>		$id_class_commerce,	    
							'main_activity'				=>		$main_activity,		    
							'address'					=>		$address,				    
							'country'					=>		$country,				    
							'department'				=>		$department,			    
							'city'						=>		$city,					    
							'neighborhood'				=>		$neighborhood,			    
							'apple'						=>		$apple,				    
							'description'				=>		$description,			    
							'id_service'				=>		$id_service,			    
							'id_state_commerce'			=>		$id_state_commerce,	    
							'start_date'				=>		$start_date,			    
							'end_date'					=>		$end_date,				    
							'id_type_comunication'		=>		$id_type_comunication,	    
							'id_type_content_commerce'	=>		$id_type_content_commerce, 
						  ]);


            $search = DB::table('commerce')
    		  ->where('nit', '=', $nit)
    		  ->first();
    		  $id_commerce = $search->id_commerce;

            	$create = DB::table('phones_commerce')
            	->insert([
						'phone'						=>		$phone,
            			'id_commerce'				=>		$id_commerce				
            	]);

            	$create = DB::table('mails_commerce')
            	->insert([
						'mail'						=>		$email,
            			'id_commerce'				=>		$id_commerce				
            	]);

            	$create = DB::table('social_media')
            	->insert([
						'social_media'			=>		$redes_sociales,
            			'id_commerce'				=>		$id_commerce				
            	]);

            	$create = DB::table('position')
            	->insert([
						'latitud'					=>		$lat,	        		    
						'longitud'					=>		$long, 	
            			'id_commerce'				=>		$id_commerce				
            	]);

            
            	$data = array(
					'status'	=> 'success',
					'code'		=> 200,	
					'message'	=> 'El comercio se ha creado correctamente'
				);
				


			}else{
					$data = array(
						'status'	=> 'Error',
						'code'		=> 400,	
						'message' 	=> 'Los datos no corresponden'
					);				
				}
		
				return response()->json($data, $data['code']);
	}


	
	public function upload(){

		// Recoger datos de la peticion
			$nameCommerce    = $_POST['name'];
			$nitCommerce     = $_POST['nit'];
            $image   = $_FILES; 
	   foreach ($image as &$image) {

            $name    = $image['name'];
            $file    = $image['tmp_name'];
            $type    = $image['type'];
            $hoy     = date("Y_m_d_H_i_s");
            $Typedoc = explode("/", $type);

            $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

            $strlength = strlen($characters);

            $random       = '';
          
            for ($i = 0; $i < 15; $i++) {
                $random .= $characters[rand(0, $strlength - 1)];
            }
            if ($Typedoc[1] == 'jpeg' or $Typedoc[1] == 'png') {

                $namefile = $random . '.' . $Typedoc[1];
                $carpeta  = public_path('/images/' . $nameCommerce . '/');

                if (!File::exists($carpeta)) {
                    $path = public_path('/images/' . $nameCommerce . '/');
                    File::makeDirectory($path, 0777, true);
                }
                 $url = '/images/';
                move_uploaded_file($file, $carpeta . $namefile); 

           		CommerceController::insert_image($nitCommerce, $namefile, $carpeta);
            }
        }

        return response()->json(['status' => 'ok', 'response' => true], 200);
    }


    public function insert_image($nitCommerce, $namefile, $carpeta)
    
    {$search = DB::table('commerce')
    		  ->where('nit', '=', $nitCommerce)
    		  ->first();
    		  $id_commerce = $search->id_commerce;

        $insert = DB::table('img_commerce')
            ->insert([
                'id_commerce'  => $id_commerce,
                'img_commerce' => $namefile,
                'url'        => $carpeta
            ]);
    }

    public function classCommerce(Request $request)
    {
        $search = DB::table('class_commerce')
            ->get();
        return response()->json(['status' => 'ok', 'search' => $search], 200);
    }
    public function state_commerce(Request $request)
    {
        $search = DB::table('state_commerce')
            ->get();
        return response()->json(['status' => 'ok', 'search' => $search], 200);
    }

}