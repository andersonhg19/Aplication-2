<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\User;

class JwtAuth{

	public $key='anderson1996';

	public function _construct() {
		$this->key='';
	}

	public function signup ($document, $password, $getToken = null){
		
		// Buscar si existe el usuario con sus credenciales
		$user = User::where([
			'num_document'  => $document,
			'password' 		=> $password
		])->first();

		// Comprobar si son correctas(objeto)
		$signup = false;
		if(is_object($user)){
			$signup = true;
		}

		// Generar el token con los datos del usuario identificado
		if($signup){
		

			$token = array(


			'id_type_document'		=>	$user->id_type_document,
            'num_document'			=>	$user->num_document,
            'name'					=>	$user->name,
            'lastname'				=>	$user->lastname,
            'address'				=>	$user->address,
            'id_type_comunication'	=>	$user->id_type_comunication,
            'id_type_user'			=>	$user->id_type_user,
            'id_service'			=>	$user->id_service,
            'id_state_user'			=>	$user->id_state_user,
            'password'     			=>	$user->password ,
				'iat'      =>     time(),
				'exp'      =>     time() + (7 * 24 * 60 *60)
			);
			
			$jwt = JWT::encode($token, $this->key, 'HS256');
			$decoded = JWT::decode($jwt, $this->key, ['HS256']);

			// devolver los datos decodificados o el token, en funcion de un parametro
			if(is_null($getToken)) {
				$data = $jwt;
			}else{
				$data = $decoded;
			}

		}else{
			$data = array(
				'status' => 'error',
				'message' => 'login incorrecto.'
			);
		}

		return $data;
	}

	public function checkToken($jwt, $getIdentify = false) {
		$auth = false;

		try{

			$jwt = str_replace('"', '', $jwt);
			$decoded = JWT::decode($jwt,$this->key, ['HS256']);
		}catch(\UnexpectedValueException $e) {
			$auth= false;
		}catch(\DomainException $e){
			$auth = false;
		}

		if(!empty($decoded) && is_object($decoded) && isset($decoded->sub)){
			$auth = true;
		}else{
			$auth = false;
		}
		
		if($getIdentify){
			return $decoded;
		}

		return $auth;

	}

}