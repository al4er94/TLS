<?php 
//echo $data;
?>
<div id = "content_calc">
    <h1>Калькулятор</h1>
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