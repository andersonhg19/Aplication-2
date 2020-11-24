<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    

	public function register(request $request){

// Recoger los datos del usuario por postFF

				$id_type_document		=  $request->input("user.id_type_document");
				$num_document			=  $request->input("user.num_document");
				$name					=  $request->input("user.name");
				$lastname				=  $request->input("user.lastname");
				$address				=  $request->input("user.address");
				$mail_address 			=  $request->input("user.mail_address");
				$phone					=  $request->input("user.phone");
				$cell_phone				=  $request->input("user.cell_phone");
				$id_type_comunication	=  $request->input("user.id_type_comunication");
				$id_type_user			=  $request->input("user.id_type_user");
				$id_service				=  $request->input("user.id_service");
				$id_state_user			=  $request->input("user.id_state_user");
				$password		        =  $request->input("user.password"); 

    			    $search = DB::table('users')
    			        ->where('num_document', '=', $num_document)
    			        ->first();
			
    		if (!$search) {
    		    $pwd = hash('sha256', $password);

    		     $create = DB::table('users')
            			->insert([
								'id_type_document'		=>		$id_type_document		,
								'num_document'			=>		$num_document			,
								'name'					=>		$name					,
								'lastname'				=>		$lastname				,
								'address'				=>		$address				,
								'id_type_comunication'	=>		$id_type_comunication	,
								'id_type_user'			=>		$id_type_user			,			,
								'id_state_user'			=>		$id_state_user			,
								'password'				=>		$pwd		       
            				]);


            			$search = DB::table('users')
    			        ->where('num_document', '=', $num_document)
    			        ->first();
    			        $id_user = $search->id_user;

            			$create = DB::table('mails_user')
            			->insert([
								'mail'					=>		$mail_address 			,
            					'id_user'				=>		$id_user				
            			]);
            			$create = DB::table('phones_user')
            			->insert([
								'phone'					=>		$cell_phone				,
            					'id_user'				=>		$id_user				
            			]);
            			$create = DB::table('phones_user')
            			->insert([
            					'phone'					=>		$phone					,
            					'id_user'				=>		$id_user				
            			]);

            	$data = array(
					'status'=> 'success',
					'code'	=> 200,	
					'message'=> 'El usuario se ha creado correctamente'
				);
			}else{
					$data = array(
						'status'=> 'Error',
						'code'	=> 400,	
						'message' => 'los datos no corresponden'
					);				
				}
		
				return response()->json($data, $data['code']);
	}

	public function login (Request $request){

		$jwtAuth = new \JwtAuth();

		// Recibir datos por POST
		 $document = $request->input('document');
		 $password = $request->input('password');

			$pwd = hash ('sha256', $password);			
		
			// devolver token o datos
			$signup = $jwtAuth->signup($document, $pwd);
			

		return response()->json($signup, 200);

}

	public function update(request $request) {
		
		// Comprobar si el usario esta identificado
		$token = $request->header('authorization');
		$jwtAuth = new \JwtAuth();
		$checkToken = $jwtAuth->checkToken($token);

			// Recoger los datos por post
			$json = $request->input('json', null);
			$params_array = json_decode($json, true);

		
		if($checkToken && !empty($params_array)){
		
			// Sacar usuario identificado
			$user = $jwtAuth->checkToken($token, true);

			// Validar datos
			$validate = \Validator::make($params_array, [
				'name'		=>	'required|alpha',
				'surname'	=>	'required|alpha',
				'email'		=>	'required|email|unique:users,'.$user->sub		
			]);


			// Quitar los campos que no quiero actualizar 
			unset($params_array['id']);
			unset($params_array['role']);
			unset($params_array['password']);
			unset($params_array['created_at']);
			unset($params_array['remember_token']);

			// Actualizar usuario en bbdd
			$user_update = User::where('id', $user->sub)->update($params_array); 

			// Devolver array con resultado
				$data = array(
				'code' => 200,
				'status' => 'success',
				'user' => $user,
				'changes' => $params_array
			);
		
		}else{
			$data = array(
				'code' => 400,
				'status' => 'error',
				'message' => 'el usuario no esta identificado.'
			);

		}

		return response()->json($data, $data['code']);
	}
	
	public function upload(Request $request){

		// Recoger datos de la peticion
		$image = $request->file('file0');

		// Validacion de imagen
		$validate = \Validator::make($request->all(), [
			'file0' => 'required|image|mimes:jpg,jpeg,png,gif'
		
		]);

		// Guardar imagen
		if(!$image || $validate->fails()){
				$data = array(
				'code' => 400,
				'status' => 'error',
				'message' => 'el usuario no esta identificado.'
			);

		}else{
			$image_name = time().$image->getClientOriginalName();
			\Storage::disk('users')->put($image_name, \File::get($image));

			$data = array(
				'code' => 200,
				'status' => 'success',
				'image' => $image_name
			);

		}

			return response()->json($data, $data['code']);
	}


	public function getImage ($filename){
		$isset = \Storage::disk('users')->exists($filename);
		if($isset){
		$file = \Storage::disk('users')->get($filename);
		return new Response($file, 200);
		}else{		
				$data = array(
				'code' => 404,
				'status' => 'error',
				'message' => 'La imagen no existe.'
			);

			return response()->json($data, $data['code']);

		}
	}

	public function detail($id){
		$user = User::find($id);

		if(is_object($user)){
			$data = array(
				'code' => 200,
				'status' => 'succes',
				'user' => $user
			);
		}else{
				$data = array(
				'code' => 404,
				'status' => 'error',
				'message' => 'El usuario no existe.'
			);
		}
			
			return response()->json($data, $data['code']);

	}



	public function prueba1 (Request $request){

		$user= $request->state;
		echo $user;

	}

    public function type_documents(Request $request)
    {
        $search = DB::table('type_documents')
            ->get();
        return response()->json(['status' => 'ok', 'search' => $search], 200);
    }

    public function type_user(Request $request)
    {
        $search = DB::table('type_users')
            ->get();
        return response()->json(['status' => 'ok', 'search' => $search], 200);
    }
    public function type_communications(Request $request)
    {
        $search = DB::table('type_communications')
            ->get();
        return response()->json(['status' => 'ok', 'search' => $search], 200);
    }
    public function state_user(Request $request)
    {
        $search = DB::table('state_users')
            ->get();
        return response()->json(['status' => 'ok', 'search' => $search], 200);
    }
    public function services(Request $request)
    {
        $search = DB::table('services')
            ->get();
        return response()->json(['status' => 'ok', 'search' => $search], 200);
    }


}
