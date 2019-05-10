<!DOCTYPE html>
<html lang="en">
<?php //echo "<pre>";print_r($details);die;
$cust_id=$details['result'][0]->customer_id;
//echo $cust_id;die;
 foreach($details['result'] as $data){
	//echo "<pre>";print_r($data);die;
	$where=array('id'=>$data->customer_type);
	$customer_type=$this->Common_model->getAllDataWithMultipleWhere('customer_type',$where,'id');
	
	//echo "<pre>";print_r($customer_type);die;
 
?>

	<?php $where=array('customer_id'=>$cust_id);
					$order=$this->Common_model->getAllDataWithMultipleWhere('Order',$where,'order_id');
					//echo "<pre>";print_r($order);die;
					$allcount=$order['num_row'];
					?>
<!--sidebar end-->
    <!--main content start-->
	 <input type="hidden" name="cust_id" id="cust_id" value="<?php echo $data->customer_id?>" >
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body profile-information">
                       <div class="col-md-3">
                           <div class="profile-pic text-center">
							<img src="<?php echo IMGURL?>assets/thumbnail_new/nullimage.png" alt=""/>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="profile-desk">
                               <h1><?php echo $data->customer_name?></h1><br>
                               <a>Mobile:<?php echo $data->customer_phone?></a><br>
							   <a>Customer Type: <?php if($customer_type['num_row']>0){
										echo $customer_type['result'][0]->name;
										}else{
											echo "NA";
										}
							   ?> </a><br>
							   <a>Address:<?php if($data->address==''){ echo "NA";}
							   else{echo $data->address;}
							   ?></a>
                              
                               
                           </div>
                       </div>
                       <div class="col-md-3">
                           <div class="profile-statistics">
							<?php if($data->DOB!=0){?>
                               <h1><?php echo $data->DOB;?></h1>
							   <p>Birth Day</p><br>
							   <?php } ?>
							   <?php if($data->anniversary!=0){?>
								<h1><?php echo $data->anniversary;?></h1>
								<p>Anniversary</p><br>
								<?php } ?>
                              <h1><?php echo $order['num_row'];?></h1>
							     <p>No. of Order</p>
                           </div>
                       </div>
                    </div>
                </section>
            </div>
			<?php } ?>
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading tab-bg-dark-navy-blue">
                        <ul class="nav nav-tabs nav-justified ">
                           
                            <li>
                                <a data-toggle="tab" href="#job-history">
                                    Order History
                                </a>
                            </li>
                         
                           
                        </ul>
                    </header>
				
                    <div class="panel-body">
                        <div class="tab-content tasi-tab">
                           
                            <div id="job-history" class="tab-pane active ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="timeline-messages">
                                            <h3>Take a Tour</h3>
                                            <!-- Comment -->
											<?php
											$count=0;
											if($order['num_row']>0){
												
												foreach($order['result'] as $details){
													$count++;
													
													//echo "<pre>";print_r($details->order_id);die;
													//echo $details['order_id'];die;
													$check=$count%2;
													//$check=($details->order_id)%2;
													//echo $check;die;
													$where=array('item_id'=>$details->item);
													$item=$this->Common_model->getAllDataWithMultipleWhere('Item',$where,'item_id');
													//$whereArr=array('item'=>$);
													//echo "<pre>";print_r($order);die;
												?>
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text post">
                                                        <div class="first">
                                                            <?php echo $details->orderDate?>
                                                        </div>
														<?php if($check==0){
															//echo "<pre>";print_r($order);die;
															//echo "<pre>";print_r($details);die;
															//$id=$details->order_id;
															//echo $id;die;
															?>
                                                        <div class="second bg-green ">
                                                         <?php echo "Order No: ".$details->order_no." "."Total Amount Paid: ".$details->paidAmount."  "."To View Order Details "?> <a href="<?php echo base_url();?>/Orderdetails/viewOrderDetails/<?php echo $details->order_id?>">click here</a>
																
                                                        </div>
														<?php } else{ ?>
														<div class="second bg-blue ">
                                                         <?php echo "Order No: ".$details->order_no." "." Total Amount Paid: ".$details->paidAmount." "."To View Order Details "?> <a href="<?php echo base_url();?>/Orderdetails/viewOrderDetails/<?php echo  $details->order_id?>">click here</a>
                                                        </div>
														<?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                           <?php }
											}?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         								 
								 
								            
											<input type="hidden" id="row" value="0">
											<input type="hidden" id="all" value="<?php echo $allcount; ?>">
                         
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->

</section>



</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
	function load_more(){
		//alert('HI');
		var row=parseInt($('#row').val());
		var all=$('#all').val();
		var cust_id=$('#cust_id').val();
		var rowperpage = 3;
		//alert(row);
		//alert(cust_id);
      row1 = row + rowperpage;
		
		
		
		if(row <= all){
            $("#row").val(row);
				$.ajax({
					 url: '<?php echo base_url();?>/Customer_cont/loadmore',
                type: 'post',
                data: {row:row1,
							 rowperpage:rowperpage,
							 cust_id:cust_id},
					 
					 success: function(response){
						 $(".post:last").after(response).show().fadeIn("slow");
					 }
					});
		}
		
	}
</script>
