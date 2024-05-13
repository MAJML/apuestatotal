<?php

namespace App\Controllers;

use App\Model\UsersModel;
use Core\View;
use Core\Util;

class Inicio
{
    public function __construct()
    {
        session_start();
        if(empty($_SESSION['username'])){
            session_destroy();
            header('Location: '.Util::baseUrl());
            exit;
        }
        $this->model = new UsersModel();
    }

    public function index()
    {
        $js = array('js/home/inicio/index.js');
        View::render(['home/inicio/index'], ['title' => 'Inicio Admin', 'js' => $js]);
    }

    public function listClientes()
    {
        echo json_encode(array("data" => $this->model->listClientes()));
    }

    public function listWhereHistorial()
    {
        $id = $_POST['id']; 
        echo json_encode(array("data" => $this->model->listWhereHistorial($id)));
    }

    public function verPendienteVoucher()
    {
        $id = $_POST['id']; 
        View::renderJson($this->model->verPendienteVoucher($id));
    }

    public function confirmarRecarga()
    {
        $idCliente = $_POST['id_cliente']; $idSolicitud = $_POST['id_solicitudR']; $idUser = $_SESSION['idUsers']; 
        $monto = $_POST['monto']; $banco = $_POST['banco']; $medio_pago = $_POST['medio_pago'];
        if(isset($idCliente) && isset($idSolicitud) && isset($idUser) && isset($monto)){
            $statusRecarga = $this->model->confirmarRecarga($idCliente, $idSolicitud, $idUser, $monto, $banco, $medio_pago);
            if($statusRecarga == 'ok'){
                $saldo = $this->model->saldoActual($idCliente);
                $numero1_sin_coma = floatval(str_replace(',', '', $monto));
                $numero2_float = floatval($saldo->saldo);
                $suma = $numero1_sin_coma + $numero2_float;
                $newSaldo = number_format($suma, 2);
                $updatedCliente = $this->model->updateClienteSaldo($idCliente, $newSaldo);
                $solicitudUpdated = $this->model->updatedEstadoSolicitud($idSolicitud);
                View::renderJson('ok');
            }

            View::renderJson('no hay adaaaaaa');
            /* View::renderJson($this->model->confirmarRecarga($idCliente, $idSolicitud, $idUser, $monto)); */
        }else{
            View::renderJson('data vacia');
        }
    }

}
