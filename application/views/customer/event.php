<style type="text/css">
.active2{
   background-color: #c7e7f1;
   outline: none;
   font-size: 15px;
   padding: 8px 12px;
}
.inactive2{
 background-color: #f1f1f1;
}
</style>

<?php
$month=date('m');
$today=date('d');
$month_name = date("F", mktime(0, 0, 0, $month, 10));        
$id= $this->session->userdata('StoreId');
// $where=array('store_id'=>$id,'status <>'=> '2');
// $list=$this->Common_model->getAllDataWithMultipleWhere('Customer',$where,'customer_id');
// $n=$list['num_row'];
?>
<div class="panel-body">

<?php
$day=date('d');  
foreach ($listing['result'] as $list) {
 
// for($i=0;$i<$row;$i++){    
    if($list->cupon_type==1){
      $bdate=(explode("-",$list->event_on));
      $bd=$bdate[1];
      $bdday=$bdate[2];
      $month1=$bdate[2]." ".$month_name;
    if($bd==$month){
        if($bdday>$day){
            $news=$bdday-$day;
            if($news==1){
              $status="Tomorrow";  
            }
            else{
                $status="After ".$news." dayes";
            }
        }
        else if($bdday==$day){
            $status="Today"; 
        }
        else{
            $news=$day-$bdday;
            if($news==1){
               $status="Yeasterday"; 
            }
            else{
            $status=$news." Dayes ago";
            }
        }       
  ?>  
<?php
$where2=array('store_id'=>$id,'customer_id'=>$list->customer_table_id,'type'=>1,);
$listnew=$this->Common_model->getAllDataWithMultipleWhere('cuponCodeDetials',$where2,'id');
$num=$listnew['num_row'];
if($num==1){
?>
         <div class="alert alert-danger">
      <span class="alert-icon"><i class="fa fa-gift"></i></span>
      <div class="notification-info">
          <ul class="clearfix notification-meta">
              <li class="pull-left notification-sender"><span><a><?php echo $list->cupon_title_name;echo " have birthday on ";  echo $month1; ?></a></span></li>
              <li class="pull-right notification-time"> <?php echo $status; ?></li>
          </ul>
          <a class="nav dropdown">
              <a data-toggle="dropdown" id="my-selector" >
              Offer already send
          </a>
          </a> 
      </div>
  </div>
         <?php
       }
       else{
        ?>
        <div class="alert alert-info clearfix">
      <span class="alert-icon"><i class="fa fa-gift"></i></span>
      <div class="notification-info">
          <ul class="clearfix notification-meta">
              <li class="pull-left notification-sender"><span><a><?php echo $list->cupon_title_name;echo " have birthday on "; echo $month1; ?></a></span></li>
              <li class="pull-right notification-time"> <?php echo $status; ?></li>
          </ul>
          <a class="nav dropdown">
          <a data-toggle="dropdown" style="cursor: pointer;" id="my-selector" onclick="open_popup('<?php echo $list->customer_table_id;?>','<?php echo $month_name; ?>','<?php echo $list->event_on; ?>','1');">
          
              Make offer
          </a>
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog" id="modal_response">
                  
          </div>
        </div>
       
        </a> 
      </div>
  </div>
   <?php
      }
    } 
  }
  if($list->cupon_type == 2){
    $anny=(explode("-",$list->event_on));
    $any=$anny[1];
    $anyday=$anny[2];
    $anymonth2=$anny[2]." ".$month_name;
  if($any==$month){
      if($anyday>$day){
              $news=$anyday-$day;
              if($news==1){
                $status2="Tomorrow";  
              }
              else{
              $status2="After ".$news." dayes";
              }
          }
          else if($anyday==$day){
              $status2="Today"; 
          }
          else{
              $news=$day-$anyday;
              if($news==1){
                 $status2="Yeasterday"; 
              }
              else{
              $status2=$news." Dayes ago ";
              }
          }         
  ?>
          <?php
          $where2=array('store_id'=>$id,'customer_id'=>$list->customer_table_id,'type'=>2);
          $listnew=$this->Common_model->getAllDataWithMultipleWhere('cuponCodeDetials',$where2,'id');
          $num=$listnew['num_row'];
          if($num==1){
         ?>
         <div class="alert alert-danger">
      <span class="alert-icon"><i class="fa fa-heart"></i></span>
     <div class="notification-info">
          <ul class="clearfix notification-meta">
              <li class="pull-left notification-sender"><span><a><?php echo $list->cupon_title_name;echo " have anniversary on "; echo $anymonth2;?></a></span></li>
              <li class="pull-right notification-time"><?php echo $status2; ?></li>
          </ul>
          <a class="nav dropdown">
              <a data-toggle="dropdown" id="my-selector" >
              Offer already send
          </a>
          </a> 
      </div>
  </div>
         <?php
       }
       else{
        ?>
          <div class="alert alert-success ">
      <span class="alert-icon"><i class="fa fa-heart"></i></span>
     <div class="notification-info">
          <ul class="clearfix notification-meta">
              <li class="pull-left notification-sender"><span><a><?php echo $list->cupon_title_name;echo " have anniversary on ";echo $anymonth2;?></a></span></li>
              <li class="pull-right notification-time"><?php echo $status2; ?></li>
          </ul>
          <a class="nav dropdown">
           <a data-toggle="dropdown" style="cursor: pointer;" id="my-selector" onclick="open_popup('<?php echo $list->customer_table_id;?>','<?php echo $month_name; ?>','<?php echo $list->event_on; ?>','2');">
               Make offer
          </a>
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog" id="modal_response">
                  
          </div>
        </div>
        
        </a> 
      </div>
  </div>

<?php
      }      
    }
  }  
}
 ?> 
 </div>

   <div class="dataTables_paginate paging_bootstrap pagination">
  <ul>
    <!-- <li class="prev disabled"><a href="#">← Previous</a></li>  -->

   

 <?php
// echo $page;
    $pagLink = "";  
     for ($i=1; $i<=$totalPage; $i++) {  
       if($i==$page){
       //  echo "heloooooooooooo";
         $abc='active2';
       }
       else
       {
         $abc='inactive2';
       }
      $pagLink .="<li class=' pagination_link page data hover ".$abc."' style='cursor:pointer;border:none; outline: none; font-size: 15px;padding: 8px 12px;' id='".$i."'>".$i."</li>";
      };  
        echo $pagLink;
?>
 <!--  <li class="active"><a href="#">1</a></li> -->


    <!-- <li class="next disabled" ><a href="#">Next → </a></li> -->
  </ul> 
</div>


