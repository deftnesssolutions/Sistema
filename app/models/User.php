<?php

class User extends \HXPHP\System\Model
{
	static $validates_presence_of = array(
      array(
      	'name',
      	'message' => 'O nome é um campo obrigatorio.'
      	),
      array(
      	'email',
      	'message' => 'O e-mail é um campo obrigatorio.'
      	),
      array(
      	'username',
      	'message' => 'O nome de usuario é um campo obrigatorio.'
      	),
      array(
      	'password',
      	'message' => 'A senha é um campo obrigatorio.'
      	)
    );

	static $validates_uniqueness_of = array(
       array(
			'username',
			'message' => 'Já existe um usuário com este nome de usuário cadastrado.'
		),
		array(
			'email',
			'message' => 'Já existe um usuário com este e-mail cadastrado.'
		)
    );
	public static function cadastrar(array $post)
	{
		$callbackObj = new \stdClass;
		$callbackObj->status=false;
		$callbackObj->user=null;
		$callbackObj->errors=array();

		$role = Role::find_by_role('user');

		if(is_null($role))
		{
			array_push($callbackObj->errors, 'A role user não existe. Contate o administrador');
			return $callbackObj;
		}
		
		$user_data = array_merge($post,array(
			'role_id'=> $role->id,
			'status' => 1
		));

		$password=\HXPHP\System\Tools::hashHX($post['password']);

		$post = array_merge($user_data,$password);

		$cadastrar= self::create($post);

		//var_dump($cadastrar->errors->get_raw_errors());
		if($cadastrar->is_valid())
		{
			$callbackObj->user=$cadastrar;
			$callbackObj->status=true;
			return $callbackObj;
		}

		$errors=$cadastrar->errors->get_raw_errors();
		foreach ($errors as $field => $message) {
			array_push($callbackObj->errors, $message[0]);
		}

		return $callbackObj;

	}
}