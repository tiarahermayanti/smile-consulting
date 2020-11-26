<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_model {

    function getUser(){
         $this->db->select('*');
        $this->db->from('users');
        $this->db->join('roles','users.role_id = roles.role_id');      
        return $this->db->get();
    }

    function getRoles(){
        return $this->db->get('roles');
    }
    
    function cek_login($table, $where){
        return $this->db->get_where($table, $where);
    }

    function insert($table, $data){
        return $this->db->insert($table, $data);
    }

    function update($table, $where, $data){
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    function delete($table, $where){
        $this->db->where($where);
        return $this->db->delete($table);
    }

    public function search($keyword){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->join('roles','users.role_id = roles.role_id');  
            $this->db->like('name',$keyword);
            $this->db->or_like('role_name',$keyword);
            return $this->db->get();
        }

    // Fungsi untuk melakukan proses upload file
  public function upload_file($filename){
    $this->load->library('upload'); // Load librari upload
    
    $config['upload_path'] = './excel/';
    $config['allowed_types'] = 'xlsx';
    $config['max_size']  = '2048';
    $config['overwrite'] = true;
    $config['file_name'] = $filename;
  
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }
  
  // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
  public function insert_multiple($data){
    $this->db->insert_batch('users', $data);
  }
    
}