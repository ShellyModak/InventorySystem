
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        <?php $designation = $this->session->userdata('designation');?>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                       <?php if($designation == 'Team Leader') { echo 'My Project'; }else {echo "Assigned Project"; }?>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <?php
                                if($designation == 'Team Leader')
                                {
                                ?>
                                <div class="btn-group">
                                    <button id="editable-sample_new1" class="btn btn-primary" onclick="addRow();" style="margin-bottom:12px">
                                        Add New <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <?php
                                }
                                ?>
                              <!--  <div class="btn-group pull-right">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Print</a></li>
                                        <li><a href="#">Save as PDF</a></li>
                                        <li><a href="#">Export to Excel</a></li>
                                    </ul>
                                </div>-->
                            </div>
                            <div class="space15"></div>
                                <form id="projectForm" name='projectForm' action="">
                                    <input type='hidden' class='form-control' value='' name='proname' id='proname'>
                                    <input type='hidden' class='form-control' value='' name='prolink' id='prolink'>
                                    <input type='hidden' class='form-control' value='' name='prodesign' id='prodesign'>
                                    <input type='hidden' class='form-control' value='' name='proid' id='proid'>
                                    <input type='hidden' class='form-control' value='' name='projectid' id='projectid'>
                                    <input type='hidden' class='form-control' value='' name='uniqueName' id='uniqueName'>
                                        <?php
                                        
                                       // echo "<pre>"; print_r($allDetails);die;
                                            $account="<option value=''>Select Id</option>";
                                            foreach($allAccount as $acc)
                                            {
                                                $account.="<option value='".$acc->accountId."'>".$acc->accountName."</option>";
                                            }
                                        ?>
                                        <input type="hidden" id="allAccount" value="<?php echo $account?>">
                                        <table class="table table-striped table-hover table-bordered" id="projectTable">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Link</th>
                                                <th>Designer</th>
                                                <th>Id</th>
                                                <th>Upload Image</th>
                                                <?php if($designation == 'Team Leader'){?><th>Edit</th><?php } ?>
                                                <th>Comment</th>
                                                <?php if($designation == 'Team Leader'){?><th>Done</th><?php } ?>
                                            </tr>
                                            </thead>
                                            <tbody id='projectTableBody'>
                                                <?php
                                               
                                                     if($allDetails!=0)
                                                     {
                                                        //print_r($allDetails);
                                                            foreach($allDetails as $details)
                                                            {
                                                                //echo $details->assignDesignerId;
                                                                //echo $details->projectsId;
                                                ?>
                                                                    <tr class="" id="details_<?php echo $details->projectsId;?>">
                                                                        <td><?php echo $details->projectsName;?></td>
                                                                        <td><a href="<?php echo $details->projectsLink;?>" target = '_blank' ><?php echo $details->projectsLink;?></a></td>
                                                                        <td><?php
                                                                       
                                                                     ?>
                                                                     
                                                                     <a href="javascript:void(0)" onclick="getModalToAllDesigner(<?php echo $details->assignDesignerId;?>,<?php echo $details->projectsId;?>);">Assigned Designer</a>
                                                                        </td>
                                                                        <td class="center"><?php echo $details->accountName;?></td>
                                                                        <td><!--<input type="file">-->
                                                                            <?php
                                                                                $countImage=$this->projectDetails->imageCount('relatedFiles',$details->projectsId);
                                                                                echo $countImage." "."Images";
                                                                            ?>
                                                                        </td>
                                                                        <?php if($designation == 'Team Leader'){?><td><a class="edit" href="javascript:void(0);" onclick="editDataaas('<?php echo $details->projectsId;?>');">Edit</a></td><?php } ?>
                                                                        <td><a class="comment" href="javascript:;" onclick="doComment('<?php echo $details->projectsId;?>');">Comment</a></td>
                                                                        <?php if($designation == 'Team Leader'){?><td><a class="delete" href="javascript:void(0);" onclick="doneData('<?php echo $details->projectsId;?>')">Done</a></td><?php } ?>
                                                                    </tr>
                                                <?php    
                                                            }
                                                     }
                                                     else
                                                     {
                                                        ?>
                                                        <tr>
                                                            <td colspan="8" style="color: red;">No Records Found!</td>
                                                        </tr>
                                                        <?php 
                                                     }
                                                ?>
                                            
                                            </tbody>
                                        </table>
                                </form>
                                <span id="paginationall"><?php echo $pagi;?></span>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
    <div id="myModal" class="modal fade" role="dialog">
    </div>

<!--right sidebar start-->
<?php
    $this->load->view('includes/rightSidePanel');
?>
<!--right sidebar end-->

</section>

<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->

</body>
</html>
<script>
    function addRow() {
        var row_error=0;
        $('.need').each(function(){
        element_id = $(this).attr('id');
        element_value = $(this).val();
        error_div = $("#"+element_id)
        //alert(element_id);
        if (element_value.search(/\S/)==-1)
        {
          row_error++;
          error_div.focus();
        }
        else
        {
            //error_div.html('');
        }
      
      });
      if (row_error >0) {
        return false;
      }
      else{
        
                $.getJSON( "http://esolz.co.in/lab6/internal_development_vol_2/web_servc_cntrlr/all_designer", function(data) {
                //console.log(data['getdata']);
                var allAccount=$('#allAccount').val();
                var option='<option value="">Select a designer</option>';
                var id='';
                var fname='';
                var mname='';
                var lname='';
                $.each( data['getdata'], function( key, value ) {
                    $.each( value, function( key1, value1 ) {
                     console.log(key1+':'+value1);
                     if (key1=='userId') {
                       id=value1;
                     }
                     else if (key1=='first_name') {
                        fname=value1;
                     }
                     else if (key1=='middle_name') {
                        mname=value1;
                     }
                     else if (key1=='last_name') {
                        lname=value1;
                        option=option+'<option value="'+id+'">'+fname+' '+mname+' '+lname+'</option>';
        
                     }
                     
                  })
                  })
                $('<tr id="new"><td><input type="text" class="form-control small need" value="" name="name" id="name"></td><td><input type="text" class="form-control small need" name="link" id="link" value=""></td><td><select class="form-control small need" id="designer" name="designer">'+option+'</select></td><td><select class="form-control small need" name="accountId" id="accountId">'+allAccount+'</select></td><td><input type="file" name="proImage" id="proImage"></td><td><a href="javascript:void(0)" class="edit" onclick="saveProject()">Save</a></td><td><a href="" class="cancel" id="cancel" onclick="cancel()">Cancel</a></td><td><input type="hidden"></td></tr>').prependTo('table');
                
              });
      }
        
    }
    
   
    //$('#cancel').click(function (e) {
            function cancel()
            {
                e.preventDefault();
                if (confirm("Are you sure to delete this row ?") == false) {
                    return;
                }
                
                else {
                    //var nRow = $(this).parents('tr')[0];
                    //oTable.fnDeleteRow(nRow);
                    $('#new').remove();
                }
            //});
            }
            function getModalToAllDesigner($allSt,projectsId){
                //alert($allSt);
                alert(projectsId);
                 $.ajax({
                        url: "<?php echo base_url();?>index.php/projectCont/getModalToAllDesigner",
                        type: "POST",
                        data:{'allSt':$allSt,'projectsId':projectsId},
                        async: false,
                        success: function(result){
                            $('#myModal').html(result);
                            $("#myModal").modal('show');
                        }
        
                    });
            }
            
                //================Save assigned designer================//
                function saveAssignedDesigner(projectId) {
                   //alert(projectId);
                    var assign=[];
                    $('.assigned_check').each(function(){
                        if($(this).prop('checked') == true)
                        {
                            assign.push($(this).val());
                        }
                    });
                    
                    $.ajax({
                            url: "<?php echo base_url();?>index.php/commentCont/saveDesigner",
                            type: "POST",
                            data:{'designer':assign,'projectId':projectId},
                            async: false,
                            success: function(result){
                                $('#myModal').modal('hide');
                                $('#comdiv').css('display','block');
                            }
            
                        });
            
                }
    
    //=============function to save project details=================//
    function saveProject() {
        var has_error=0;
        var name=$('#name').val();
        var link=$('#link').val();
        var designer=$('#designer').val();
        var accountId=$('#accountId').val();
        
        $('.need').each(function(){
        element_id = $(this).attr('id');
        element_value = $(this).val();
        error_div = $("#"+element_id);
        
        //alert(element_id);
        if (element_value.search(/\S/)==-1)
        {
          has_error++;
          error_div.focus();
        }
        else if (element_value.search(/\S/)!=-1)
        {
            if (element_id=='name') {
                 $.ajax({
                            url: "<?php echo base_url();?>index.php/projectCont/uniqueCheck",
                            type: "POST",
                            data:{'name':name,'flag':'add'},
                            async: false,
                            success: function(result){
                                if (result!=0) {
                                   $('#uniqueName').val('1');
                                   alert('Project Name Already Exist.');
                                }
                                else
                                {
                                    $('#uniqueName').val('0');
                                }
                            }
            
                        });
            }
        }
        else
        {
            //error_div.html('');
        }
      
      });
      if ($('#uniqueName').val()==1) {
           has_error++;
           $('#name').focus();
        }
      if (has_error >0) {
        return false;
      }
      else
      {
        // alert(has_error);exit();
         
         $('#proname').val(name);
         $('#prolink').val(link);
         $('#prodesign').val(designer);
         $('#proid').val(accountId);
         
         $.ajax({
				url: "<?php echo base_url();?>index.php/projectCont/saveProject",
				type: "POST",
				data:  new FormData($('form')[0]),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data){
                                    alert(data);
                                    data = data.trim();
                                    data = data.split('@@@');
				    $("#projectTableBody").html(data[0]);
                    $("#paginationall").html(data[1]);
                    
				},
				error: function(){} 	        
			});
          
      }
      
    }
    
    //================function for edit data==============//
    function editDataaas(id) {
        //alert(id);
        var tableId='details_'+id;
        $.ajax({
                    url: "<?php echo base_url();?>index.php/projectCont/getDataAjax",
                    type: "POST",
                    data:{'id':id},
                    async: false,
                    success: function(result){
                        //alert(result);
                        $('#'+tableId).html(result);
                    }
            });
        
    }
    
    //==============update data============//
    function updateProject() {
        //alert('123');
        var update_error=0;
        var name=$('#nameEdit').val();
        var link=$('#linkEdit').val();
        var designer=$('#designerEdit').val();
        var accountId=$('#accountIdEdit').val();
        var id=$('#proId').val();
         
        $('.need1').each(function(){
            element_id = $(this).attr('id');
            element_value = $(this).val();
            error_div = $("#"+element_id)
            //alert(element_id);
            if (element_value.search(/\S/)==-1)
            {
              update_error++;
              error_div.focus();
            }
            else if (element_value.search(/\S/)!=-1)
            {
                if (element_id=='nameEdit') {
                     $.ajax({
                                url: "<?php echo base_url();?>index.php/projectCont/uniqueCheck",
                                type: "POST",
                                data:{'name':name,'flag':'edit'},
                                async: false,
                                success: function(result){
                                    if (result!=0) {
                                       $('#uniqueName').val('1');
                                       alert('Project Name Already Exist.');
                                    }
                                    else
                                    {
                                        $('#uniqueName').val('0');
                                    }
                                }
                
                            });
                }
            }
            else
            {
                //error_div.html('');
            }
      
        });
        if ($('#uniqueName').val()==1) {
            update_error++;
            $('#name').focus();
        }
        if (update_error >0) {
          return false;
        }
        else
        {
         
            $('#proname').val(name);
            $('#prolink').val(link);
            $('#prodesign').val(designer);
            $('#proid').val(accountId);
            $('#projectid').val(id);
            console.log($('form')[0]);
            //alert(id);
            $.ajax({
                    url: "<?php echo base_url();?>index.php/projectCont/updateAjax",
                    type: "POST",
                    data:  new FormData($('form')[0]),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data){
                                       //alert(data);
                        data = data.trim();
                        data = data.split('@@@');
                        $("#projectTableBody").html(data[0]);
                        $("#paginationall").html(data[1]);
                    },
                    error: function(){}
            });
          
        }
        
    }
    
    //===================delete data===========//
    function doneData(id) {
        var del=confirm('Once You Compete The Project You Can Not Modify It.Are You Sure Want To Continue?');
        if(del== true)
        {
            window.location.href="<?php echo base_url();?>index.php/projectCont/doneProject/"+id;
        }
    }
    
    //==============comment section====================//
    function doComment(id) {
        window.location.href="<?php echo base_url();?>index.php/commentCont/getComment/"+id;
       
    }
</script>
