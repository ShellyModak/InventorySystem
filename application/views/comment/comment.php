
    <!--main content start-->
    <section id="main-content" class="">
        <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <!---------------------Alert section----------------------->
            
            
            <div class="pgn-wrapper" data-position="top" id='comdiv' style="display: none;">
                    <div class="pgn pgn-bar">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">x</span><span class="sr-only">Close</span>
                            </button>
                            <span id='msgDiv'>
                                
                            </span>
                        </div>
                    </div>
                </div>
            <!---------------------End of alert section----------------------->

                    <header class="panel-heading">
                        All Images
                        <?php
                        if($this->session->userdata('designation')=='Team Leader')
                        {
                        
                        ?>
                        <a style="float: right;" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Assigned Designers</a>
                        <?php
                        }
                        ?>
                    </header>
                    
            <?php
                if($all_images['num']!=0)
                {
                    foreach($all_images['allData'] as $image)
                    {
                        $comments=$this->commentModel->getAllComment('comments','projectsId',$projectDetails[0]->projectsId,'relatedFilesId',$image->relatedFilesId);
                        
            ?>
                                <div class="col-lg-12">
                                            <div class="panel-body">
                                                <div class="col-lg-4">
                                                    <img src="<?php echo base_url();?>images/thumbnail/<?php echo $image->relatedFilesName;?>"/>
                                                </div>
                                                
                                                <div class="col-lg-8">
                                                    <div id="comment_<?php echo $image->relatedFilesId;?>">
                                                            <?php
                                                            if($comments['num']!=0)
                                                            {
                                                                foreach($comments['allComment'] as $row)
                                                                {
                                                                    foreach($allDesignerDetails as $designer)
                                                                    {
                                                                            if($designer->userId==$row->addedBy)
                                                                            {
                                                                                    $name=$designer->first_name." ".$designer->middle_name." ".$designer->last_name;
                                                                            }
                                                                    }
                                                            ?>
                                                                            <div class="position-center">
                                                                                <p>
                                                                                <span><?php echo "<b><u>".$name."</u>:</b>"." ".$row->comments;?></span><br>
                                                                                <span><?php echo "<b><u>Date:</u></b>"." ".date('d-m-Y',strtotime($row->addedOn));?></span></p>
                                                                                
                                                                            </div>
                                                                <?php
                                                                }
                                                            }
                                                            else
                                                            {
                                                                echo "<div class='position-center' id='nocomment_".$image->relatedFilesId."'><p>No Comments Available.</p></div>";
                                                            }
                                                                ?>
                                                    </div>
                                                                <div class="position-center">
                                                                    <form action="" method="POST">
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control" id="givecomment_<?php echo $image->relatedFilesId?>" name="givecomment_<?php echo $image->relatedFilesId?>"placeholder="Enter comment">
                                                                            </div>
                                                                            <input type="button" class="btn btn-info" value="Comment" onclick="saveComment('<?php echo $projectDetails[0]->projectsId?>','<?php echo $image->relatedFilesId;?>');">
                                                                        </form>
                                                                </div>
                                                    
                                                </div>
                                            </div>
                                                </section>
                            
                                        </div>
            <?php
                       
                    }
                }
                else
                {
                    echo "No Image Available.";
                }
            ?>
            <!------------------Comment Without Image------------------------------>
            
            <div class="panel-body">
               
                <div class="col-lg-8">
                    <div  id="comment_<?php echo $projectDetails[0]->projectsId;?>">
                    
                                <label>Comments</label>
                                
                                <?php
                                $noImageComment=$this->commentModel->getAllComment('comments','projectsId',$projectDetails[0]->projectsId,'relatedFilesId',0);
                                if($noImageComment['num']!=0)
                                {
                                    foreach($noImageComment['allComment'] as $row)
                                    {
                                        foreach($allDesignerDetails as $designer)
                                        {
                                                if($designer->userId==$row->addedBy)
                                                {
                                                        $name=$designer->first_name." ".$designer->middle_name." ".$designer->last_name;
                                                }
                                        }
                                        
                                ?>
                                            <div class="position-center">
                                                <p>
                                                <span><?php echo "<b><u>".$name."</u>:</b>"." ".$row->comments;?></span><br>
                                                <span><?php echo "<b><u>Date:</u></b>"." ".date('d-m-Y',strtotime($row->addedOn));?></span>
                                                </p>
                                                
                                            </div>
                                    <?php
                                    }
                                }
                                else
                                {
                                    echo "<div class='position-center' id='nocomment_".$projectDetails[0]->projectsId."'><p>No Comments Available.</p></div>";
                                }
                                    ?>
                    </div>
                                    <div class="position-center">
                                        <form action="" method="POST">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="givecomment_<?php echo $projectDetails[0]->projectsId?>" name="givecomment_<?php echo $projectDetails[0]->projectsId?>" placeholder="Enter comment">
                                                </div>
                                                <input type="button" class="btn btn-info" value="Comment" onclick="saveComment('<?php echo $projectDetails[0]->projectsId?>','');">
                                            </form>
                                    </div>
                            
                </div>
            </div>
            
            <!---------------------End of comment without Image---------------------->
                      
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
<!--right sidebar start-->
<?php
    $this->load->view('includes/rightSidePanel');
?>

</section>

<!-- Placed js at the end of the document so the pages load faster -->
<!--------------assigned designers modal----------------->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Designers</h4>
      </div>
      <div class="modal-body">
        <?php
        $designerList=explode(',',$projectDetails[0]->addedBy);
        foreach($allDesignerDetails as $designer1)
        {
    ?>
    <div class="minimal-blue single-row">
        <div class='checkbox'>
            <input type='checkbox' name='assign[]' id="assign" class='assigned_check' value='<?php echo $designer1->userId?>' <?php if(in_array($designer1->userId,$designerList)){?> checked <?php } ?>><label><?php echo $designer1->first_name." ".$designer1->middle_name." ".$designer1->last_name;?></label>
       
        </div>
    </div>
        <?php
         }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="saveAssignedDesigner('<?php echo $projectDetails[0]->projectsId?>');">Update</button>
      </div>
    </div>

  </div>
</div>

<!--------------end of assigned designers modal----------------->

</body>
</html>
<script>
    //==============Save Comment=============//
    function saveComment(projectId,imageId) {
        //alert('comment');
        
        //alert(comment);exit();
        if (imageId!='') {
            var count=imageId;
            var noCmment=$('#nocomment_'+imageId);
            var showDiv=$('#comment_'+imageId);
        }
        else
        {
            var count=projectId;
            var noCmment=$('#nocomment_'+projectId);
            var showDiv=$('#comment_'+projectId);
        }
        var comment=$('#givecomment_'+count).val();
        $.ajax({
                url: "<?php echo base_url();?>index.php/commentCont/saveComment",
                type: "POST",
                data:{'comment':comment,'projectId':projectId,'imageId':imageId},
                async: false,
                success: function(result){
                    //alert(result);
                    $('#givecomment_'+count).val('');
                    noCmment.html('');
                    showDiv.append(result);
                    
                }

            });

    }
    
    //================Save assigned designer================//
    function saveAssignedDesigner(projectId) {
       
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
                    $('#msgDiv').html(result);
                    
                }

            });

    }
</script>
