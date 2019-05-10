<!--main content start-->
   <section id="main-content">
       <section class="wrapper">
       <!-- page start-->

       <div class="row">
           <div class="col-sm-12">
               <section class="panel">
                   <header class="panel-heading">
                       Order Details
                       <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-cog"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                   </header>
                   <?php if($this->session->userdata('success_msg') !=''){?>
                   <div class="alert alert-success message">
                  <strong>Success! </strong><span class=""><?php echo $this->session->userdata('success_msg'); ?></span> 
                  </div>
                  <?php
                    $this->session->unset_userdata('success_msg');
                   }?>
                   <div class="panel-body">
                    <button type="button" class="btn btn-primary btn pull-right" onclick="location.href='<?php echo base_url(); ?>ItemStockManagement/addOrder'">Add Order</button>
                   <div class="adv-table">
                       
                   <table  class="display table table-bordered table-striped" id="dynamic-table">
                   <thead>
                   <tr>
                                   
                                    <th class="numeric">Order No</th>
                                  <!--  <th class="numeric">Customer Id</th>-->
                                    <th class="numeric">Customer Name</th>
                                    <th class="numeric">Item</th>
                                   <!-- <th class="numeric">Quantity</th>-->
                                    <th class="numeric">Total Amount</th>
                                   <!-- <th class="numeric">PageAccess</th>-->
                                    <th class="numeric">Option</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    <?php  
          if(count($listing)>0){
            
         foreach ($listing['result'] as $row)  
         { 
            $customer_id=$row->customer_id;
            //$whereArr = array('customer_no' => $customer_id);
            $whereArr = array('customer_id' => $customer_id);
            $customer_name=$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArr,'customer_id');
            //echo "<pre>";print_r($row);die;
            $name=array();
            $item=$row->item;
              $newitem=explode(",",$item);
              $total=count($newitem);
            for($i=0;$i<$total;$i++){
              $itemname=$newitem[$i];
              $wherearr=array('item_id'=>$itemname);
              $item_name=$this->Common_model->getAllDataWithMultipleWhere('Item',$wherearr,'item_id');
              //echo $item_name['result'][0]->item_name;
              if(!empty($item_name['result'])){
              array_push($name,$item_name['result'][0]->item_name);
            }
            }
            //die;
            $newname=implode(",",$name);
            //echo $newname;die;
          ?>
                <tr>  
                <td style="color: black"><?php echo ucfirst($row->order_no);?></td> 
              <!--  <td style="color: black"><?php echo ucfirst($row->customer_id);?></td>-->
                <?php foreach($customer_name['result'] as $val){
                  ?>
                <td style="color: black"><?php echo ucfirst($val->customer_name);?></td>
               <td style="color: black"><?php echo ucfirst($newname); ?></td>
              <!--  <td style="color: black"><?php echo ucfirst($row->quantity);?></td>-->
                <td style="color: black"><?php echo "Rs. ".ucfirst($row->paidAmount);?></td>
          
                    <td>  <a href='<?php echo base_url();?>Orderdetails/viewOrderDetails/<?php echo $row->order_id;?> '><button type="button" class="btn btn-round btn-primary" value='Reset' >View</button></a> </td>         
                    
             </tr> 
        <?php }
      }
        }
         ?>
                                
                                </tbody>
                   <tfoot>
                   </tfoot>
                   </table>
                       
                   </div>
                   </div>
               </section>
           </div>
       </div>

                  
       <!-- page end-->
       </section>
   </section>
   <!--main content end-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script>
    //========================
   /* $(".btn").click(function() {
      //alert('hii');
    var currow=$(this).closest('tr');
    var id=(this.id);
    //alert(id);
    var order_no=currow.find('td:eq(0)').text();
    alert(order_no);
    var customer_id=currow.find('td:eq(1)').text();
    alert(customer_id);
    var item=parseInt(currow.find('td:eq(2)').text());
    alert(item);
    var quantity=parseInt(currow.find('td:eq(3)').text());
    alert(quantity);
    var paid_amount=parseFloat(currow.find('td:eq(4)').text());
    alert(paid_amount);
    
});*/
    
//}
   function changeStauts(id,status){
    
    var confirmstatus=confirm('Are you sure you want to change status');
    if(confirmstatus)
    {
        location.href="<?php echo base_url();?>Adminmanagement/changeStatusReview/"+id+"/"+status;
    }



}
</script>