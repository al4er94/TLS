<?php 
//echo $data;
?>
<div id = "content_calc">   
    <h1>Калькулятор</h1>
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
        <h2>Добавить прайс</h2>
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
            <lable>Масло: </lable><input name="oil" type="text"><br>
            <lable>Масляный фильтр: </lable><input name="oil_filter" type="text"><br>
            <lable>Прокладка сливная: </lable><input name="oil_gasket" type="text"><br>
            <lable>Воздушный: </lable><input name="air_filter" type="text"><br>    
            <lable>Салонный: </lable><input name="salon_filter" type="text"><br>
            <lable>Тормозная: </lable><input name="break_fluid" type="text"><br>
            <lable>Свечи: </lable><input name="plugs" type="text"><br>
            <lable>Диагностика</lable><input name="diagnostics" type="text"><br>
            <button class="add-price-button">Добавить</button>
        </div>
    </div>
</div>