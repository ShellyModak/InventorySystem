<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import_new extends CI_Controller
{
 public function __construct()
 {
  parent::__construct();
  $this->load->model('excel_import_model');
  $this->load->library('excel');
 }

 function index()
 {
  $this->load->view('excel_import_new');
 }
 
 function fetch()
 {
  $data = $this->excel_import_model->select();
  $output = '
  <h3 align="center">Total Data - '.$data->num_rows().'</h3>
  <table class="table table-striped table-bordered">
   <tr>
    <th>Name</th>
    <th>Phone</th>
    <th>Address</th>
   </tr>';
  foreach($data->result() as $row)
  {
   $output .= '
   <tr>
    <td>'.$row->name.'</td>
    <td>'.$row->phone.'</td>
    <td>'.$row->address.'</td>
   </tr>';
  }
  $output .= '</table>';
  echo $output;
 }

 function import()
 {
  //echo "hello";die;

  if(isset($_FILES["file"]["name"]))
  {
    //echo $_FILES["file"]["tmp_name"];die;
   $path = $_FILES["file"]["tmp_name"];
   $object = PHPExcel_IOFactory::load($path);
   foreach($object->getWorksheetIterator() as $worksheet)
   {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    for($row=2; $row<=$highestRow; $row++)
    {
     $name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
     $phone = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
     $address = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
     $data[] = array(
      'name'  => $name,
      'phone'   => $phone,
      'address'    => $address
     );
    }
   }
   $this->excel_import_model->insert($data);
   echo 'Data Imported successfully';
  } 
 }
}

?>
