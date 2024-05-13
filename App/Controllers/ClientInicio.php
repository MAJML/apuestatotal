<?php

namespace App\Controllers;

use App\Model\ClientesModel;
use Core\View;
use Core\Util;

class ClientInicio
{
    public function __construct()
    {
        session_start();
        if(empty($_SESSION['client_user'])){
            session_destroy();
            header('Location: '.Util::baseUrl().'ClientLogin');
            exit;
        }
        $this->model = new ClientesModel();
    }

    public function index()
    {
        View::render(['client/inicio/index'], ['title' => 'Inicio - ApuestaTotal']);
    }

    public function mostrarSaldo()
    {
        View::renderJson($this->model->mostrarSaldo($player = $_POST['data']));
    }
}
