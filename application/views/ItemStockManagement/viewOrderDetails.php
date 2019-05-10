


   
<?php         $whereArr=array('order_id'=>$this->uri->segment(3));
                $item =$this->Common_model->getAllDataWithMultipleWhere('Order',$whereArr,'order_id'); ?>  
    <!--main content start-->
    <section id="main-content">
    <section class="wrapper">
        <!-- page start-->

        <div class="row" >
            <div class="col-md-12">
                <section class="panel">
                     <a href="<?php echo base_url();?>Orderdetails/"><button type="button" class="btn btn-primary btn pull-right " > Back </button></a>
                    
                    <div class="panel-body invoice" id="print">
                        
                        
                        
                        <div class="invoice-header">
                            <div class="invoice-title col-md-3 col-xs-2">
                                <h1>invoice</h1>
                                
                            </div>
                            <div class="invoice-info col-md-9 col-xs-10">

                                
                                 <?php 

    $whereArr=array('customer_id'=>$item['result'][0]->customer_id);
    $customer_details =$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArr,'customer_id');          ?>     
                                <div class="pull-right">
                                    
                                    <div class="col-md-6 col-sm-6 pull-left" >
                                        <p>121 King Street, Melbourne <br>
                                            Victoria 3000 Australia</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 pull-right">
                                        <p>Name : <?php echo $customer_details['result'][0]->customer_name; ?> <br>
                                           Phone: <?php echo $customer_details['result'][0]->customer_phone; ?></p>
                                    </div>
                                    
                                    
                                </div>

                            </div>
                        </div>
                        <div class="row invoice-to">
                            <div class="col-md-4 col-sm-4 pull-left">
                                <h4>Invoice To:</h4>
                                <h2><?php echo ucfirst($customer_details['result'][0]->customer_name); ?> </h2>
                              
                            </div>
                            <div class="col-md-4 col-sm-5 pull-right">
                                <div class="row">
                                    <div class="col-md-4 col-sm-5 inv-label">Invoice #</div>
                                    <div class="col-md-8 col-sm-7"><?php echo $item['result'][0]->order_no; ?></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 col-sm-5 inv-label">Date #</div>
                                    <div class="col-md-8 col-sm-7"><?php echo $item['result'][0]->orderDate; ?></div>
                                </div>
                                <br>
                              


                            </div>
                        </div>
                        <table class="table table-invoice" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Description</th>
                                <th class="text-center">Unit Cost</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            
                            <?php $item_array=explode(",",$item['result'][0]->item);
                            
                            $price_array=explode(",",$item['result'][0]->base_price);
                            $quantity_array=explode(",",$item['result'][0]->quantity);
                            
                           
                            
                            ?>
                            <tbody>
                             <?php $i=0; $j=1;
                                  foreach($item_array as $items){
                                        $whereArr=array('item_id'=>$items);
                                          $item_details =$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id'); 
                             
                             ?>
                            <tr>
                                <td><?php echo $j++; ?></td>
                                <td>
                                    <h4><?php echo ucfirst($item_details['result'][0]->item_name);?></h4>
                                   
                                </td>
                                <td class="text-center"><?php echo number_format($price_array[$i],2);?></td>
                                <td class="text-center"><?php echo ($quantity_array[$i]);?></td>
                                <td class="text-center"><?php echo "Rs ".number_format($quantity_array[$i]*$price_array[$i],2);;?></td>
                            </tr>
                           
                          <?php $i++;} ?>

                            </tbody>
                        </table>
                        
                        
                        
                        <div class="row">
                            <div class="col-md-8 col-xs-7 payment-method">
                                
                                
                                
                                <h3 class="inv-label itatic">Thank you for your business</h3>
                            </div>
                            <div class="col-md-4 col-xs-5 invoice-block pull-right">
                                <ul class="unstyled amounts">
                                   
                                    <li class="grand-total">Grand Total : <?php echo "Rs ".number_format($item['result'][0]->paidAmount,2); ?></li>
                                </ul>
                            </div>
                        </div>

                        <div class="text-center invoice-btn">
                            
                            <a href="" target="_blank"  onclick="print()" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> Print </a>
                        </div>

                    </div>
                </section>
            </div>
        </div>
      
    </section>
</section>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    
    

  
function print()
{
  var element = $('#print').html(); 
    
  
 
 
  var win = window.open();
    
    
  self.focus();
  win.document.open();
  win.document.write('<!DOCTYPE html><html><head></head><body>'+element+'</body></html>');
  
    
 
 
  win.document.close();
  win.print();
  win.close();
    
}
</script>








