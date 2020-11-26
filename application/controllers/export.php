<?php

class Export extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        if($this->session->userdata('status') != "login"){
            redirect("c_login");
        }

        $this->load->model("m_user");
    }
    

     public function index(){
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
    $excel = new PHPExcel();
    $excel->getProperties()->setCreator('My Notes Code')
                 ->setLastModifiedBy('My Notes Code')
                 ->setTitle("Data User")
                 ->setSubject("User")
                 ->setDescription("Laporan Semua Data User")
                 ->setKeywords("Data User");
    $style_col = array(
      'font' => array('bold' => true), // 
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) 
      )
    );
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) 
      )
    );
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA USER");
    $excel->getActiveSheet()->mergeCells('A1:E1'); 
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); 
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAME"); 
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "EMAIL"); 
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "ROLES"); 

    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);

    $siswa = $this->m_user->getUser();
    $no = 1; 
    $numrow = 4; 
    foreach($siswa->result() as $data){
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->name);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->email);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->role_name);
     

      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
          
      $no++; 
      $numrow++; 
    }

    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); 
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 

    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
   
    $excel->getActiveSheet(0)->setTitle("Laporan Data User");
    $excel->setActiveSheetIndex(0);
   
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Data User.xlsx"'); 
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }

   
}