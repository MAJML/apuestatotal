<?php

namespace App\Model;

use Core\Model;

class UsersModel extends Model
{
    public function WhereUsuario($usuario)
    {
        $query = $this->db->prepare("SELECT id, nombre, apellido, perfil, usuario, password FROM users WHERE usuario = '".$usuario."'");
        $query->execute();
        return $query->fetch();
    }

    public function listClientes()
    {
        $query = $this->db->prepare("SELECT 
        CL.id,
        CL.nombre,
        CL.apellido,
        CL.dni,
        CL.celular,
        CL.correo,
        CL.player_id,
        CL.saldo,
        (select voucher from solicitud_recargas where estado=0 and player_id=CL.player_id order by created_at desc limit 1) as 'voucher'
        FROM clientes CL");
        $query->execute();
        return $query->fetchAll();
    }

    public function listWhereHistorial($id)
    {
        $query = $this->db->prepare("SELECT 
        HR.created_at,
        HR.banco,
        HR.medio_pago,
        HR.monto,
        U.nombre as 'asesor_nombre',
        U.apellido as 'asesor_apellido',
        CL.nombre as 'cliente_nombre',
        CL.apellido as 'cliente_apellido',
        CL.dni as 'cliente_dni',
        CL.player_id as 'cliente_player'
        from historial_recargas HR
        inner join users U on U.id=HR.id_users
        inner join clientes CL on CL.id=HR.id_clientes
        where HR.id_clientes=$id");
        $query->execute();
        return $query->fetchAll();
    }

    public function verPendienteVoucher($id)
    {
        $query = $this->db->prepare("SELECT 
        SR.id as 'id_solicitud_recargas',
        SR.created_at,
        SR.player_id,
        SR.monto,
        SR.codigo_recarga,
        SR.voucher,
        SR.medio_pago,
        B.name as 'banco'
        from solicitud_recargas SR
        inner join bancos B on B.id=SR.banco
        where SR.player_id='".$id."' and estado = 0 order by created_at desc limit 1");
        $query->execute();
        return $query->fetchAll();
    }

    public function updatedEstadoSolicitud($idSolicitud)
    {
        $query = $this->db->prepare("UPDATE solicitud_recargas SET estado = 1 WHERE id = '".$idSolicitud."'");
        if($query->execute()){
            return "ok";
        }else{
            return "error";
        }
    }

    public function saldoActual($idCliente)
    {
        $query = $this->db->prepare("SELECT saldo FROM clientes WHERE id = '".$idCliente."'");
        $query->execute();
        return $query->fetch();
    }

    public function confirmarRecarga($idCliente, $idSolicitud, $idUser, $monto, $banco, $medio_pago)
    {
        $query = $this->db->prepare('INSERT INTO historial_recargas(id_users, id_clientes, id_solicitud_recargas, banco, medio_pago, monto) 
        VALUES ("'.$idUser.'", "'.$idCliente.'", "'.$idSolicitud.'", "'.$banco.'","'.$medio_pago.'" ,"'.$monto.'")');
        if($query->execute()){
            return "ok";
        }else{
            return "error";          
        }
    }

    public function updateClienteSaldo($idCliente, $newSaldo)
    {
        $query = $this->db->prepare("UPDATE clientes SET saldo = '".$newSaldo."' WHERE id = '".$idCliente."'");
        if($query->execute()){
            return "ok";
        }else{
            return "error";
        }
    }
}