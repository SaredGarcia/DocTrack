<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library('form_validation');
        $this->load->model('Auth_Model');
    }
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $this->redirectByRole($this->session->userdata('tipo_usuario')); return;
        }
        $this->load->view('Login/login');
    }
    public function iniciarSesion()
    {
        if ($this->input->method(TRUE)!=='POST') { show_error('Método no permitido.',405); return; }
        $this->form_validation->set_rules('Usuario','Correo electrónico','required|trim|valid_email');
        $this->form_validation->set_rules('Contraseña','Contraseña','required');
        if (!$this->form_validation->run()) {
            $data['error']='Ingresa un correo válido y tu contraseña.';
            $this->load->view('Login/login',$data); return;
        }
        $correo=strtolower(trim($this->input->post('Usuario',TRUE)));
        $password=(string)$this->input->post('Contraseña',FALSE);
        $user=$this->Auth_Model->obtenerUsuario($correo);
        if (!$user || !password_verify($password,$user->contrasena)) {
            $data['error']='Correo o contraseña incorrectos.';
            $this->load->view('Login/login',$data); return;
        }
        $this->session->sess_regenerate(TRUE);
        $this->session->set_userdata(array(
            'logged_in'=>TRUE,'id_usuario'=>(int)$user->id,'nombre_usuario'=>$user->nombre,
            'correo'=>$user->correo,'tipo_usuario'=>$user->tipo_usuario
        ));
        $this->redirectByRole($user->tipo_usuario);
    }
    private function redirectByRole($role)
    {
        if ($role==='Estudiante') redirect('Alumno/Dashboard_A/Dashboard');
        elseif ($role==='Profesor') redirect('Maestro/Dashboard_M/InicioA');
        elseif ($role==='Admin') redirect('Admin/Dashboard/Inicio');
        else { $this->session->sess_destroy(); redirect('Auth/index'); }
    }
    public function logout() { $this->session->sess_destroy(); redirect('Auth/index'); }
}