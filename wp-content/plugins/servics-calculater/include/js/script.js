var calculateOrder = {
    init:function(){      
        jQuery('#content_calc .add_manufacturer').on('click', function(){
           calculateOrder.addManufacturer();
        });
        jQuery('#content_calc .add_model').on('click', function(){
           calculateOrder.addModel();
        });
        jQuery('#content_calc .add_chassis').on('click', function(){
           calculateOrder.addChassis();
        });
        jQuery('#content_calc .chassis-form select[name=manufacturer_select]').on('change', function(){
           calculateOrder.changeManufacturerSelect(jQuery(this).val());
        });
        
    },
    addManufacturer:function(){
        let manufacturer = jQuery('#content_calc .manufacturer-form input[name=manufacturer]').val();
        let data ={
            action: 'addManufacturer',
            manufacturer: manufacturer
        }
        if(confirm('Добавить ' + manufacturer)){
            jQuery.post(ajaxurl, data, function(response) {
                alert(response);
            });
        }
    },
    addModel:function(){
        let manufacturer = jQuery('#content_calc select[name=manufacturer_select]').val();
        let model = jQuery('#content_calc .model-form input[name=model]').val();
        let data ={
            action: 'addModel',
            manufacturer: manufacturer,
            model:model
        }
        if(confirm('Добавить модель ' + model)){
            jQuery.post(ajaxurl, data, function(response) {
                alert(response);
            });
        }
    },
    addChassis:function(){
        let model = jQuery('#content_calc .chassis-form select[name=model_select]').val();
        let chassis = jQuery('#content_calc .chassis-form input[name=chassis]').val();
        let data ={
            action: 'addChassis',
            model:model,
            chassis:chassis
        }
        if(confirm('Добавить модификацию ' + chassis)){
            jQuery.post(ajaxurl, data, function(response) {
                alert(response);
            });
        }
    },
    changeManufacturerSelect:function(value){
        let data= {
            action: 'changeManufacturerSelect',
            manufacturer:value
        };
        jQuery.post(ajaxurl, data, function(response) {
            jQuery('#content_calc .chassis-form select[name=model_select]').html(response);
        });
    }
    
}

jQuery(function($){
    //var ajaxurlPLugin 
    $(document).ready(function(){
        calculateOrder.init();
    });
});
