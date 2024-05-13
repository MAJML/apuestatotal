<?php

namespace App\Controllers;

use App\Model\ClientesModel;
use Core\View;
use Core\Util;

class ClientLogin
{
    public function __construct()
    {
        date_default_timezone_set('America/Lima');
        session_start();
        if(!empty($_SESSION['client_user'])){
            header('Location:'.Util::baseUrl().'ClientInicio');
        }
        $this->model = new ClientesModel();
    }

    public function index()
    {
        View::login(['client/login/index'], ['title' => 'Login']);
    }

    public function registro()
    {
        View::login(['client/login/registro'], ['title' => 'Login - Registro']);
    }

    public function ingresarSistema()
    {
        $correo = $_POST['email']; $password = $_POST['password'];
        if(isset($correo) && isset($password)){
            $validando = $this->model->WhereClientes($correo);
            if($validando){
                if($correo == $validando->correo && password_verify($password, $validando->password)){
                    $_SESSION['username'] = null;
                    $_SESSION['client_user'] = $validando->nombre.' '.$validando->apellido;
                    $_SESSION['client_player_id'] = $validando->player_id;
                    $_SESSION['client_saldo'] = $validando->saldo;
                    View::renderJson('success');
                }else{
                    View::renderJson('Contraseña Incorrecta');
                }
            }else{
                View::renderJson('Email incorrecto');
            }
        }else{
            View::renderJson('Los campos estan vacios');
        }
    }

    public function cerrar_sesion()
    {
        session_destroy();
        header('Location: '.Util::baseUrl().'ClientLogin');
		exit;
    }

    public function storeCliente()
    {
        $nombre = strtoupper($_POST['nombre']); $apellido = strtoupper($_POST['apellido']); $player_id = substr($nombre, 0, 1).substr($apellido, 0, 1).substr($_POST['dni'], -5); $dni = $_POST['dni'];
        $verificDuplicate = $this->model->verificarClienteDuplicado($dni);
        if($verificDuplicate){
            View::renderJson('duplicado');
        }else{
            $data = array(
                'dni' => $_POST['dni'],
                'nombre' => $nombre,
                'apellido' => $apellido,
                'celular' => $_POST['celular'],
                'correo' => $_POST['correo'],
                'player_id' => $player_id,
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            );
            $registrar = $this->model->modelStoreClientes($data);
            View::renderJson($registrar);
        }
    }

    public function dniValidacion()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiperu.dev/api/dni/".$_POST['dni']."?api_token=3fccc8c48f59ff6ee58afff70a360af5fdcc214f571128165cdc050da28f2770",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $response = curl_exec($curl);
        $persona = json_decode($response);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            View::renderJson("cURL Error #:" . $err);
        } else {
            View::renderJson($persona);
        }
    }
}
