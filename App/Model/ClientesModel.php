<?php

namespace App\Model;

use Core\Model;

class ClientesModel extends Model
{
    public function WhereClientes($correo)
    {
        $query = $this->db->prepare("SELECT nombre, apellido, correo, password, player_id, saldo FROM clientes WHERE correo = '".$correo."'");
        $query->execute();
        return $query->fetch();
    }

    public function verificarClienteDuplicado($dni)
    {
        $query = $this->db->prepare("SELECT * FROM clientes WHERE dni = $dni");
        $query->execute();
        return $query->fetch();
    }

    public function modelStoreClientes($data)
    {
        $query = $this->db->prepare('INSERT INTO clientes(nombre, apellido, dni, celular, correo, password, player_id) 
        VALUES ("'.$data["nombre"].'", "'.$data["apellido"].'", "'.$data["dni"].'", "'.$data["celular"].'", "'.$data["correo"].'", "'.$data["password"].'", "'.$data["player_id"].'")');
        if($query->execute()){
            return "ok";
        }else{
            return "error";          
        }
    }

    /* ======================================== */

    public function listBancos()
    {
        $query = $this->db->prepare("SELECT * FROM bancos");
        $query->execute();
        return $query->fetchAll();
    }

    public function listSolicitudRecargas()
    {
        $query = $this->db->prepare("SELECT * FROM solicitud_recargas WHERE player_id = '".$_SESSION['client_player_id']."'");
        $query->execute();
        return $query->fetchAll();
    }

    public function validarSolicitudesRepetidas($player_id)
    {
        $query = $this->db->prepare("SELECT estado FROM solicitud_recargas WHERE player_id = '".$player_id."' ORDER BY created_at DESC");
        $query->execute();
        return $query->fetch();
    }

    public function storeSolicitudRecarga($data)
    {
        $query = $this->db->prepare('INSERT INTO solicitud_recargas(player_id, monto, banco, medio_pago, codigo_recarga) 
        VALUES ("'.$data["player_id"].'", "'.$data["monto"].'", "'.$data["banco"].'", "'.$data["medioPago"].'", "'.$data["codigo_recarga"].'")');
        if($query->execute()){
            return "ok";
        }else{
            return "error";          
        }
    }

    public function mostrarSaldo($player)
    {
        $query = $this->db->prepare("SELECT saldo FROM clientes WHERE player_id = '".$player."'");
        $query->execute();
        return $query->fetch();
    }

    public function subirVoucher($data)
    {
        $query = $this->db->prepare("UPDATE solicitud_recargas SET voucher = '".$data['voucher']."' WHERE id = '".$data['idRegister']."'");
        if($query->execute()){
            return "ok";
        }else{
            return "error";
        }
    }

}