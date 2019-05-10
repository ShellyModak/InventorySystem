<aside>
    <div id="sidebar" class="nav-collapse">
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
            <?php 
                
            $admin_id=$this->session->userdata('id');
                
             $whereArr=array('id'=>$admin_id);
                 
                
                
        $admin_val_arr=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id'); 
        $admin_val_arr=$admin_val_arr['result'];
      
             
        if($admin_val_arr[0]->isSuperAdmin!=1)
        {
         $page_arr=explode(',', $admin_val_arr[0]->pageAccess);
        }
            
                
            $menu_arr=$this->Common_model->fetch_menu(0);
            
    foreach($menu_arr as $key=>$value)
    {?>
            
            
                
                <?php 
                                               
        if((!empty($page_arr) && in_array($value['id'], $page_arr)) || (empty($page_arr) && $admin_val_arr[0]->isSuperAdmin==1))
        { ?>             
                   <li class="sub-menu ">
                
                

                
                
               <a class="<?php $url1 = $this->uri->segment(1);
                                           
                           
                            if($url1==$value['link']){
                                
                                echo "active dcjq-parent";
                            }
                            else{
                                echo "noactive dcjq-parent";
                            }
                    
                    
                    ?>" href="<?php echo base_url().$value['link'];?>">
                    
                    <i class="fa fa-laptop"></i>
                    <span><?php echo $value['name'];?></span>
                </a> 
                       
              <?php
         
                $child_menu_arr=$this->Common_model->fetch_menu($value['id']);

            if($child_menu_arr)
            {
                foreach($child_menu_arr as $key=>$value)
                    {


                         if((!empty($page_arr) && in_array($value['id'], $page_arr)) || (empty($page_arr) && $admin_val_arr[0]->isSuperAdmin==1))
                            {?>

                                    <ul class="sub">

                                        <li class=""><a href="<?php echo base_url().$value['link'];?>" ><?php echo $value['name'];?></a></li>

                                    </ul>
                            <?php 

                            }
                        }
                
                
                }
                                              
            } ?>
            </li>
            
        
        <?php
    } ?>
        </ul>
        </div>        
<!-- sidebar menu end-->
    </div>
</aside>