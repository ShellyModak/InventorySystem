function initialize_date_picker(field_identifier, min_date, max_date, dateFormat){
        
        var params={}
        
        if(min_date !== undefined && min_date != "")
            params.minDate= new Date(min_date)
        
        if(max_date !== undefined && max_date != "")
            params.maxDate= new Date(max_date)
        
        params.dateFormat= (dateFormat !== undefined && dateFormat != "")? dateFormat : "yy-mm-dd";
        
        
        $(field_identifier).datepicker(params);
}