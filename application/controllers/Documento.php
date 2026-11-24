<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Documento extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Documento_model');
        $this->load->helper(array('url','form'));
    }
    public function procesar_subida()
    {
        $this->requireRole(array('Estudiante'));
        if($this->input->method(TRUE)!=='POST'){show_error('Método no permitido.',405);return;}
        $this->form_validation->set_rules('tipoDocumento','Tipo de documento','required|trim|max_length[100]');
        $this->form_validation->set_rules('titulo','Título','required|trim|max_length[100]');
        $this->form_validation->set_rules('maestro','Profesor','required|integer');
        if(!$this->form_validation->run()){ $this->session->set_flashdata('error',validation_errors()); redirect('Alumno/Dashboard_A/Dashboard'); return; }
        $teacher=(int)$this->input->post('maestro');
        if(!$this->Documento_model->maestroExiste($teacher)){ $this->session->set_flashdata('error','Selecciona un profesor válido.'); redirect('Alumno/Dashboard_A/Dashboard'); return; }
        $path=FCPATH.'uploads/documentos/';
        if(!is_dir($path)||!is_writable($path)){ $this->session->set_flashdata('error','El directorio de documentos no está disponible.'); redirect('Alumno/Dashboard_A/Dashboard'); return; }
        $config=array('upload_path'=>$path,'allowed_types'=>'pdf|doc|docx','max_size'=>10240,
            'file_name'=>bin2hex(random_bytes(16)),'remove_spaces'=>TRUE,'detect_mime'=>TRUE,'mod_mime_fix'=>TRUE);
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('archivo')){ $this->session->set_flashdata('error',strip_tags($this->upload->display_errors('',''))); redirect('Alumno/Dashboard_A/Dashboard'); return; }
        $file=$this->upload->data();
        $ok=$this->Documento_model->guardar_documento($this->input->post('tipoDocumento',TRUE),$this->input->post('titulo',TRUE),$file['file_name'],$teacher);
        if(!$ok){ @unlink($file['full_path']); $this->session->set_flashdata('error','No fue posible registrar el documento.'); }
        else $this->session->set_flashdata('success','Documento enviado para revisión.');
        redirect('Alumno/Dashboard_A/Dashboard');
    }
    public function mostrar_documentos()
    {
        $this->requireRole(array('Admin'));
        $data['archivos']=$this->Documento_model->obtener_todos_archivos();
        $this->load->view('Alumno/Archivos',$data);
    }
    public function mostrarModalRechazo($id)
    {
        $this->requireRole(array('Profesor'));
        $doc=$this->Documento_model->obtener_documento_por_id($id);
        if(!$doc||(int)$doc['maestro_id']!==(int)$this->session->userdata('id_usuario')){show_404();return;}
        $this->load->view('modal_rechazo',array('documento'=>$doc));
    }
    public function procesar_rechazo()
    {
        $this->requireRole(array('Profesor'));
        if($this->input->method(TRUE)!=='POST'){show_error('Método no permitido.',405);return;}
        $this->form_validation->set_rules('idDocumento','Documento','required|integer');
        $this->form_validation->set_rules('motivo','Motivo','required|trim|max_length[2000]');
        if(!$this->form_validation->run()){ $this->session->set_flashdata('error','Debes indicar un motivo de rechazo.'); redirect('Maestro/Dashboard_M/InicioA'); return; }
        $ok=$this->Documento_model->procesar_rechazo_documento((int)$this->input->post('idDocumento'),$this->input->post('motivo',TRUE),(int)$this->session->userdata('id_usuario'));
        $this->session->set_flashdata($ok?'success':'error',$ok?'Documento rechazado.':'No fue posible actualizar el documento.');
        redirect('Maestro/Dashboard_M/InicioA');
    }
    public function aceptarDocumento($id)
    {
        $this->requireRole(array('Profesor'));
        if($this->input->method(TRUE)!=='POST'){show_error('Método no permitido.',405);return;}
        $ok=$this->Documento_model->aceptarDocumento($id,$this->input->post('motivo',TRUE),(int)$this->session->userdata('id_usuario'));
        $this->session->set_flashdata($ok?'success':'error',$ok?'Documento aceptado.':'No fue posible actualizar el documento.');
        redirect('Maestro/Dashboard_M/InicioA');
    }
    public function eliminar($id)
    {
        $this->requireRole(array('Estudiante'));
        if($this->input->method(TRUE)!=='POST'){show_error('Método no permitido.',405);return;}
        $doc=$this->Documento_model->obtener_documento_por_id($id);
        $user=(int)$this->session->userdata('id_usuario');
        if(!$doc||(int)$doc['usuario_id']!==$user){show_404();return;}
        if($doc['estado']!=='Pendiente'){show_error('Solo puedes eliminar documentos pendientes.',400);return;}
        $deleted=$this->Documento_model->eliminarDocumento($id,$user);
        if($deleted){$file=FCPATH.'uploads/documentos/'.basename($doc['archivo_path']);if(is_file($file))@unlink($file);}
        redirect('Alumno/Dashboard_A/Dashboard');
    }
    public function agregar_tipo_documento()
    {
        $this->requireRole(array('Admin'));
        if($this->input->method(TRUE)!=='POST'){show_error('Método no permitido.',405);return;}
        $this->form_validation->set_rules('nombreTipoDocumento','Nombre','required|trim|max_length[100]');
        $this->form_validation->set_rules('propositoTipoDocumento','Propósito','required|trim|max_length[255]');
        $this->form_validation->set_rules('contenidoTipoDocumento','Contenido','required|trim|max_length[255]');
        if(!$this->form_validation->run()){redirect('Admin/Dashboard/Documentos');return;}
        $path=FCPATH.'uploads/Ejemplos/';
        if(!is_dir($path)||!is_writable($path)){ $this->session->set_flashdata('error','El directorio de ejemplos no está disponible.'); redirect('Admin/Dashboard/Documentos'); return; }
        $config=array('upload_path'=>$path,'allowed_types'=>'pdf|doc|docx','max_size'=>10240,'file_name'=>bin2hex(random_bytes(16)),'remove_spaces'=>TRUE,'detect_mime'=>TRUE,'mod_mime_fix'=>TRUE);
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('documento')){$this->session->set_flashdata('error',strip_tags($this->upload->display_errors('','')));redirect('Admin/Dashboard/Documentos');return;}
        $file=$this->upload->data();
        $this->Documento_model->agregarTipoDocumento($this->input->post('nombreTipoDocumento',TRUE),$this->input->post('propositoTipoDocumento',TRUE),$this->input->post('contenidoTipoDocumento',TRUE),$file['file_name']);
        redirect('Admin/Dashboard/Documentos');
    }
}