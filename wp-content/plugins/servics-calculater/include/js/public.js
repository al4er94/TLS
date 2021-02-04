var calcPublicScript = {
    init:function(){      
        //Добавляем модификацию
        jQuery('.main_calc_form ul#mainImages a').on('click', function(){
           calcPublicScript.getCarPage(jQuery(this));
        });
        
        //Изменение производителя 
        jQuery('.service form select[name=manufacturer_select]').on('change', function(){
           calculateOrder.changeManufacturerSelect(jQuery(this).val(), '.service select[name=model_select]');
        });
        
        //Изменение модели 
        jQuery('.service form select[name=model_select]').on('change', function(){
           calculateOrder.changeModelSelect(jQuery(this).val(), '.service select[name=chasis_select]');
        });
        
        //Изменение модификации 
        jQuery('.service form select[name=chasis_select]').on('change', function(){
           calcPublicScript.getPrice();
        });
        
    },
    getCarPage:function(link){
       let car = jQuery(link).data('car');
       localStorage.setItem('manufacturer', car);
       let url = document.URL;
       if(url.toString().slice(-1) == '#'){
           url = url.substring(0, url.length - 1);
       }
       document.location.href = url+'/calculate_to';
    },
    
    getPrice:function(){
        let data = {
            action: 'getPrice',
            manufacturer: document.querySelector('.service form select[name=manufacturer_select]').value,
            model: document.querySelector('.service form select[name=model_select]').value,
            chasis: document.querySelector('.service form select[name=chasis_select]').value
        }
        jQuery.post(ajaxurl, data, function(response) {
            let resp = JSON.parse(response);
            if(resp.length !== 0){
                console.log(resp);
                for (let key in resp) {
                    let tr = document.querySelector('.service .main-table #'+key);
                    let tdArr = jQuery(tr).find('td');
                    jQuery(tdArr[0]).html(key);
                    jQuery(tdArr[1]).html(resp[key]);
                }
            }
        });
    }
}

jQuery(function($){
    $(document).ready(function(){
        calcPublicScript.init();
    });
});


