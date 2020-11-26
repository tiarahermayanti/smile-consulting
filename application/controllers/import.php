<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {

  private $filename = "import_data";
  
  public function __construct(){
    parent::__construct();
    
    $this->load->model('m_user');
  }
  
  
  public function form(){
    $data = array();
    
    if(isset($_POST['preview'])){
      $upload = $this->m_user->upload_file($this->filename);
      
      if($upload['result'] == "success"){
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx');
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
        $data['sheet'] = $sheet; 
      }else{
        $data['upload_error'] = $upload['error']; 
      }
    }
    
    $this->template->load('header','form', $data);
  }
  
  public function import(){
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); 
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    $data = array();
    
    $numrow = 1;
    foreach($sheet as $row){
      if($numrow > 1){
        
        array_push($data, array(
          'name'=>$row['A'], 
          'email'=>$row['B'], 
          'password'=>$row['C'],
          'role_id'=>$row['D'], 
        ));
      }
      
      $numrow++; 
    }
   
    $this->m_user->insert_multiple($data);
    
    redirect("c_home/listUser"); 
  }
}