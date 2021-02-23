var calcPublicScript = {
    data:{},
    fullPrice:'',
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
        
        //Отправка данных о сервисе
        jQuery('.service .submitOrder').on('click', function(){
           calcPublicScript.submitOrder();
        });
        
        //Отправка корзины
        jQuery('.service .submitOrder-cart').on('click', function(){
           calcPublicScript.submitOrderCart();
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
                    jQuery(tdArr[1]).html(calcPublicScript.renameKeyPrice(key));
                    jQuery(tdArr[2]).html(resp.priceTable[key]);
                    jQuery(tdArr[0]).find('input').show();
                    //jQuery(tdArr[0]).find('input').prop('checked', true);
                }
            }
            if(resp.priceTableParts.length !== 0){
                for (let key in resp.priceTableParts) {
                    let selector = key.replace('_price', '');
                    let tr = document.querySelector('.service .main-table #'+selector);
                    let tdArr = jQuery(tr).find('td');
                    if(key == 'oil_price'){
                        jQuery(tdArr[4]).html('Масло Toyota (объем '+resp.priceTableParts.oil_volume+'л.)');
                        jQuery(tdArr[5]).html(resp.priceTableParts[key]); 
                        jQuery(tdArr[3]).find('input').show();
                        //jQuery(tdArr[3]).find('input').prop('checked', true);
                        continue;
                    }
                    jQuery(tdArr[4]).html(calcPublicScript.renameKeyPrice(key));
                    jQuery(tdArr[5]).html(resp.priceTableParts[key]);
                    jQuery(tdArr[3]).find('input').show();
                    //jQuery(tdArr[3]).find('input').prop('checked', true);
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
    
    submitOrder:function(){
        let tr = document.querySelectorAll('.service .main-table tbody tr');
        //console.log(tr);
        var data = {};
        tr.forEach(function(item, i){
            let id = item.id;
            //console.log(id);
            let selectArr = item.querySelectorAll('input');
            let tdArr = item.querySelectorAll('td'); 
            //console.log(tdArr);
            let price = 'false';
            let priceProde = 'false';
            if(jQuery(selectArr[0]).prop('checked') == true){  
                price = jQuery(tdArr[2]).html();
            }
            if(jQuery(selectArr[1]).prop('checked') == true){  
                priceProde = jQuery(tdArr[5]).html();
            }
            let arr = {
                price: price,
                priceProde: priceProde
            }
            data[id] = arr;
        });
        calcPublicScript.data = data;
        calcPublicScript.printCatr(data);
    },
    
    submitOrderCart:function(){
        let phone = document.querySelector('.service .form-contact-div input[name="phone"]').value;
        let name = document.querySelector('.service .form-contact-div input[name="name"]').value;
        let data = {
            action: 'saveCart',
            cart: calcPublicScript.data,
            phone: phone,
            name: name
        }
        jQuery.post(ajaxurl, data, function(response) {
            if(!alert('Ваша заявка успешно отправлена! В скором времени с вами свяжется менеджер!')){window.location.reload();}
        });
    },
    
    showModal:function(){
        //event.preventDefault();
          jQuery('#myOverlay').fadeIn(297,	function(){
            jQuery('#myModal') 
            .css('display', 'block')
            .animate({opacity: 1}, 198);
            
          });
    },
    
    printCatr:function(data){
        let nonEmpty = false;
        let html = '';
        for (let key in data) {
            //let price = '';
            //let priceProde = '';
            
            if(data[key].price != 'false'){
                nonEmpty = true;
                html += '<tr>';
                html += '<td>'+calcPublicScript.renameKeyPrice(key)+'</td>';
                html += '<td>'+data[key].price+'</td>';
                html += '<td class="removeRow" data-key="'+key+'" data-price="price">X</td>';
                html += '</tr>';
            }
            if(data[key].priceProde != 'false'){
                nonEmpty = true;
                html += '<tr>';
                html += '<td>'+key+'</td>';
                html += '<td>'+data[key].priceProde+'</td>';
                html += '<td class="removeRow" data-key="'+key+'" data-price="priceProde">X</td>';
                html += '</tr>';
            }
        }
        jQuery('#modle-content table.price-cart-table tbody').html(html);
        //Удаление строчки из корзины
        jQuery('#modle-content .removeRow').on('click', function(){
           calcPublicScript.removeRow(jQuery(this));
        });
        if(nonEmpty){
            calcPublicScript.showModal();
        }
    },  
    
    removeRow:function(item){
        let key = jQuery(item).data('key');
        let price = jQuery(item).data('price');
        calcPublicScript.data[key][price] = 'false';
        jQuery(item).parent().remove();
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
            // Переименование запчастей
            case 'oil_filter_price':key = 'Масляный фильтр(Toyota)';
                break;  
            case 'oil_gasket_price':key = 'Прокладка под сливное отверстие(Toyota)';
                break;
            case 'salon_filter_price':key = 'Фильтр салона(Filtron)';
                break;  
            case 'air_filter_price': key = 'Воздушный фильтр(Toyota)';
                break;
            case 'break_fluid_price':key = 'Тормозная жидкость(Toyota)';
                break
            case 'plugs_price':key = 'Свечи(Toyota)';
                break
        }
        return key;
    }
}

jQuery(function($){
    $(document).ready(function(){
        calcPublicScript.init();
    });
    
    $(document).ready(function() {

        $('#myModal__close, #myOverlay').click( function(){
          $('#myModal').animate({opacity: 0}, 198, function(){
            $(this).css('display', 'none');
            $('#myOverlay').fadeOut(297);
          });
        });
  });
  
});
