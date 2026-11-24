<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Documento_model extends CI_Model
{
    public function guardar_documento($tipoDocumento,$titulo,$nombreArchivo,$maestro_id)
    {
        return $this->db->insert('documentos',array(
            'usuario_id'=>(int)$this->session->userdata('id_usuario'),
            'titulo'=>trim($titulo),'archivo_path'=>basename($nombreArchivo),
            'estado'=>'Pendiente','fecha_subida'=>date('Y-m-d H:i:s'),
            'maestro_id'=>(int)$maestro_id
        ));
    }
    public function obtener_todos_archivos()
    {
        return $this->db->order_by('fecha_subida','DESC')->get('documentos')->result_array();
    }
    public function obtener_maestros()
    {
        return $this->db->where('tipo_usuario','Profesor')->order_by('nombre','ASC')->get('usuarios')->result_array();
    }
    public function obtener_documentos_del_alumno($usuario_id)
    {
        return $this->db->where('usuario_id',(int)$usuario_id)->order_by('fecha_subida','DESC')->get('documentos')->result_array();
    }
    public function obtener_documentos_pendientes_del_maestro($maestro_id)
    {
        return $this->db->select('documentos.*, usuarios.nombre AS nombre_alumno, usuarios.apellidos AS apellidos_alumno')
            ->from('documentos')->join('usuarios','usuarios.id=documentos.usuario_id')
            ->where('documentos.maestro_id',(int)$maestro_id)->where('documentos.estado','Pendiente')
            ->order_by('documentos.fecha_subida','DESC')->get()->result_array();
    }
    public function obtener_documento_por_id($id)
    {
        return $this->db->where('id',(int)$id)->limit(1)->get('documentos')->row_array();
    }
    public function procesar_rechazo_documento($id,$motivo,$maestro_id)
    {
        return $this->db->where('id',(int)$id)->where('maestro_id',(int)$maestro_id)->where('estado','Pendiente')
            ->update('documentos',array('estado'=>'Rechazado','motivo'=>trim($motivo)));
    }
    public function eliminarDocumento($id,$usuario_id)
    {
        return $this->db->where('id',(int)$id)->where('usuario_id',(int)$usuario_id)
            ->where('estado','Pendiente')->delete('documentos');
    }
    public function aceptarDocumento($id,$comentario,$maestro_id)
    {
        return $this->db->where('id',(int)$id)->where('maestro_id',(int)$maestro_id)->where('estado','Pendiente')
            ->update('documentos',array('estado'=>'Aceptado','motivo'=>trim((string)$comentario)));
    }
    public function obtener_tipos_documentos()
    {
        return $this->db->order_by('nombre','ASC')->get('tipos_documentos')->result_array();
    }
    public function agregarTipoDocumento($nombre,$proposito,$contenido,$path)
    {
        return $this->db->insert('tipos_documentos',array(
            'nombre'=>trim($nombre),'proposito'=>trim($proposito),
            'contenido'=>trim($contenido),'documento_path'=>basename($path)
        ));
    }
    public function maestroExiste($id)
    {
        return $this->db->where('id',(int)$id)->where('tipo_usuario','Profesor')->count_all_results('usuarios')===1;
    }
}