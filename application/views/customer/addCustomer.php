<section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Customer
                        <button type="button" class="btn btn-primary btn pull-right" onclick="location.href='<?php echo base_url(); ?>Customer_cont'">Back</button></header>


                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form"  action="insertData" method="post" id="updt" enctype="multipart/form-data">
                                <div class="form-group">
                                <input type="hidden" name="mode" value="updateDetails">

                                    <label class="control-label">Customer Name <span style="color: red;">*</span></label>
                                    <input  type="text" style="color: black" placeholder="Customer Name" class="form-control test" name="name" id="name" label="Name">
                                    <span id="name_error" style="color: red"></span><br>

                                    <label class="control-label">Address</label>
                                     <input  type="text" style="color: black" placeholder="Address" class="form-control test" name="address" id="address" label="address" onblur="check_email()">
                                    <span id="address_error" style="color: red"></span><br>

								    <label class="control-label">Phone No</label>
                                    <input  type="text" style="color: black" placeholder="phoneno" class="form-control test" name="phoneno" id="phoneno" onkeyup="checknumber()" label="phoneno">
                                    <span id="phoneno_error" style="color: red"></span><br>
									<?php 
                                    $StoreId=$this->session->userdata('StoreId');
                                    $whereArr=array('status'=>1,'StoreId'=>$StoreId);
									$getdata=$this->Common_model->getAllDataWithMultipleWhere('customer_type',$whereArr,'id');
									echo "<pre>";print_r($getdata);die;?>
                                    <label class="control-label">Customer Type</label>
                                    <select class="form-control " style="color: black" id="customer_type" name="customer_type" label="customer_type"   data-max-options="1">
										<option value="select">select</option>
										<?php
										foreach($getdata['result'] as $type){?>
										<option value="<?php echo $type->id;?>"><?php echo $type->name;?></option>
										<?php }
										?>
                               </select>
                                    <span id="status_error" style="color: red"></span><br>
                                  
       

                            <center> <button type="button" class="btn btn-primary" id="btn" onclick="validate_frm()">Submit</button></center>                  
       
                        
                                    </div>
                                </form>
                                </div>
                               
                               
                        </div>
                    </section>
            </div>
            </div>
    </section>
            </section>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script>
/*function check() {
    //alert('hii');
        //var regEmail = /^([a-z0-9_.+-])+\@(([a-z0-9-])+\.)+([a-z0-9]{2,4})+$/;
        var username=$('#username').val().trim();
        //alert(username);
        $.ajax({
            type:'post',
             url: 'username_check',
            data: { username:username},
  success: function (response){
    //alert(response);
    if (response>0) {
    $('#username_error').text("Username already exists");
    $('#username_error').css('color','red');
    $('#btn').prop('disabled',true);
    }else{
        $('#username_error').text('');
       $('#btn').prop('disabled',false); 
    }
  }
});*/
    // else{
    //     $('#email_title_error').text('please enter a valid email');
    //         $('#email_title_error').css('color','red');
    // }else{
    //     $('#email_title_error').text('email cannot be empty');
    //     $('#email_title_error').css('color','red');

    // }
    //}
   /* function check_email(){
       var email=$('#email').val();
       if(email!=''){
        $.ajax({
            type:'post',
             url: 'email_check',
            data: { email:email},
  success: function (response){
    //alert(response);
    if (response>0) {
    $('#email_error').text("Email already exists");
    $('#email_error').css('color','red');
    $('#btn').prop('disabled',true);
    }else{
        $('#email_error').text('');
       $('#btn').prop('disabled',false); 
    }
  }
});
      }else{
        $('#email_error').text('');
        $('#btn').prop('disabled',false);
      }
    }*/

// $(document).on('keypress','.test',function(evt){
//    var charCode = (evt.which) ? evt.which : evt.keyCode;
//    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
//        {
//            return false;
//        }
//        else
//        {
//            return true;
//        }
// });

 function checknumber(){
            var phone=$('#phoneno').val();
        if(isNaN(phone)){
           alert('Please enter number');
            $('#phoneno').val('');
        }
    }
     function validate_frm(){
        $('#name_error').html('');
        //$('#username_error').html('');
         //$('#password_error').html('');
        // $('#email_error').html('');
        var error=0;
        var pregmatch = /^(\s)*[A-Za-z]+((\s)?((\'|\-|\.)?([A-Za-z])+))*(\s)*$/;
        //var regEmail = /^([a-z0-9_.+-])+\@(([a-z0-9-])+\.)+([a-z0-9]{2,4})+$/;
        var emailpattern =/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
        var phone=/^\d{10}$/;
         var name=$('#name').val();
        // var username=$('#username').val();
         //var password=$('#password').val();
         var phoneno=$('#phoneno').val();
         var email=$('#email').val();

         if(!pregmatch.test(name)){
            $('#name_error').html('Please insert a valid name');
            error++;
         }
         
          /*if(username==''){
            $('#username_error').html('Please enter a username');
            error++;
         }
          if(password==''){
            $('#password_error').html('Please enter a password');
            error++;
         }
         if(password.length<6){
            $('#password_error').html('Please enter a password of length 6');
            error++;
         }*/
         if(phoneno!=''){
         if(phoneno.length!=10){
            $('#phoneno_error').html('Please insert a 10 digit mobile number');
            error++;
         }
        }
        /* if(email!=''){
          var emailpattern =/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
         if(!emailpattern.test(email)){
          $('#email_error').html('Please enter a valid email');
            error++;
         }
       }else{
        $('#email_error').html('');
       }*/
		/*if(address==''){
		$('#address_error').html('please enter address');
		}*/

         if(error==0){
            $('#updt').submit();
         }

     }


    
 </script>
            