 function calculate(){
        
        $material_id=$this->input->post('material_id');
         $unit_id=$this->input->post('unit_id');
        $quantity_ajax=$this->input->post('quantity');
        //echo $material_id;
       // echo $unit_id;
        //echo $quantity_ajax;
       // die;
      
        if($material_id!="" && ($unit_id!="" && $quantity_ajax!="") ){
        
        $whereArray = array('material_id' => $material_id);		
        $material_details=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArray,'material_id');
            
          // echo "<pre>";
            //print_r($material_details);die;
            $unit_id_kg=$material_details['result'][0]->unit_id ;
        
        $whereArray = array('unit_id' =>$unit_id_kg);	
        $unit_details=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArray,'unit_id');
            
            $whereArray = array('unit_id' =>$unit_id);	
        $unit_details1=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArray,'unit_id');
            //cho "<pre>";
            //print_r($unit_details);die;
        
        $item_quantity=$quantity_ajax;
        $quantity= $material_details['result'][0]->quantity;
        $avg_price=$material_details['result'][0]->avg_price;
         $value=$unit_details['result'][0]->value;
        $value_togm_ml=$unit_details1['result'][0]->value;
            //echo $value_togm_ml;
        
            if($quantity==0){
             $convert=$value;  
            }
            else{
         $convert=$quantity*$value;
            }
      // echo $convert;die;
         $convert_mg=$avg_price/$convert;
           //echo $convert_mg;die;
        $a=number_format($convert_mg,20);
          //echo $a;die;
        $price=($a*$item_quantity);
           // echo $price;die;
            $final_price=$price*$value_togm_ml;
           // echo $final_price;
         //$total_price=$total_price+$price;
        
        echo $final_price;
       }
        
        else
        {
           // echo "0";
        }
//        echo $quantity;
//        echo $avg_price;
//        echo $value;
//        echo "<pre>";
//        print_r($material_details);
//        print_r($unit_details);
//        die;
        
    }
    