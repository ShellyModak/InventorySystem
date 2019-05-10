<?php
class ItemStockManagement extends CI_Controller {
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
	   $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		
		 $whereArr = array('status' => '1','store_id'=>$this->session->userdata('StoreId'));
	     $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
		//$data['listing']=$this->Common_model->fetchAllData('Item','item_id','DESC');
		//echo "<pre>";print_r($data);die;
		
		$this->load->view('ItemStockManagement/itemstock',$data);

        $this->load->view('includes/footer');
	}
	function addOrder(){

        $data['item']=$this->Common_model->fetchAllData('Item','item_id','DESC');
        
        $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('ItemStockManagement/addorder',$data);
        $this->load->view('includes/footer');
    }

//===========================for calculate=========================================//
    function calculate()
    {
        
        $item_id=$this->input->post('item_id');
        $stock=$this->input->post('stock');
        $price=$this->input->post('price');
        $quantity_ajax=$this->input->post('quantity');
        $total=$quantity_ajax*$price;
        echo $total;

        
    }
    //==================================end for calculate=====================================//
    
    
    function placeOrder()
        
    {
        
      $QuantityArray=array();
      $basePriceArray=array();
      $itemIdArray=array();
       $itemArry=$this->input->post('array');
        
        
         
         
        // echo "hii".$this->input->post('phone');
        $where =array('customer_phone' =>$this->input->post('phone'),'store_id'=>$this->session->userdata('StoreId'));
        $customerAr=$this->Common_model->getAllDataWithMultipleWhere('Customer',$where,'customer_id','ASC');
        if($customerAr['num_row']>0)
        {
             $data_to_store=array('customer_name' =>$this->input->post('name'));
             $whereArr = array('customer_id' => $customerAr['result'][0]->customer_id);
             $update_data = $this->Common_model->updateDetailsWithMultipleWhere('Customer',$whereArr,$data_to_store);
            
            $insrtCustomer_data=$customerAr['result'][0]->customer_id;
        }
       else
       {
    
         $customerId="CU".rand(000,999);
    
    
     $data_to_insert=array(
                    'customer_phone' =>$this->input->post('phone'),
                    'customer_name'=>$this->input->post('name'),
                    'customer_no'=>$customerId,
                    'customer_type'=>"0",
                    'store_id'=>$this->session->userdata('StoreId')
                    );
                    
          $insrtCustomer_data=$this->Common_model->insertData('Customer', $data_to_insert); 
       }
       
      $orderNo="OD".rand(000,999);
      $sl=1;
       foreach($itemArry as $value)
       {   
           
           $where =array('item_id' =>$value[1]);
           $itemAr=$this->Common_model->getAllDataWithMultipleWhere('Item',$where,'item_id','ASC');

            $total_stock=$itemAr['result'][0]->stock-$value[0];
          
            $whereArray = array('item_id'=>$value[1]);       
           $data_to_insert=array(
                    'stock' => $total_stock
                        );
          $update_data = $this->Common_model->updateDetailsWithMultipleWhere('Item',$whereArray,$data_to_insert);
        
           array_push($itemIdArray,$value[1]);
         
          


        $basePrice=number_format($value[3],2);  
        array_push($basePriceArray,$basePrice);
        
         array_push($QuantityArray,$value[0]);
           
       }
           
        
       $basePrice=$value[3]/$value[0];  
         $data_to_insert=array(
                    'order_no' =>$orderNo,
                    'item'=>implode(",",$itemIdArray),
                     'base_price'=>implode(",",$basePriceArray),
                     'quantity'=>implode(",",$QuantityArray),
                     'paidAmount'=>$this->input->post('price'),
                     'customer_id'=>$insrtCustomer_data,
                     'orderDate'=>date("d-m-Y"),
                      'storeId'=>$this->session->userdata('StoreId'),
                      'originalprice'=>$this->input->post('originalprice'),
                      'discountAmount'=>$this->input->post('discountAmount'),
                       
                        );
                    
          $insrt_data=$this->Common_model->insertData('Order', $data_to_insert); 
           
        echo $insrt_data;
        
        
        
    }
      
    
function insertOrder(){
    
     
       $itemArry=$this->input->post('array');
      
        
         
         
        
      
      $sl=1;
       foreach($itemArry as $value)
       {   
           
           $where =array('item_id' =>$value[1]);
           $itemAr=$this->Common_model->getAllDataWithMultipleWhere('Item',$where,'item_id','ASC');

            
        
           
         
          

?>

             <tr>
                 <td><?php echo $sl++;?></td>
                  <td><?php echo $itemAr['result'][0]->item_name;?></td>
                  <td><?php echo $value[0];?></td>
                  <td><?php echo $value[3]*$value[0];?></td>

            </tr>
         
<?php
       }
       

}
          
    


    function generateField()
    {
        $count = $this->input->post('count');
        $nxtCount = $count + 1;
        
        
        $where =array('stock<>'=>'0','store_id'=>$this->session->userdata('StoreId'));
        $item=$this->Common_model->getAllDataWithMultipleWhere('Item',$where,'item_id','ASC');
        
       //item=$this->Common_model->fetchAllData('Item','item_id','DESC');
       
        ?>
<div class="parent" id="div_<?php echo $nxtCount;?>">
    <div class="form-group col-lg-12 srchFlds test">
            
         <div class="col-lg-2">
              <label class="control-label">Item</label>
            <select name="fld_label1[]" style="color: black" class=" form-control item_test<?php echo $nxtCount;?>"  id="fld_label1" label="Unit" onchange="select(<?php echo $nxtCount;?>,'');">

            <option value="" >Select</option>
         <?php 
                foreach($item['result'] as $row){
                     ?>
              <option value="<?php echo $row->item_id;?>"><?php echo ucfirst($row->item_name)?></option> 
         <?php  }     
                    ?>
               
                  </select>

                  <span id="item_error<?php echo $nxtCount;?>" style="color: red"></span><br>
              </div>
             <div class="col-lg-2">
                   <label>In Stock <span style="color: red;"></span>:</label>
                   <input  type="text" style="color: black" class="form-control  stock stock_test<?php echo $nxtCount;?>"  value="" id="fld_label2" name="fld_label2[]" label="Field Label" readonly >
            </div>
              
          <div class="col-lg-2">
                   <label>Price Per Unit<span style="color: red;"></span>:</label>
                   <input  type="text" style="color: black" class="form-control price_per_unit price_per_unit_test<?php echo $nxtCount;?>" id="fld_label5" name="fld_label5[]" label="Field Label" value="" readonly >
               </div>
        
             
              <div class="col-lg-2">
                   <label>Quantity <span style="color: red;"></span>:</label>
                   <input  type="number" onblur="selectTwo(this.value,'<?php echo $nxtCount;?>')" style="color: black" class="form-control qty_test<?php echo $nxtCount;?>" id="fld_label4" name="fld_label4[]" label="Field Label" min="0"  value="" >
                   <span id="qty_error<?php echo $nxtCount;?>" style="color: red"></span><br>
               </div>
             <div class="col-lg-2">
                   <label>price (Rs.)<span style="color: red;"></span>:</label>
                   <input  type="text" style="color: black" class="form-control price price_test<?php echo $nxtCount;?>" id="fld_label3" name="fld_label3[]" label="Field Label" value="" readonly >
               </div>

              
              
            <div class="col-lg-2" style="margin-top: 30px;"  id="actionBtn_<?php echo $nxtCount;?>">
                
                
                
                
                
               <span> <i style="font-size: 25px;" class="fa" onclick="addMore('add', '<?php echo $nxtCount;?>');"></i></span> &nbsp;&nbsp; 
                <?php
                if($nxtCount > 1)
                {
                ?>
                <span> <i style="font-size:24px" class="fa" onclick="addMore('remove', '<?php echo $nxtCount;?>');"></i></span>
                
                <?php
                }
                ?>
            </div>

</div>
</div>
<?php
    }


function fetch_data()
{

    $item=$this->input->post('item');
    $whereArrayLogin = array('item_id'=>$item);        
    $data['item']=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArrayLogin,'item_id');
    echo (json_encode($data));
    //print_r($data['item']);

 // if($this->input->post('item'))
 // {
 //  echo $this->dropdown_model->fetch_state($this->input->post('country_id'));
 // }
}
    
    
function priceCalculate()
{

    $itemId=$this->input->post('itemId');
     $quantity=$this->input->post('quantity');
    
    $whereArray = array('item_id'=>$itemId);        
    $data=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArray,'item_id');
    $totalPrice=$data['result'][0]->price*$quantity;
    echo $totalPrice."Arnab".$data['result'][0]->stock;
    
}
    
    
    
    


function check_name()
{

  $phn=$this->input->post('phoneNumber');
 
   $price=$this->input->post('price');
    
  $whereArr = array('customer_phone' => $phn,'store_id'=>$this->session->userdata('StoreId'));
    
   
       
 $data=$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArr,'customer_no');
 $discountAmount=0;
 if($data['num_row']>0)
 {
        $name= $data['result'][0]->customer_name;
    if($data['result'][0]->customer_type!=0)
    {
        $whereArr = array('id' => $data['result'][0]->customer_type);
         $customerTypeArr=$this->Common_model->getAllDataWithMultipleWhere('customer_type',$whereArr,'id');
    
    
        if($customerTypeArr['result'][0]->discount_type==1 && ($price>=$customerTypeArr['result'][0]->min_amount))
        {     
            $price=$price-$customerTypeArr['result'][0]->amount;
            $discountAmount=$customerTypeArr['result'][0]->amount;
        }
             
        else if($customerTypeArr['result'][0]->discount_type==2 && ($price>=$customerTypeArr['result'][0]->min_amount))
        {  
            $price=$price-(($price*$customerTypeArr['result'][0]->amount)/100);
            $discountAmount=$customerTypeArr['result'][0]->amount."%";
        }
             
        else 
        {
            $price=$price;
        }
        
    }
  }
 else
 {
     $name="";
     $price=$price;
 }
       
        echo $name."esolz".$price."esolz".$discountAmount;

}


function stockupdate()
{
    
        
    
        $Quantity=$this->input->post('quantity');
		    $ItemId=$this->input->post('id');
		    $stock=$this->input->post('stock');
            $count=$stock;
        //echo $Quantity.'========'.$ItemId."========".$stock;die;
		

         $whereArrItem = array('item_id' => $ItemId);
         $itemMaterialData=$this->Common_model->getAllDataWithMultipleWhere('Item_material',$whereArrItem,'id');
    
        $string="";
    
    
foreach($itemMaterialData['result'] as $itemMaterial)
{    
    
     $substring="";
    
      //rawmaterials details
     $materialId = $itemMaterial->material_id;
      $whereArrItem = array('material_id' => $materialId);
     $RawMaterialData=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArrItem,'material_id');
    
     $whereArr = array('unit_id' => $RawMaterialData['result'][0]->unit_id);
     $RawMaterialUnitData=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArr,'unit_id');
    
    
      $RawMaterialquotient=1/$RawMaterialUnitData['result'][0]->value;  
      $totalRawMaterialQuantity=($RawMaterialData['result'][0]->quantity*$RawMaterialquotient);
    
    
    
    //cooking rawmaterials details
    
    $CookingmaterialUnitId= $itemMaterial->unit_id;
    $CookingmaterialQuantity=$itemMaterial->quantity;
     $whereArr = array('unit_id' => $CookingmaterialUnitId);
    $CookingmaterialUnitData=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArr,'unit_id');
    
    $CookingmaterialtoDivide=$CookingmaterialUnitData['result'][0]->value;
    $Cookingmaterialquotient=1/$CookingmaterialtoDivide;  
    $totalCookingmaterialQuantity=$Quantity*($CookingmaterialQuantity*$Cookingmaterialquotient);
    
    
    while($Quantity!=0)
        { 
             if($totalRawMaterialQuantity>=$totalCookingmaterialQuantity)
             {
                $totalCookingmaterialQuantity=$Quantity*($CookingmaterialQuantity*$Cookingmaterialquotient);
                $materialName=$RawMaterialData['result'][0]->material_name;
                break;
             }
             $substring=$RawMaterialData['result'][0]->material_name; 

            
             $Quantity=$Quantity-1;
             $totalCookingmaterialQuantity=$Quantity*($CookingmaterialQuantity*$Cookingmaterialquotient);
             $stock=$stock-1;
           
        }
    
    $string.=$substring;
   
}
$count=$count-$stock;
        
  
if($Quantity>0) 
{        
        
    foreach($itemMaterialData['result'] as $itemMaterial)
    {
//         cooking raw material details
         
             $materialId = $itemMaterial->material_id;
             $CookingmaterialUnitId= $itemMaterial->unit_id;
             $CookingmaterialQuantity=$itemMaterial->quantity;

             $whereArr = array('unit_id' => $CookingmaterialUnitId);
             $CookingmaterialUnitData=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArr,'unit_id');
             
           
             
             
//       raw material details      
              $whereArrItem = array('material_id' => $materialId);
              $RawMaterialData=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArrItem,'material_id');
              $RawmaterialQuantity=$RawMaterialData['result'][0]->quantity;
              $RawMaterialAvgprice=$RawMaterialData['result'][0]->avg_price;
             
             $whereArr = array('unit_id' => $RawMaterialData['result'][0]->unit_id);
             $RawMaterialUnitData=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArr,'unit_id');
             
         
    
         
        
             if($RawMaterialUnitData['result'][0]->unit_name !="pic")
             
            {     
                 
                  $RawMaterialtoDivide=$RawMaterialUnitData['result'][0]->value;
                  $RawMaterialquotient=1/$RawMaterialtoDivide;  
                  $totalRawMaterialQuantity=($RawmaterialQuantity*$RawMaterialquotient);


                  $CookingmaterialtoDivide=$CookingmaterialUnitData['result'][0]->value;
                  $Cookingmaterialquotient=1/$CookingmaterialtoDivide;  
                  $totalCookingmaterialQuantity=$Quantity*($CookingmaterialQuantity*$Cookingmaterialquotient);
                 
                 
                 $netRawMaterialPresent= $totalRawMaterialQuantity-$totalCookingmaterialQuantity;
                 
                 
                 if($RawMaterialtoDivide>1)
                 {
                     $netRawMaterialPresent=$netRawMaterialPresent*$RawMaterialtoDivide;
                 }

                 else
                 {
                     $netRawMaterialPresent=$netRawMaterialPresent;
                 }
                 
               
                 
                  if($netRawMaterialPresent==0)
                  {
                      $RawMaterialAvgprice=0.00;
                  }
                 
                  
                 
            }
            else
            {
                $netRawMaterialPresent= $RawmaterialQuantity-$CookingmaterialQuantity;
                
            }
             
        
        
                  $whereArray = array('material_id' => $materialId); 
                  $data_to_insert=array(
                                    'quantity' =>$netRawMaterialPresent,
                                    'avg_price'=>number_format($RawMaterialAvgprice,2),
                                        );
                  $update_data = $this->Common_model->updateDetailsWithMultipleWhere('RawMaterial',$whereArray,$data_to_insert);   
                 
             
        
                 
    }
    
                
                 
                $whereArrItem = array('item_id' => $ItemId);
                $data_to_storeItem=array('stock' => $stock);
                $update_data = $this->Common_model->updateDetailsWithMultipleWhere('Item',$whereArrItem,$data_to_storeItem); 
    
              
}
      echo $stock."esolz".$string."esolz".$count;
}
    
function viewOrderDetails()
{
    
    
       $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
        $this->load->view('ItemStockManagement/viewOrderDetails');
        $this->load->view('includes/footer');
    
}

function item()
{
   $array=$this->input->post('array');
    
$itemArray=$this->input->post('itemArray');
  
   
    
$count=count($array);
    
   

    
    
  
$where =array('stock<>'=>'0','store_id'=>$this->session->userdata('StoreId'));
$itemAr=$this->Common_model->getAllDataWithMultipleWhere('Item',$where,'item_id','ASC');   
    


$nxtcount=1; $i=0;
foreach($array as $values)
{
     
      
    
    if(!empty($itemArray))
    {
     
        foreach($itemArray as $key=>$value)
        {
             if($value[1]==$values[0])
             {
                 $key=$key;
                break; 
             }
        }
    }
 
?>
  
      <div class="parent" id="div_<?php echo $nxtcount;?>">

          <div class="form-group col-lg-12 srchFlds test">
          
            <div class="col-lg-2">
              <label class="control-label">Item</label>
                
                
              <select name="fld_label1[]" style="color: black" class="form-control item_test<?php echo $nxtcount;?>"  id="fld_label1" label="Unit" onchange="select(<?php echo $nxtcount;?>,'');">   
                
                
            

            <option value="" >Select</option>
         <?php 
                foreach($itemAr['result'] as $row) 
               {?>
              <option value="<?php echo $row->item_id;?>" <?php if($values[0]==$row->item_id) echo "selected";?>><?php echo ucfirst($row->item_name)?></option> 
         <?php  }     ?>
               
             </select>
                  <span id="item_error<?php echo $nxtcount;?>" style="color: red"></span><br>
              </div>

             <div class="col-lg-2">
                   <label>In Stock <span style="color: red;"></span>:</label>
                   <input  type="text" style="color: black" class="form-control stock stock_test<?php echo $nxtcount;?>" id="fld_label2" name="fld_label2[]" label="Field Label" value="<?php echo $values[1];?>" readonly>
                   <span id="stk_error" style="color: red"></span><br>
               </div>
              
              
              
                <div class="col-lg-2">
                   <label>Price Per Unit<span style="color: red;"></span>:</label>
                   <input  type="text" style="color: black" class="form-control price_per_quantity price_per_quantity_test<?php echo $nxtcount;?>"  id="fld_label5" name="fld_label5[]" label="Field Label" value="<?php echo $values[2];?>"  readonly>
               </div>
              
              
           
             
              
              
              <div class="col-lg-2">
                    <?php if(!empty($itemArray)) {$value=$itemArray[$key][0];}else{$value=1;}?>
                    <label>Quantity <span style="color: red;"></span>:</label>
                   <input  type="number" onblur="selectTwo(this.value,'<?php echo $nxtcount;?>')" style="color: black" class="form-control qty_test<?php echo $nxtcount;?>" id="fld_label4" name="fld_label4[]" label="Field Label" min="0"  value="<?php echo $value;?>" >
                  
    
                 <span id="qty_error<?php echo $nxtcount;?>" style="color: red"></span><br>
               </div>

                <div class="col-lg-2">
                  <?php if(!empty($itemArray)){
                    $price=$itemArray[$key][0]*$itemArray[$key][3];}else{$price=$values[2];}?>
                   <label>price (Rs.)<span style="color: red;"></span>:</label>
                   <input  type="text" style="color: black" class="form-control price price_test<?php echo $nxtcount;?>"  id="fld_label3" name="fld_label3[]" label="Field Label" value="<?php echo $price;?>"  readonly>
               </div>

             
              
             <div class="col-lg-2" style="margin-top: 30px;"  id="actionBtn_<?php echo $nxtcount;?>">
                    <?php
                    if($count==1){ ?>
                   <span> <i style="font-size: 25px;" class="fa" onclick="addMore('add', '<?php echo $nxtcount;?>');"></i></span>
                    <?php
                     }
                       
                   else  if($count==$nxtcount)
                     {
                    ?>
                      
               <span> <i style="font-size: 25px;" class="fa" onclick="addMore('add', '<?php echo $nxtcount;?>');"></i></span> &nbsp;&nbsp; 
                  <span> <i style="font-size:24px" class="fa" onclick="addMore('remove', '<?php echo $nxtcount;?>');"></i></span>
                  <?php }
                     else if($nxtcount!=1){ ?>
                    <span> <i style="font-size:24px" class="fa" onclick="addMore('remove', '<?php echo $nxtcount;?>');"></i></span>
                    <?php
                     }
                    
                    
                    ?>
                 
               </div>
              
    </div>
</div>
    
<?php 
    
    $nxtcount++;
   
      }
    }
    
function addingOrder()
{
    
    $phone=$this->input->post('phone');
    $price=$this->input->post('price');
    $order=$this->input->post('order');
    $name=$this->input->post('name');
    
    $whereArray = array('customer_phone'=>$phone); 
    $customerAr=$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArray,'customer_id','ASC');
   
    $insrt_data=$customerAr['result'][0]->customer_id;
        
    if($customerAr['num_row']==0)
    {
         $data_to_insert=array(
                    'customer_phone' =>$phone,
                    'customer_name'=>$name,
                    'customer_no'=>"CU".rand(000,999),
                    'store_id'=>$this->session->userdata('StoreId')
                    );
                    
          $insrt_data=$this->Common_model->insertData('Customer', $data_to_insert); 
    }
    
        
    $whereArray = array('order_no'=>$order); 
    $data_to_insert=array(
                    'customer_id' =>$insrt_data,
                    'paidAmount'=>$price,
                    'orderDate'=>date('d-m-Y'),
                     'storeId'=>$this->session->userdata('StoreId')
                        );
    $update_data = $this->Common_model->updateDetailsWithMultipleWhere('Order',$whereArray,$data_to_insert);
   
}
    
    



}

	
