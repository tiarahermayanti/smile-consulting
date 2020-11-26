<?php

class C_login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model("m_user");
    }
    
    function index(){
        $this->load->view('login');
    }
    
     function aksi_login(){
        $email = htmlspecialchars($this->input->post('email',TRUE),ENT_QUOTES);
        $pass = htmlspecialchars(md5($this->input->post('pass')),ENT_QUOTES);
        
        $where = array('email' => $email,
                        'password' => $pass);
        
        $cek = $this->m_user->cek_login("users", $where);
        
        if($cek->num_rows() == 0){
            echo '<script language="javascript">';
            echo 'alert("Email atau kata sandi salah");';
             echo 'window.location= "'.base_url('index.php/c_login').'";';
            echo '</script>';
            
        } else {
             
            foreach ($cek->result() as $login){
            $data_session = array(
                'email' => $email,
                'status' => "login",
                'user_id' => $login->id,
                'user_name' => $login->name,
                'role' => $login->role_id
            );

                $this->session->set_userdata($data_session);
           
            }
            redirect("c_home");
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        redirect("c_login");
    }
}
