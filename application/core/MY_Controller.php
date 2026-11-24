<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    protected function requireRole($roles)
    {
        $roles=(array)$roles;
        if (!$this->session->userdata('logged_in') || !$this->session->userdata('tipo_usuario')) {
            redirect('Auth/index'); exit;
        }
        if (!in_array($this->session->userdata('tipo_usuario'),$roles,true)) {
            show_error('No tienes permisos para acceder a este recurso.',403); exit;
        }
    }
}