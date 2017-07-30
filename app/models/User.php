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
       		array('username', 'email'),
       		'message' => 'Ja existe um usuario com este e-mail e/ou nome de usuario cadastrado.'
       	)
    );
	public static function cadastrar(array $post)
	{
		$role = Role::find_by_role('user');

		if(is_null($role))
		{
			return false;
		}
		
		$post = array_merge($post,array(
			'role_id'=> $role->id,
			'status' => 1
		));

		$password=\HXPHP\System\Tools::hashHX($post['password']);

		$post = array_merge($post,$password);

		$cadastrar= self::create($post);

		var_dump($cadastrar->errors->get_raw_errors());

	}
}