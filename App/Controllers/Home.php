<?php

namespace App\Controllers;

use App\Model\UsersModel;
use Core\View;
use Core\Util;

class Home
{
    public function __construct()
    {
        date_default_timezone_set('America/Lima');
        session_start();
        if(!empty($_SESSION['username'])){
            header('Location:'.Util::baseUrl().'inicio');
        }
        $this->model = new UsersModel();
    }

    public function index()
    {
        View::login(['home/login/index'], ['title' => 'Login']);
    }

    public function ingresarSistema()
    {
        $usuario = $_POST['usuario']; $password = $_POST['password'];
        if(isset($usuario) && isset($password)){
            $validando = $this->model->WhereUsuario($usuario);
            if($validando){
                if($usuario == $validando->usuario && password_verify($password, $validando->password)){
                    $_SESSION['idUsers'] = $validando->id;
                    $_SESSION['client_user'] = null;
                    $_SESSION['username'] = $validando->nombre.' '.$validando->apellido;
                    $_SESSION['perfil'] = $validando->perfil;
                    View::renderJson('success');
                }else{
                    View::renderJson('datos erroneos');
                }
            }else{
                View::renderJson('Usuario incorrecto');
            }
        }else{
            View::renderJson('campos vacios');
        }
    }

    public function cerrar_sesion()
    {
        session_destroy();
        header('Location: '.Util::baseUrl());
		exit;
    }
}
