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
        
        calcPublicScript.setManufacturer();
        
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
            console.log(resp);
            if(resp.priceTable.length !== 0){
                for (let key in resp.priceTable) {
                    let tr = document.querySelector('.service .main-table #'+key);
                    let tdArr = jQuery(tr).find('td');
                    jQuery(tdArr[0]).html(calcPublicScript.renameKeyPrice(key));
                    jQuery(tdArr[1]).html(resp.priceTable[key]);
                }
            }
            if(resp.priceTableParts.length !== 0){
                for (let key in resp.priceTableParts) {
                    let selector = key.replace('_price', '');
                    let tr = document.querySelector('.service .main-table #'+selector);
                    let tdArr = jQuery(tr).find('td');
                    if(key == 'oil_price'){
                        jQuery(tdArr[2]).html('Масло Toyota (объем '+resp.priceTableParts.oil_volume+'л.)');
                        jQuery(tdArr[3]).html(resp.priceTableParts[key]); 
                        continue;
                    }
                    jQuery(tdArr[2]).html(key);
                    jQuery(tdArr[3]).html(resp.priceTableParts[key]);
                }
            }
        });
    },
    
    setManufacturer:function(){
        let manufacturer = localStorage.getItem('manufacturer');
        if(manufacturer){
             document.querySelector('.service form select[name=manufacturer_select]').value = manufacturer;
             calculateOrder.changeManufacturerSelect(manufacturer, '.service select[name=model_select]');
        }
    },
    
    renameKeyPrice:function(key){
        switch(key) {
            case 'oil':key = 'Замена масла';
                break;
            case 'oil_filter':key = 'Замена масляного фильтра';
                break;  
            case 'oil_gasket':key = 'Замена прокладки под сливное отверстие';
                break;
            case 'salon_filter':key = 'Замена салонного фильтра';
                break;  
            case 'air_filter':key = 'Замена воздушного';
                break;
            case 'break_fluid':key = 'Замена тормозной жидкости';
                break;  
            case 'plugs': key = 'Замена свечей зажигания';
                break;
            case 'diagnostics':key = 'Диагностика';
                break;             
        }
        return key;
    }
}

jQuery(function($){
    $(document).ready(function(){
        calcPublicScript.init();
    });
});


