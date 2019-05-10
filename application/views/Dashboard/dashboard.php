<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<style>



   


</style>

<section id="main-content">
       <section class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                <?php
                    if($this->session->userdata('success_msg') !='')
                {
?>               <div class="alert alert-success message">
                <center><strong>Success! </strong><span class=""><?php echo $this->session->userdata('success_msg'); ?></span></center> 
                </div>
               <?php
             $this->session->unset_userdata('success_msg');
                } 
?>
                    
            </div>
     </div>

           
<div class="row">
    <div class="col-md-3">
        <a href="<?php echo base_url();?>Orderdetails/">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon orange"><i class="fa fa-gavel"></i></span>
                <div class="mini-stat-info">

                 <?php   
                    $whereArr=array('storeId'=>$this->session->userdata('StoreId'));
                    $order_arr=$this->Common_model->getAllDataWithMultipleWhere('Order',$whereArr,'order_id');
                   ?>
                    <span><?php echo $order_arr['num_row'];?></span>
                   Total Orders
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-3">
        <a href="<?php echo base_url();?>ItemStockManagement/">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon tar"><i class="fa fa-tag"></i></span>

                    <div class="mini-stat-info">
                    <?php   
                         $whereArr=array('store_id'=>$this->session->userdata('StoreId'));
                    $item_arr=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
                     ?>
                       <span><?php echo $item_arr['num_row'];?></span>
                        Total Items
                    </div>
                </div>
        </a>
    </div>
   
    <div class="col-md-3">
        <a href="<?php echo base_url();?>Orderdetails/">
                <div class="mini-stat clearfix">
                    <span class="mini-stat-icon pink"><i class="fa fa-money"></i></span>
                    <div class="mini-stat-info">
                      <?php    $total_amount=0; 
 if($order_arr['num_row']>0){
                        foreach($order_arr['result'] as $order)
                        {
                   
                     $total_amount+=$order->paidAmount;
                       }}?>
                        <span>&#x20b9;<?php echo $total_amount;?></span>
                       Total Revenue Generated
                    </div>
                </div>
            </a>
        </div>
    
    <div class="col-md-3">
     <a href="<?php echo base_url();?>Customer_cont/">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
            <div class="mini-stat-info">
                 <?php 
                    $whereArr=array('store_id'=>$this->session->userdata('StoreId'));
                    $customer_arr=$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArr,'customer_id');
               ?>
               <span><?php echo $customer_arr['num_row'];?></span>
                Total Customer
            </div>
        </div>
        </a>
    </div>
</div>
     
<!--
  <div class="row">
    <div class="col-md-8">
      
      <div id="container" style="min-width: 30px; height: 40px; margin: 0 auto"></div>
      
      </div>       
           
</div>         
-->
 <!-- Total Ordered Product graph -->
   <?php
$curYr2 = date('Y');
//echo $curYr;
$prevYr2 = $curYr2 - 3;
?>   <div class="row">
		<div class="col-md-8">
			<div class="padding">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bar-chart-o fa-fw"></i> Daily Income
						<div class="pull-right">
							<div class="btn-group">
								<div class="form-group">
									<select class="form-control need" id="select_year" name="select_year2" label="Year" style="margin-top: -7px;" onchange="activity('',this.value);">
										<?php
										for($i=$prevYr2; $i<=$curYr2; $i++)
										{
										?>
										<option value="<?php echo $i;?>" <?php if($i==$curYr2){echo 'selected';}?>><?php echo $i;?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
                        
							<div class="pull-right">
							<div class="btn-group">
								<div class="form-group">
									<select class="form-control selectpicker need" id="select_month" name="select_year2" label="Year" style="margin-top: -7px;" onchange="activity(this.value,'');">
										
									</select>
								</div>
                            </div>
                        </div>
							
						
					</div>
					
					<div class="panel-body">
						<div id="container_income"></div>
					</div>
				</div>
			</div>
		</div>
           
        <!-- watch-->   
          <div class="col-md-4" >
        <div class="profile-nav alt" >
            <section class="panel">
                <div class="user-heading alt clock-row terques-bg">
                    <h1><?php echo date('M Y');?></h1>
                    <p class="text-left"><?php $timestamp = time(); echo(date("F d, Y", $timestamp));?></p>
                    <p class="text-left"><?php $timestamp = time(); echo(date("h:i A", $timestamp));?></p>
                </div>
                <ul id="clock">
                    <li id="sec"></li>
                    <li id="hour"></li>
                    <li id="min"></li>
                </ul>

                <ul class="clock-category">
                    <li>
                        <a href="#" class="active">
                            <i class="ico-clock2"></i>
                            <span>Clock</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ico-alarm2 "></i>
                            <span>Alarm</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ico-stopwatch"></i>
                            <span>Stop watch</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class=" ico-clock2 "></i>
                            <span>Timer</span>
                        </a>
                    </li>
                </ul>

            </section>

        </div>
    </div> 
           
    <!-- watch end -->  
    <!-- store statistics start-->
           <div class="col-md-4">
                <div class="mini-stat clearfix">
                     <div class="panel-body profile-information">
                      
                         <div class="profile-statistics">
                            <div class="row">
                      <div class="col-md-6">
                                <span class="mini-stat-icon green"><i class="fa fa-shopping-cart"></i></span>
                                   <h1>1,240</h1>
                                   <p>This Week Sales</p>
                                </div>
                               <div class="col-md-6">
                             <span class="mini-stat-icon orange"><i class="fa fa-inr"></i></span>
                               <h1>5,612</h1>
                               <p>This Week Earn</p>
                               
                               </div>
                            </div>
                               
                               
                               <!--ul>
                                   
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-facebook"></i>
                                       </a>
                                   </li>
                                   <li class="active">
                                       <a href="#">
                                           <i class="fa fa-twitter"></i>
                                       </a>
                                   </li>
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-google-plus"></i>
                                       </a>
                                   </li>
                               </ul-->
                           </div>
                       </div>
               </div>
           </div>
           <!-- store statistic end-->
           <div class="col-md-6">
      <div class="event-calendar clearfix">
            <div class="col-lg-12 ">
                <div class="cal-day">
                    <span>Today</span>
                    Friday
                </div>
                <ul class="event-list">
                    <li>Lunch with jhon @ 3:30 <a href="#" class="event-close"><i class="ico-close2"></i></a></li>
                    <li>Coffee meeting with Lisa @ 4:30 <a href="#" class="event-close"><i class="ico-close2"></i></a></li>
                    <li>Skypee conf with patrick @ 5:45 <a href="#" class="event-close"><i class="ico-close2"></i></a></li>
                    <li>Gym @ 7:00 <a href="#" class="event-close"><i class="ico-close2"></i></a></li>
                    <li>Dinner with daniel @ 9:30 <a href="#" class="event-close"><i class="ico-close2"></i></a></li>

                </ul>
            </div>
           </div>
        </div>
  </div>
           

           
 
   
           
           
           
           
           
           
    </section>
</section>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
   
    
    $(document).ready(function() {
    <?php $month=date('m');
          $year=date('Y');?>
    activity('<?php echo $month;?>','<?php echo $year;?>');
});
    
     function activity(monthNumber,YearNumber)
     {
       
         
         if(YearNumber=="")
         {
             var YearNumber=$('#select_year').val();
         }
         else if(monthNumber=="")
          {
             var monthNumber= $('#select_month').val();
          }
         else if(monthNumber=="" && YearNumber=="")
         {
            var YearNumber=$('#select_year').val();
             var monthNumber= $('#select_month').val();
         }
         else{}
        
        
         
             
          $.ajax({
                    url:"<?php echo base_url();?>Dashboard/showDays",   
                    data:{monthNumber:monthNumber,YearNumber:YearNumber},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   
                        
                        var responseArr = response.split('Arnab');
                         days=JSON.parse(responseArr[0]);
                        order=JSON.parse(responseArr[1]);
                        
						price=JSON.parse(responseArr[2]);
                        
                        month=responseArr[3];
                       
                       
                       
                     
                       
                    }
                                                 
                                      
                                        
                });
        
     
    
    
    
    
    
    

        Highcharts.chart('container_income',{
		chart: {
			type: 'spline'
		},
		title: {
			text: 'Daily income ($)'
		},
	
		subtitle: {
			text: ''
		},
		credits: false,
		
		xAxis: {
			categories:days,
			crosshair: true
		},
		yAxis: {
			title: {
				text: ''
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},
		plotOptions: {
			series: {
				lineWidth: 3,
				animation: {
					duration: 2000
				}
			}
		},
		 series: [{
           
            name: 'Daily order',
           data: order,
              color: "red"
       },
        {
            
            name: 'Daily income',
            data: price,
             color: "blue"
       }
       ]
	
	});
         
         $('#select_month').html(month);
         $('.selectpicker').selectpicker('refresh');
    
     }
    
    
        
    
</script>
