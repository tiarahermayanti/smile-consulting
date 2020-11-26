<?php

class C_home extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        if($this->session->userdata('status') != "login"){
            redirect("c_login");
        }

        $this->load->model("m_user");
    }
            
    function index(){
    	
    	$this->template->load('header','home');
    }

    function listUser(){
    	$data['user'] = $this->m_user->getUser();
    	$data['role'] = $this->m_user->getRoles();
    	$this->template->load('header','v_list_user', $data);
    }
 
    function createUser(){
    	$email = htmlspecialchars($this->input->post('email',TRUE),ENT_QUOTES);
        $name = htmlspecialchars($this->input->post('name',TRUE),ENT_QUOTES);
        $pass = htmlspecialchars(md5($this->input->post('password')),ENT_QUOTES);
        $role = htmlspecialchars($this->input->post('role',TRUE),ENT_QUOTES);

       $data = array("name"=> $name,
                    "email"=> $email,
                     "password"=> $pass,
                      "role_id"=> $role);

        $status = $this->m_user->insert('users',$data);

        if ($status == true) {         
            redirect('c_home/listUser');    
         } else {
            echo '<script language="javascript">';
            echo 'alert("Failed to insert data");';
             echo 'window.location= "'.base_url('index.php/c_home/listUser').'";';
            echo '</script>';
         }

        redirect();
    }

     function updateUser(){
      $id = htmlspecialchars($this->input->post('edit_id',TRUE),ENT_QUOTES);
      $email = htmlspecialchars($this->input->post('xemail',TRUE),ENT_QUOTES);
        $name = htmlspecialchars($this->input->post('xname',TRUE),ENT_QUOTES);
        $pass = htmlspecialchars(md5($this->input->post('xpassword')),ENT_QUOTES);
        $role = htmlspecialchars($this->input->post('xrole',TRUE),ENT_QUOTES);

       $data = array("name"=> $name,
                    "email"=> $email,
                     "password"=> $pass,
                      "role_id"=> $role);

       $where = array("id" => $id);

        $status = $this->m_user->update('users',$where,$data);

        if ($status == true) {         
            redirect('c_home/listUser');    
         } else {
            echo '<script language="javascript">';
            echo 'alert("Failed to update data");';
             echo 'window.location= "'.base_url('index.php/c_home/listUser').'";';
            echo '</script>';
         }

        redirect();
    }

    function deleteUser(){
        $kode=$this->input->post('hapus_id');
        $where = array('id' => $kode);
        $status = $this->m_user->delete('users',$where);
        
         if ($status == true) {         
            redirect('c_home/listUser'); 
         } else {
            echo '<script language="javascript">';
            echo 'alert("Failed to delete data");';
             echo 'window.location= "'.base_url('index.php/c_home/listUser').'";';
            echo '</script>';
         }
    }

    function search(){
        $keyword = htmlspecialchars($this->input->post('search',TRUE),ENT_QUOTES);
        $data['user'] = $this->m_user->search($keyword);
        $data['role'] = $this->m_user->getRoles();
        $this->template->load('header','v_list_user', $data);
    }



   
}