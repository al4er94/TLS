<div class="service">
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
    <div class="row">
        <table class="table main-table">
        <thead>
            <tr>
                <th></th>
                <th>ВИД РАБОТЫ</th>
                <th>СТОИМОСТЬ РАБОТЫ</th>
                <th></th>
                <th>НЕОБХОДИМЫЕ МАТЕРИАЛЫ</th>
                <th>СТОИМОСТЬ МАТЕРИАЛОВ</th>
            </tr>
        </thead>
        <tbody>
            <tr id="oil">
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="oil_filter">
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="oil_gasket">
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="salon_filter">
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="air_filter">
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="break_fluid">
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="plugs">
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="diagnostics">
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
                <td style = "display: none"><input type="checkbox"></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
        </table>
    </div>
</div> 
