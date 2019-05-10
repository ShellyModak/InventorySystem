<!--main content start-->
   <section id="main-content">
       <section class="wrapper">
       <!-- page start-->

       <div class="row">
           <div class="col-sm-12">
               <section class="panel">
                   <header class="panel-heading">
                       Item Stock 
                       <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-cog"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                   </header>
                   <div class="panel-body">
                  
                   <div class="adv-table">
                       
                   <table  class="display table table-bordered table-striped" id="dynamic-table">
                   <thead>
                   <tr>
                                   
                                    <th class="numeric">Item Name</th>
                                    <th class="numeric">Stock</th>
                                    <th class="numeric">Quantity</th>
                                    <th class="numeric">Option</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                <?php  
            if(!empty($listing['result'])){ // new added for not empty listing
          if(count($listing)>0){
             //echo"<pre>";
             // print_r($listing);
         foreach ($listing['result'] as $row)  
         { 
            //echo "<pre>";print_r($row);die;
          if($row->status==1 || $row->status==0){
            ?>
                <tr>  
                <td style="color: black"><?php echo ucfirst($row->item_name);?></td> 
              <td><input  type="text" style="color: black" value="<?php echo $row->stock; ?>"  placeholder="Stock" class="form-control test1" name="stock" id="stock" label="stock" readonly></td>
              <td><input  type="number" style="color: black" value="0" min=0 placeholder="Quantity" class="form-control test2" name="quantity" id="quantity" label="quantity"></td>
          
      <td><button type="button" id="<?php echo $row->item_id ?>" class="btn btn-primary save">Add</button>
                    
             </tr> 
        <?php }
          }
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
   $(".test2").keyup(function(){
      //alert('hii');
      //var qty=$('#quantity').val();
      //alert(qty);
    var currow=$(this).closest('tr');
    var quantity=parseInt(currow.find('td:eq(2)').find('.test2').val());
    //alert(quantity);
    if(quantity<0){
      alert('Please enter a Positive quantity');
      currow.find('td:eq(2)').find('.test2').val(0);

    }
      
    });
  
    $(".save").click(function() {
      
    var currow=$(this).closest('tr');
    var id=(this.id);
    //alert(id);
    var itemName=currow.find('td:eq(0)').text();
    //alert(itemName);
    var stock=parseInt(currow.find('td:eq(1)').find('.test1').val());
    //alert(stock);
    var quantity=parseInt(currow.find('td:eq(2)').find('.test2').val());
    alert(quantity);
    if(quantity==0){
      alert('Cannot insert stock! Please insert another quantity');
    }

    
    //alert(quantity);
     var stock1=stock+quantity;
     if(stock1 < 0){
      stock1=0;
     }
   

    $.ajax({
            type:'post',
             url: '<?php echo base_url();?>ItemStockManagement/stockupdate',
            data: { id:id, stock:stock1,quantity:quantity},
  success: function (response){
   
     if (response>0) {
     currow.find('td:eq(1)').find('.test1').val(stock1);
     currow.find('td:eq(2)').find('.test2').val(0);
   }else{
    currow.find('td:eq(1)').find('.test1').val('');
     currow.find('td:eq(2)').find('.test2').val('');
   }
  }
});
    //alert('please enter quantity'); 
});
    
   function changeStauts(id,status){
    
    var confirmstatus=confirm('Are you sure you want to change status');
    if(confirmstatus)
    {
        location.href="<?php echo base_url();?>Adminmanagement/changeStatusReview/"+id+"/"+status;
    }



}
</script>