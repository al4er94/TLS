var calculateOrder = {
    init:function(){      
        jQuery('#content_calc .add').on('click', function(){
           calculateOrder.addManufacturer();
        })
    },
    addManufacturer:function(){
        let manufacturer = jQuery('#content_calc input[name=manufacturer]').val();
        let data ={
            action: 'addManufacturer',
            manufacturer: manufacturer
        }
        if(confirm('Добавить ' + manufacturer)){
            jQuery.post(ajaxurl, data, function(response) {
                alert(response);
            });
            
        }
    }
}

jQuery(function($){
    //var ajaxurlPLugin 
    $(document).ready(function(){
        calculateOrder.init();
    });
});
