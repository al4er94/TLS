<div class="service">
    <!--<h2>Рассчитайте стоимость ТО Вашего автомобиля<br><b>всего в 3 клика</b></h2>-->
    <div class="filters vc_row vc_cta3 vc_cta3-style-flat vc_cta3-shape-rounded">
        <form>
            <div class="vc_col-sm-4">
                <div class="wpb_wrapper"> 
                        <span class="current">Марка</span> 
                        <div class="selectric-wrapper selectric-s1 bblink selectric-above">
                            <div class="selectric-hide-select">
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
                            </div>
                        </div>
                        <span class="current">Модель</span> 
                        <div class="selectric-wrapper selectric-s1 bblink selectric-above">
                            <div class="selectric-hide-select">
                            <select name="model_select">
                                <option value =""></option>
                            </select>
                            </div>
                        </div>
                        <span class="current">Модификация</span> 
                        <div class="selectric-wrapper selectric-s1 bblink selectric-above">
                            <div class="selectric-hide-select">
                            <select name="chasis_select">
                                <option value =""></option>
                            </select>
                            </div>
                        </div>  
                  </div>    
            </div>
        </form>
    </div>
</div>    