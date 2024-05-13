<?php

namespace App\Controllers;

use App\Model\ClientesModel;
use Core\View;
use Core\Util;

class ClientRecarga
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
        $js = array('js/client/recarga/index.js');
        View::render(['client/recarga/index'], ['title' => 'Recarga - ApuestaTotal', 'bancos' => $this->model->listBancos(), 'js' => $js]);
    }

    public function listSolicitudRecargas()
    {
        echo json_encode(array("data" => $this->model->listSolicitudRecargas()));
    }

    public function storeSolicitudRecarga()
    {
        $player_id = $_SESSION['client_player_id']; $validando = $this->model->validarSolicitudesRepetidas($player_id); $monto = $_POST['monto'];
        if ($validando && $validando->estado == 0) {
            View::renderJson('Ya hay una Solicitud pendiente de Pago');
            return;
        }
        if ($monto < 20) {
            View::renderJson('El valor minimo de recarga es de S/20');
            return;
        }
        $codigo = base64_encode(random_bytes(15));
        $codigo = str_replace(['+', '/', '='], '', $codigo);
        $codigo = strtoupper(substr($codigo, 0, 15));
        $data = array(
            'player_id' => $player_id,
            'monto' => number_format($monto, 2),
            'banco' => $_POST['banco'],
            'codigo_recarga' => $codigo,
            'medioPago' => $_POST['medioPago']
        );
        $register = $this->model->storeSolicitudRecarga($data);
        View::renderJson($register);
    }

    public function subirVoucher()
    {
        $ruta = "";         
        if(isset($_FILES["voucher"]["tmp_name"])){
            $directorio = "./img/clientVoucher/".$_SESSION['client_player_id'];
            if (!is_dir($directorio)) {
                mkdir($directorio, 0700);
            }   
            /* $aleatorio = mt_rand(100,999);*/                 
            $ruta = "img/clientVoucher/".$_SESSION['client_player_id']."/".mt_rand(100,999).'-'.mt_rand(100,999).".jpg";
            move_uploaded_file($_FILES["voucher"]["tmp_name"], $ruta);
            $data = array('idRegister' => $_POST['idRegister'], 'voucher' => $ruta);
            $updatedVoucher = $this->model->subirVoucher($data);
            View::renderJson($updatedVoucher);
        }else{
            View::renderJson('no hay imagen');
        }
    }
    
}
