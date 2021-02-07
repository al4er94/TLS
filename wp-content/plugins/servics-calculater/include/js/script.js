var calculateOrder = {
    init:function(){   
        //Добавляем производителя
        jQuery('#content_calc .add_manufacturer').on('click', function(){
           calculateOrder.addManufacturer();
        });
        
        //Добавляем модель
        jQuery('#content_calc .add_model').on('click', function(){
           calculateOrder.addModel();
        });
        
        //Добавляем модификацию
        jQuery('#content_calc .add_chassis').on('click', function(){
           calculateOrder.addChassis();
        });
        
        //Изменение производителя в добавлении модели
        jQuery('#content_calc .chassis-form select[name=manufacturer_select]').on('change', function(){
           calculateOrder.changeManufacturerSelect(jQuery(this).val(), '#content_calc .chassis-form select[name=model_select]');
        });
        
        //Изменение производителя в добавлении прайса
        jQuery('#content_calc .add-price-id select[name=manufacturer_select]').on('change', function(){
           calculateOrder.changeManufacturerSelect(jQuery(this).val(), '#content_calc .add-price-id select[name=model_select]');
        });
        
        //Изменение модели в добавлении прайса
        jQuery('#content_calc .add-price-id select[name=model_select]').on('change', function(){
           calculateOrder.changeModelSelect(jQuery(this).val(), '#content_calc .add-price-id select[name=chasis_select]');
        });
        
        //Изменение модификации в добавлении прайса. Подгрузка прайса
        jQuery('#content_calc .add-price-id select[name=chasis_select]').on('change', function(){
           calculateOrder.changeChasisSelect();
        });
        //Добавляем прайс в БД
        jQuery('#content_calc .add-price-button').on('click', function(){
            let inputArr= document.querySelectorAll('.add_data .form-price input');
            let dataArray = {};
            inputArr.forEach(element => {
                dataArray[element.getAttribute('name')] = element.value;
            });
            let data = {
                action: 'addPriceInBd',
                manufacturer: document.querySelector('#content_calc .add-price-id select[name=manufacturer_select]').value,
                model: document.querySelector('#content_calc .add-price-id select[name=model_select]').value,
                chasis: document.querySelector('#content_calc .add-price-id select[name=chasis_select]').value,
                dataArray: dataArray
            }
            if(data.manufacturer == '' || data.model == '' || data.chasis ==''){
                alert('Проверь производителя/модель/модификацию');
                return false;
            }
            jQuery.post(ajaxurl, data, function(response) {
                alert(response);
            });
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
    changeManufacturerSelect:function(value, selector){
        let data= {
            action: 'changeManufacturerSelect',
            manufacturer:value
        };
        jQuery.post(ajaxurl, data, function(response) {
            jQuery(selector).html(response);
        });
    },
    changeModelSelect:function(value, selector){
        let data= {
            action: 'changeModelSelect',
            model:value
        }
        jQuery.post(ajaxurl, data, function(response) {
            jQuery(selector).html(response);
        });
    },
    
    changeChasisSelect:function(){
        let data = {
            action: 'getPrice',
            manufacturer: document.querySelector('#content_calc .add-price-id select[name=manufacturer_select]').value,
            model: document.querySelector('#content_calc .add-price-id select[name=model_select]').value,
            chasis: document.querySelector('#content_calc .add-price-id select[name=chasis_select]').value,
        }
        jQuery.post(ajaxurl, data, function(response) {
            let resp = JSON.parse(response);
            console.log(resp);
            if(resp.priceTable.length == 0){
                document.querySelector('.form-price input[name=oil]').value = 0;
                document.querySelector('.form-price input[name=oil_filter]').value = 0;
                document.querySelector('.form-price input[name=oil_gasket]').value = 0;
                document.querySelector('.form-price input[name=air_filter]').value = 0;
                document.querySelector('.form-price input[name=salon_filter]').value = 0;
                document.querySelector('.form-price input[name=break_fluid]').value = 0;
                document.querySelector('.form-price input[name=plugs]').value = 0;
                document.querySelector('.form-price input[name=diagnostics]').value = 0;
                return true;
            }
            
            document.querySelector('.form-price input[name=oil]').value = resp.priceTable.oil;
            document.querySelector('.form-price input[name=oil_filter]').value = resp.priceTable.oil_filter;
            document.querySelector('.form-price input[name=oil_gasket]').value = resp.priceTable.oil_gasket;
            document.querySelector('.form-price input[name=air_filter]').value = resp.priceTable.air_filter;
            document.querySelector('.form-price input[name=salon_filter]').value = resp.priceTable.salon_filter;
            document.querySelector('.form-price input[name=break_fluid]').value = resp.priceTable.break_fluid;
            document.querySelector('.form-price input[name=plugs]').value = resp.priceTable.plugs;
            document.querySelector('.form-price input[name=diagnostics]').value = resp.priceTable.diagnostics;
        });
    }
    
}

jQuery(function($){
    //var ajaxurlPLugin 
    $(document).ready(function(){
        calculateOrder.init();
    });
});
