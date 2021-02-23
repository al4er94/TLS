<div class="service">
    <div class="filters vc_row vc_cta3 vc_cta3-style-flat vc_cta3-shape-rounded">
        <form>
            <div class="vc_col-sm-4">
                <div class="wpb_wrapper select-div-class"> 
                        <div class="selectric-wrapper selectric-s1 bblink selectric-above">
                           <span class="current">Марка</span> 
                            <div class="selectric-hide-select">
                              <span class="custom-dropdown big">  
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
                              </span>
                            </div>
                        </div>
                        <div class="selectric-wrapper selectric-s1 bblink selectric-above">
                          <span class="current">Модель</span> 
                            <div class="selectric-hide-select">
                              <span class="custom-dropdown big">
                                <select name="model_select">
                                    <option value =""></option>
                                </select>
                              </span>
                            </div>
                        </div>
                        <div class="selectric-wrapper selectric-s1 bblink selectric-above">
                          <span class="current">Модификация</span>
                            <div class="selectric-hide-select">
                            <span class="custom-dropdown big">  
                              <select name="chasis_select">
                                  <option value =""></option>
                              </select>
                            </span>  
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
              <td><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="oil_filter">
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="oil_gasket">
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="salon_filter">
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="air_filter">
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="break_fluid">
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="plugs">
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr id="diagnostics">
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
                <td ><input type="checkbox" style="display: none;"></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
        </table>
    </div>
    <div class="row">
        <button class="button button-primary submitOrder button-price-cart">Отправить</button>
    </div>
    <div id="myModal">
        <div id = "modle-content">
            <table class="table new-table price-cart-table">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Цена</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <div class="form-contact-div">
            <lable>Имя: </lable>
            <input type="text" name='name'>
            <lable>Телефон: </lable>
            <input type="text" name='phone'>
        </div>
        <button class="button submitOrder-cart button-price-cart">Отправить</button>
      <span id="myModal__close" class="close">ₓ</span>
    </div>
    <div id="myOverlay"></div>
</div> 
