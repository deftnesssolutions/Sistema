<?php

class CadastroController extends \HXPHP\System\Controller
{
    public function cadastrarAction()
    {
       $this->view->setFile('index');

       $this->request->setCustomFilters(array(

       		'email'=> FILTER_VALIDATE_EMAIL
       	));

       //var_dump($this->request->post());
       $cadastrarUsuario = User::cadastrar($this->request->post());
       //gerar senha
       //obter role_id
    }
}