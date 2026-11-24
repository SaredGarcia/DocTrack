<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Model extends CI_Model
{
    public function obtener_todos_usuarios()
    {
        return $this->db->select('id,nombre,apellidos,correo,tipo_usuario')
            ->order_by('nombre','ASC')->get('usuarios')->result_array();
    }

    public function obtener_usuario_por_id($id)
    {
        return $this->db->where('id',(int)$id)->get('usuarios')->row_array();
    }

    public function actualizar_usuario($idUsuario,$datosUsuario)
    {
        return $this->db->where('id',(int)$idUsuario)->update('usuarios',$datosUsuario);
    }

    public function actualizar_tipo($id,$datos)
    {
        return $this->db->where('id',(int)$id)->update('tipos_documentos',$datos);
    }

    public function eliminar($idUsuario)
    {
        return $this->db->where('id',(int)$idUsuario)->delete('usuarios');
    }

    public function eliminartipo($id)
    {
        return $this->db->where('id',(int)$id)->delete('tipos_documentos');
    }

    public function crear_usuario($data)
    {
        return $this->db->insert('usuarios',$data);
    }

    public function obtener_tipos_documentos()
    {
        return $this->db->order_by('nombre','ASC')->get('tipos_documentos')->result_array();
    }
}