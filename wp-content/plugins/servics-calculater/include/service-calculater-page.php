<?php 
//var_dump($_COOKIE);
if(!isset($_COOKIE['calcContent']) || $_COOKIE['calcContent'] == 1){
?>
<div id = "content_calc">   
    <h1>Калькулятор</h1>
    <button id="calc_content_1">Массовое обновление</button>
    <div class="add_data">
        <h2>Добавить сущность</h2>
        <div class = "form manufacturer-form">
            <input type="text" name="manufacturer">
            <a class = "add_manufacturer">Добавить производителя</a>
        </div>
        <div class = "form model-form">
            <select name="manufacturer_select">
                <?php 
                foreach ($data['manufacturer'] as $manufacturer){
                    ?>
                <option value ="<?php echo $manufacturer['id'] ?>"><?php echo $manufacturer['name']?></option>
                <?php
                }
                ?> 
            </select>
            <input type="text" name="model">
            <a class = "add_model">Добавить модель</a>
        </div>
        <div class = "form chassis-form">
            <select name="manufacturer_select">
                <option value ="" selected="selected"></option>
                <?php 
                foreach ($data['manufacturer'] as $manufacturer){
                    ?>
                <option value ="<?php echo $manufacturer['id'] ?>"><?php echo $manufacturer['name']?></option>
                <?php
                }
                ?> 
            </select>
            <select name="model_select">
            </select>
            <input type="text" name="chassis">
            <a class = "add_chassis">Добавить модификацию</a>
        </div>
    </div>
    <div class="add_data">
        <h2>Добавить/изменить прайс</h2>
        <div class = "form add-price-id">
            <select name="manufacturer_select">
                <option value =""></option>
                <?php 
                foreach ($data['manufacturer'] as $manufacturer){
                    ?>
                <option value ="<?php echo $manufacturer['id'] ?>"><?php echo $manufacturer['name']?></option>
                <?php
                }
                ?> 
            </select>
            <select name="model_select">
            </select>
            <select name="chasis_select">
            </select>
        </div>
        <hr>
        <div class="form form-price">
            <lable>Масло: </lable><input name="oil" type="text"><lable>номер:</lable><input name="oil_number" type="text"><lable>объем: </lable><input name="oil_volume" type="text"><br>
            <lable>Масляный фильтр: </lable><input name="oil_filter" type="text"><lable>номер:</lable><input name="oil_filter_number" type="text"><br>
            <lable>Прокладка сливная: </lable><input name="oil_gasket" type="text"><lable>номер:</lable><input name="oil_gasket_number" type="text"><br>
            <lable>Воздушный: </lable><input name="air_filter" type="text"><lable>номер:</lable><input name="air_filter_number" type="text"><br>    
            <lable>Салонный: </lable><input name="salon_filter" type="text"><lable>номер:</lable><input name="salon_filter_number" type="text"><br>
            <lable>Тормозная: </lable><input name="break_fluid" type="text"><lable>номер:</lable><input name="break_fluid_number" type="text"><br>
            <lable>Свечи: </lable><input name="plugs" type="text"><lable>номер:</lable><input name="plugs_number" type="text"><br>
            <lable>Диагностика</lable><input name="diagnostics" type="text"><br>
            <button class="add-price-button">Добавить</button>
        </div>
    </div>
</div>
<?php }
else if(isset($_COOKIE['calcContent']) || $_COOKIE['calcContent'] == 2){?>
<div id = "content_calc">   
    <h1>Калькулятор</h1>
    <button id="calc_content_2">Обновление прайсов</button>
    <h2>Массовое обновление работы</h2>
    <br>
    <div class="form form-price-2">
        <lable>Масло: </lable><input name="oil" type="text"><br>
        <lable>Масляный фильтр: </lable><input name="oil_filter" type="text"><br>
        <lable>Прокладка сливная: </lable><input name="oil_gasket" type="text"><br>
        <lable>Воздушный: </lable><input name="air_filter" type="text"><br>    
        <lable>Салонный: </lable><input name="salon_filter" type="text"><br>
        <lable>Тормозная: </lable><input name="break_fluid" type="text"><br>
        <lable>Свечи: </lable><input name="plugs" type="text"><br>
        <lable>Диагностика</lable><input name="diagnostics" type="text"><br>
        <button class="add-price-button-2">Обновить</button>
    </div>
    <br>
    <hr>
    <input id="sortpicture" type="file" name="sortpic" />
    <button id="upload">Загрузить</button>
    <button id="start_update" style="display:none;">Обновить прайс</button>
</div>
<?php } ?>
