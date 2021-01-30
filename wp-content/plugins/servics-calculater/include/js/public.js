var calcPublicScript = {
    init:function(){      
        //Добавляем модификацию
        jQuery('.main_calc_form ul#mainImages a').on('click', function(){
           calcPublicScript.getCarPage(jQuery(this));
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
    }
}

jQuery(function($){
    $(document).ready(function(){
        calcPublicScript.init();
    });
});


