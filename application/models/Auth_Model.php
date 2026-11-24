<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_Model extends CI_Model
{
    public function obtenerUsuario($correo)
    {
        return $this->db->select('id,nombre,apellidos,correo,contrasena,tipo_usuario')
            ->where('correo',strtolower(trim($correo)))->limit(1)->get('usuarios')->row();
    }
}