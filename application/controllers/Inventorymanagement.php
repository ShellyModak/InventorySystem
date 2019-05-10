<?php
class Inventorymanagement extends CI_Controller {
   // Controller class for site_settings
	function __construct()
	{
                parent::__construct();
                $this->load->library('session');
                $this->load->model('Common_model');
                
              
                $id= $this->session->userdata('id');
                
                $whereArr=array('id'=>$id);
                $admin_val_arr=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
        
        if(($admin_val_arr['result'][0]->pageAccess!="") && ($admin_val_arr['result'][0]->isSuperAdmin!=1))
        {
            
                $page_name=$this->uri->segment(1);
                
                $whereArr=array('link'=>$page_name);
                $page_id=$this->Common_model->getAllDataWithMultipleWhere('sidepanel',$whereArr,'id');
                $page_access=explode(",",$admin_val_arr['result'][0]->pageAccess);
              
        
                if(!in_array($page_id['result'][0]->id,$page_access))
                {
                      $this->session->set_userdata('error_msg', 'You have no access to '.$page_name);
                            redirect(base_url().'Login');  
                }

               //echo $id;
        }    
        if(!isset($id) && $id == '')
                {
                            $this->session->set_userdata('error_msg', 'Please login first to access this page.');
                            redirect(base_url().'Login');
                }
     
	   
 }
    
    function index()
	{
        $whereArr=array('status'=>"1", 'store_id'=>$this->session->userdata('StoreId'));
        $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id'); 
		$this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('Inventory-management/additem',$data);
        $this->load->view('includes/footer');
	}
    
    
    
    
    
    
    function add_rawmaterial()
	{
      
        
       
        $vendor= $this->input->post('box');
        $quantity=array_values(array_filter($this->input->post('quantity')));
      
        
        $price= array_values(array_filter($this->input->post('price')));
        $unit= $this->input->post('unit');
        $materialid= $this->input->post('materialid');
        $date= $this->input->post('date');
        $date= strtotime($date);
        $count=count($vendor);
       
        
        $quantityy=0;
        $Total_price=0;
        for($i=0;$i<$count;$i++)
        {
                
                $whereArr=array('id'=>$vendor[$i]);
                $data=$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'Vendor_id');
      
        
        
        
                if($data['result'][0]->wallet>=($price[$i]))
                {
                    $paid_amount=$price[$i];
                    $remaining_amount=0;
                    $wallet=$data['result'][0]->wallet-$paid_amount;

                }
                else
                {
                    $paid_amount=$data['result'][0]->wallet;
                    $remaining_amount=$price[$i]-$data['result'][0]->wallet;
                    $wallet=0;


                }

                $whereArr=array('id'=>$vendor[$i]);
                $data_ins=array('wallet'=>$wallet);
                $update=$this->Common_model->updateDetailsWithMultipleWhere('vendorType',$whereArr,$data_ins); 
            
           
            
            $data_ins=array(
                        'vendor_id' =>$vendor[$i],               
                        'quantity' => $quantity[$i],
                        'price'=>$price[$i],
                        'unit_id'  =>$unit,
                        'rawmaterial_id'  =>$materialid,
                        'timestamp'  =>$date,
                        'paid_amount' =>$paid_amount,
                        'remaining_amount'  =>$remaining_amount,
                          
                        'storeId'=>$this->session->userdata('StoreId'),
                        'admin_id'=>$this->session->userdata('id')
                    
                                );
        $insert=$this->Common_model->insertData('Raw_material_inventory',$data_ins);
           
        
        $quantityy=$quantityy+$quantity[$i];
        $Total_price=$Total_price+$price[$i];
       
        }
     
        
        $whereArr=array('material_id'=>$materialid);
        $data=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
       
        
        if($data['result'][0]->quantity==0 && $data['result'][0]->avg_price==0)
        {
           $total_quantity=$quantityy;
            $avg_price=floor($Total_price/$quantityy);
        }
       
        else
        {
           $table_total_price=($data['result'][0]->avg_price*$data['result'][0]->quantity);
            $Total_price=$Total_price+$table_total_price;
             $total_quantity=$quantityy+$data['result'][0]->quantity;
            $avg_price=floor($Total_price/$total_quantity);
            //echo $table_total_price.",".$Total_price.",".$total_quantity;
            
        }
        
        $whereArr=array('material_id'=>$materialid);
        $dataArr=array('quantity'=>$total_quantity,'avg_price'=>$avg_price);
        $data=$this->Common_model->updateDetailsWithMultipleWhere('RawMaterial',$whereArr,$dataArr);
        
        if($insert)
        {
        $this->session->set_userdata('msg', 'Rawmaterial added to inventory successfully');
        $this->session->set_userdata('err_msg', '');
        }
        else{
          $this->session->set_userdata('msg', '');
         $this->session->set_userdata('err_msg', 'Rawmaterial not added to inventory ');
        }
        redirect(base_url().'Inventorymanagement/index'); 
       
	}
    
    
    function addModalContent()
    {
        $material_id=$this->input->post('Material_id');
        
         

?>
        
        
    <div class="modal-content" >
        <div class="modal-header">
                           
             <?php      $whereArr=array('material_id'=>$material_id);
                        $rawmaterial_name=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id'); ?>
            
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                 
        <h4 class="modal-title"><center><?php echo Ucfirst($rawmaterial_name['result'][0]->material_name);?></center></h4>
         
          <h4 class="modal-title"></h4>
        </div>
        
             <?php    
             if($rawmaterial_name['result'][0]->vendor_id=="")
             {?>
        <div class="modal-body">
            <a href='<?php echo base_url(); ?>Material_cont/show/<?php echo $material_id;?>' ><button type="button" class="btn btn-primary btn-block" >Add Vendor First</button></a>
        </div>
        
       <?php }
        
       else{ ?>  
        
        <form id="checkbox" method="post" action="<?php echo base_url();?>Inventorymanagement/add_rawmaterial/"> 
                            
                            
        <div class="modal-body">
                      
                     
                                 

                          
                <table class="table table-bordered table-striped table-condensed" style="table-layout: fixed;" >
                    <thead>
                        <tr>
                            <?php
                            $whereArr=array('unit_id'=>$rawmaterial_name['result'][0]->unit_id);
                            $unit_name =$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArr,'unit_id');?>
                                   
                            <th class="numeric" >Vendor </th>
                            <th class="numeric">Quantity( <?php echo ucfirst($unit_name['result'][0]->unit_name);?> )</th>
                            <th class="numeric">Total Price</th>
                            <th class="numeric">Price/<?php echo ucfirst($unit_name['result'][0]->unit_name);?></th>
                            
                               

                            
                                    
                        </tr>
                    </thead>
                 
                    
    <tbody>   
             
      <?php             
   
            $array=explode(",",$rawmaterial_name['result'][0]->vendor_id);  
            foreach($array as $value){
                                           
            $whereArr=array('id'=>$value);
            $vendor_name =$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'id');
            if($vendor_name['result'][0]->status==1){
                                            
                                            
                                            
             ?>  
                            <tr class="priceQuantityTable"> 
                                <td><input class="checkbox checkbox-inline checkbox-primary checkbox-sm styled checkbox_box" style="height: 20px;width: 20px;" type="checkbox" id="box" name="box[]" value="<?php echo $value;?>"><?php echo " ".ucfirst($vendor_name['result'][0]->name." ");?>
                                <span id="box_error_<?php echo $value;?>" style="color:red"></span>
                                </td> 
                                
                                <td><input class="form-control  text input_quantity" type="number"  id="quantity_<?php echo $value;?>" name="quantity[]" min="1" onkeyup="avgShow('<?php echo $value;?>');">
                                <span id="quantityvalue_error_<?php echo $value;?>" style="color:red"></span></td> 
                                
                <td> <input class="form-control text input_price" type="number"  id="price_<?php echo $value;?>" name="price[]" min="1" onkeyup="avgShow('<?php echo $value;?>');">
                                <span id="price_error_<?php echo $value;?>" style="color:red"></span></td>
                                
                                <td> <input class="form-control  text " type="text"  id="avg_price_<?php echo $value;?>" >
                               </td>
                                
                                  <input class="form-control round-input" type="hidden"  id="unit" name="unit" value="<?php echo $rawmaterial_name['result'][0]->unit_id;?>">
                                
                                <input class="form-control round-input " type="hidden"  id="materialid" name="materialid" value="<?php echo $material_id;?>">
                                
                                <input class="form-control round-input " type="hidden"   name="date" value="<?php echo  date('d-m-Y h:ia'); ?>">

                           </tr> 
             
                                <?php     }
                                        } ?>
                                    
                        </tbody>
                                  
                </table>
                          
                          
                          
                        
                          
                           
                      </div>
                     
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button" >Cancel</button>
                          <button class="btn btn-success" type="button" onclick="valiadation();" >Save</button>
                      </div>
                    </form>
                          <?php  }?>
                  </div>
        
        
   <?php }
    
     function search_by_date()
	{
    
            $date =$this->input->post('date');
            
            
            if($date==date('m/d/Y')){
                echo "1";
            }
        
         
         
         
         else{
         
         
         
    
            $date = new DateTime($date);
            $date=$date->format('d-m-Y');
           
         
            $timestamp=strtotime($date);
            
            
            $whereArr=array('timestamp'=>$timestamp,'storeId'=>$this->session->userdata('StoreId'));
            $data=$this->Common_model->getAllDataWithMultipleWhere('update_raw_material',$whereArr,'id');
           ?>
    
         
    <div class="adv-table">
         
             <h1><?php    $new_date = new DateTime($this->input->post('date'));
                            echo $new_date->format('d-M-Y'); ?></h1>
             <table  class="display table table-bordered table-striped" id="dynamic-table">
                  
                <thead>
                   <tr>
                                   
                            <th class="numeric">Raw Material</th>
                            <th class="numeric">In Stock</th>
                            <th class="numeric">Avg Price</th>
                    
                           
                               
             
                            
                                    
                    </tr>
                </thead>
    
                <tbody> 
 <?php   if($data['num_row']>0){
                       
                            foreach ($data['result'] as $row)  
                            {
                            $whereArr=array('unit_id'=>$row->material_id);
                            $unit_name =$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArr,'unit_id');
                    
                            
                            $whereArr=array('material_id'=>$row->material_id);
                            $material_name =$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
                    
                           
                    
                    ?>
                    
                         <tr> 
                             
                                <td><?php echo $material_name['result'][0]->material_name;?></td> 
                                <td><?php echo $row->quantity." ".$unit_name['result'][0]->unit_name;?></td> 
                                 <td><?php echo "Rs ".$row->avg_price;?></td> 
                              

                           </tr>  
                                  

                        
                       
                 
                
                        <?php
                            }
                        }
                        else
                        {echo "No result found";}
                            
         
                              ?>                           
                 </tbody>
                         
               
                   </table>        
                              
       
    
                        </div>
                  
    
         
         
         
         
         
         
         
         
         
    
    
    
    
 <?php    }
            }
    
    
    
    
    
    
    
    
    
   
}