<?php

/*
Plugin Name: Калькулятор сервиса
Description: Краткое описание плагина.
Version: Номер версии плагина, например: 1.0.0
Author: Имя автора плагина
*/
define('SERVICE_CALC', plugin_dir_path(__FILE__));
include_once("PHPExcel/Classes/PHPExcel.php");
new ServicsCalc();
class ServicsCalc{
    
    public $DB;


    public function __construct() {
        add_filter('the_title', array(__CLASS__, 'changeTitle'));
        add_action('admin_menu', array(__CLASS__, 'anblog_bloknot_menu') );
        // 
        add_shortcode( 'show_form', array(__CLASS__, 'showForm') );
        add_shortcode( 'show_form_in_page', array(__CLASS__, 'showFormInPage') );
        
        //Для аяксов amin
        add_action( 'wp_ajax_addManufacturer', array(__CLASS__, 'addManufacturer') );
        add_action( 'wp_ajax_addModel', array(__CLASS__, 'addModel') );
        add_action( 'wp_ajax_addChassis', array(__CLASS__, 'addChassis') );
        add_action( 'wp_ajax_changeManufacturerSelect', array(__CLASS__, 'changeManufacturerSelect'));
        add_action( 'wp_ajax_changeModelSelect', array(__CLASS__, 'changeModelSelect'));
        add_action( 'wp_ajax_addPriceInBd', array(__CLASS__, 'addPriceInBd'));
        add_action( 'wp_ajax_getPrice', array(__CLASS__, 'getPrice'));
        add_action( 'wp_ajax_saveCart', array(__CLASS__, 'saveCart'));
        add_action( 'wp_ajax_updateAllPrice', array(__CLASS__, 'updateAllPrice'));
        add_action( 'wp_ajax_uploadFile', array(__CLASS__, 'uploadFile'));
        add_action( 'wp_ajax_readExellFile', array(__CLASS__, 'readExellFile'));
        //Для аяксов 
        add_action( 'wp_ajax_nopriv_changeManufacturerSelect', array(__CLASS__, 'changeManufacturerSelect'));
        add_action( 'wp_ajax_nopriv_changeModelSelect', array(__CLASS__, 'changeModelSelect'));
        add_action( 'wp_ajax_nopriv_getPrice', array(__CLASS__, 'getPrice'));
        add_action( 'wp_ajax_nopriv_saveCart', array(__CLASS__, 'saveCart'));
        
        register_activation_hook(__FILE__, array(__CLASS__, 'updateBD'));
        //self::readExellFile();
    }
    
    public function changeTitle($title){
        return $title;
    }
    public static function anblog_bloknot_menu() {        
        wp_enqueue_script( 'calcscript', plugin_dir_url(__FILE__).'include/js/script.js');
        wp_enqueue_script('calcscript');
        add_menu_page('Калькулятор сервиса', 'Калькулятор сервиса', 'manage_options', 'servics-calculater', array(__CLASS__, 'getPage'), 'dashicons-calculator' );
    }

    public static function updateBD(){
        global $wpdb;
        $sql = "CREATE TABLE IF NOT EXISTS "
                . "`".PREFIX."calc_manufacturer` ( "
                . "`id` INT NOT NULL AUTO_INCREMENT , "
                . "`name` VARCHAR(256) NOT NULL , "
                . "PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        $wpdb->query($sql);
        $sql = "CREATE TABLE IF NOT EXISTS "
                . "`".PREFIX."calc_model` ("
                . " `id` INT NOT NULL AUTO_INCREMENT , "
                . " `manufacture_id` INT NOT NULL , "
                . "`name` VARCHAR(256) NOT NULL ,"
                . "PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        $wpdb->query($sql);
        $sql = "CREATE TABLE IF NOT EXISTS "
                . "`".PREFIX."calc_chassis` ( "
                . "`id` INT NOT NULL AUTO_INCREMENT , "
                . "`model_id` INT NOT NULL , "
                . "`name` VARCHAR(256) NOT NULL , "
                . "PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        $wpdb->query($sql);
        
        $sql = "CREATE TABLE IF NOT EXISTS `".PREFIX."calc_price` ( `id` INT NOT NULL AUTO_INCREMENT , `price_id` VARCHAR(256) NOT NULL , `oil` VARCHAR(256) NOT NULL DEFAULT '0' , `oil_filter` VARCHAR(256) NOT NULL DEFAULT '0' , `oil_gasket` VARCHAR(256) NOT NULL DEFAULT '0' , `air_filter` VARCHAR(256) NOT NULL DEFAULT '0' , `salon_filter` VARCHAR(256) NOT NULL DEFAULT '0' , `break_fluid` VARCHAR(256) NOT NULL DEFAULT '0' , `plugs` VARCHAR(256) NOT NULL DEFAULT '0' , `diagnostics` VARCHAR(256) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        $wpdb->query($sql);
        
        $sql = "CREATE TABLE IF NOT EXISTS `".PREFIX."calc_price_parts` ("
                . "`id` INT NOT NULL AUTO_INCREMENT ,"
                . "`price_id` INT NOT NULL ,"
                . "`oil_price` VARCHAR(256) NOT NULL ,"
                . "`oil_volume` VARCHAR(256) NOT NULL , "
                . "`oil_filter_price` VARCHAR(256) NOT NULL , "
                . "`oil_gasket_price` VARCHAR(256) NOT NULL , "
                . "`air_filter_price` VARCHAR(256) NOT NULL , "
                . "`salon_filter_price` VARCHAR(256) NOT NULL ,"
                . "`break_fluid_price` VARCHAR(256) NOT NULL , "
                . "`pads_front_price` VARCHAR(256) NOT NULL , "
                . "`pads_rear_price` VARCHAR(256) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        $wpdb->query($sql);
        $sql = "CREATE TABLE `".PREFIX."calc_code_price` ( "
                . "`id` INT NOT NULL AUTO_INCREMENT , "
                . "`code` VARCHAR(256) NOT NULL , "
                . "`price` FLOAT NOT NULL , PRIMARY KEY (`id`)) "
                . "ENGINE = InnoDB;";
        $wpdb->query($sql);
  
    }
    
    public static function addManufacturer(){
        if($_POST['manufacturer'] !== ''){
            $manufacturer = strval($_POST['manufacturer']);
        }
        
        global $wpdb;
        $table = $wpdb->prefix.'calc_manufacturer';
        $data = ['name' => $manufacturer];
        $wpdb->insert($table, $data);
        $my_id = $wpdb->insert_id;
        echo "Добавлен производитель $manufacturer с id=".$my_id;
        wp_die();
    }
    
    public function getPage(){
        global $wpdb;
        $data = array();
        $newtable = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."calc_manufacturer`" );
        foreach($newtable as $row){
            $data['manufacturer'][] = [
                'id' => $row->id,
                'name' => $row->name
            ];
        }
        include('include/service-calculater-page.php'); 
    }
    
    public static function addModel(){
        global $wpdb;
        if($_POST['model'] !== ''){
            $model = strval($_POST['model']);
        }
        $table = $wpdb->prefix.'calc_model';
        $data = [
            'manufacture_id' => intval($_POST['manufacturer']),
            'name' => $model
        ];
        $wpdb->insert($table, $data);
        $my_id = $wpdb->insert_id;
        echo "Добавлена модель $model с id=".$my_id;
        wp_die();
    }
    
    public static function changeManufacturerSelect(){
        global $wpdb;
        $newtable = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."calc_model` WHERE `manufacture_id`=".intval($_POST['manufacturer']) );
        $html = '';
        $html .= '<option value="0">Выберите модель</option>';
        foreach ($newtable as $item){
            $html .= '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        echo $html;
        wp_die();
    }
    
    public static function changeModelSelect(){
        global $wpdb;
        $newtable = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."calc_chassis` WHERE `model_id`=".intval($_POST['model']) );
        $html = '';
        $html .= '<option value="0">Выберите комплектацию</option>';
        foreach ($newtable as $item){
            $html .= '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        echo $html;
        wp_die();
    }

    public static function addChassis(){
        global $wpdb;
        if($_POST['model'] !== ''){
            $chassis = strval($_POST['chassis']);
        }
        $table = $wpdb->prefix.'calc_chassis';
        $data = [
            'model_id' => intval($_POST['model']),
            'name' => $chassis
        ];
        $wpdb->insert($table, $data);
        $my_id = $wpdb->insert_id;
        echo "Добавлена модификация $chassis с id=".$my_id;
        wp_die();
    }
    
    public static function addPriceInBd(){
        global $wpdb;
        $priceIdTable = $wpdb->get_results( "SELECT `id` FROM `".$wpdb->prefix."calc_price_id` WHERE"
                . " `manufacture_id`=".intval($_POST['manufacturer'])." AND"
                . " `model_id`=".intval($_POST['model'])." AND"
                . " `chassis_id`=".intval($_POST['chasis']) );
        //var_dump($priceIdTable);
        if(count($priceIdTable)==0){
            $table = $wpdb->prefix.'calc_price_id';
            $data = [
                'manufacture_id' => intval($_POST['manufacturer']),
                'model_id' => intval($_POST['model']),
                'chassis_id' => intval($_POST['chasis']),
            ];
            $wpdb->insert($table, $data);
            $priceId = $wpdb->insert_id;           
        }else{
            $priceId = $priceIdTable[0]->id;
        }
        
        $priceTable = $wpdb->get_results("SELECT `id` FROM `".$wpdb->prefix."calc_price` WHERE `price_id`=".$priceId);
        $table = $wpdb->prefix.'calc_price';
        $data = [
            'price_id' => $priceId,
            'oil' => floatval($_POST['dataArray']['oil']),
            'oil_filter' => floatval($_POST['dataArray']['oil_filter']),
            'oil_gasket' => floatval($_POST['dataArray']['oil_gasket']),
            'air_filter' => floatval($_POST['dataArray']['air_filter']),
            'salon_filter' => floatval($_POST['dataArray']['salon_filter']),
            'break_fluid' => floatval($_POST['dataArray']['break_fluid']),
            'plugs' => floatval($_POST['dataArray']['plugs']),
            'diagnostics' => floatval($_POST['dataArray']['diagnostics']),
        ];
        if(count($priceTable)==0){
            $wpdb->insert($table, $data);
        }else{
            $wpdb->update($table, $data, ['price_id' => $priceId]);;
        }
        // Обновление или создание номеров запчастей
        $priceTable = $wpdb->get_results("SELECT `id` FROM `".$wpdb->prefix."calc_price_parts` WHERE `price_id`=".$priceId);
        $table = $wpdb->prefix.'calc_price_parts';
        $data = [
            'price_id' => $priceId,
            'oil_price' => $_POST['dataArray']['oil_number'],
            'oil_volume' => $_POST['dataArray']['oil_volume'],
            'oil_filter_price' => $_POST['dataArray']['oil_filter_number'],
            'oil_gasket_price' => $_POST['dataArray']['oil_gasket_number'],
            'air_filter_price' => $_POST['dataArray']['air_filter_number'],
            'salon_filter_price' => $_POST['dataArray']['salon_filter_number'],
            'break_fluid_price' => $_POST['dataArray']['break_fluid_number'],
            'plugs_price' => $_POST['dataArray']['plugs_number'],
        ]; 
        if(count($priceTable)==0){
            $wpdb->insert($table, $data);
        }else{
            $wpdb->update($table, $data, ['price_id' => $priceId]);
        }
        echo 'Прайс обновлен!';
        wp_die();
    }
    
    public static function getPrice(){
        global $wpdb;
        $data = array();
        $priceTable = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."calc_price` "
                ." LEFT JOIN `".$wpdb->prefix."calc_price_id` "
                . " ON `".$wpdb->prefix."calc_price`.`price_id` = `".$wpdb->prefix."calc_price_id`.`id`"
                . "WHERE `manufacture_id`=".intval($_POST['manufacturer'])." AND"
                . "`model_id`=".intval($_POST['model'])." AND"
                . "`chassis_id`=".intval($_POST['chasis']));
        
        $priceTableParts = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."calc_price_parts` "
                ." LEFT JOIN `".$wpdb->prefix."calc_price_id` "
                . " ON `".$wpdb->prefix."calc_price_parts`.`price_id` = `".$wpdb->prefix."calc_price_id`.`id`"
                . "WHERE `manufacture_id`=".intval($_POST['manufacturer'])." AND"
                . "`model_id`=".intval($_POST['model'])." AND"
                . "`chassis_id`=".intval($_POST['chasis']));
        $codeTable = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."calc_code_price` ");
        $codeArr = array();
        foreach ($codeTable as $obj){
            $codeArr[$obj->code] = $obj->price;
        }
        
        if(!isset($_POST['admin']) || $_POST['admin'] == 'false'){
            foreach ($priceTableParts[0] as $key => &$part){
                if(isset($codeArr[$part])){
                    $part = $codeArr[$part];
                }
            }
        }
        $data['priceTable'] = !empty($priceTable)?$priceTable[0]:array();
        $data['priceTableParts'] = !empty($priceTableParts)?$priceTableParts[0]:array();
        echo json_encode($data);
        
        wp_die();
    }
    
    public static function showForm(){
        wp_enqueue_style('style', '/wp-content/plugins/servics-calculater/include/css/style.css');
        wp_enqueue_script('calcPublicScript', plugin_dir_url(__FILE__).'include/js/public.js');
        wp_enqueue_script('calcPublicScript');
        ob_start();
        include( 'include/service_main_form.php' );
        return ob_get_clean();
    }
    
    public static function showFormInPage(){
        global $wpdb;
        $data = array();
        $newtable = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."calc_manufacturer`" );
        foreach($newtable as $row){
            $data['manufacturer'][] = [
                'id' => $row->id,
                'name' => $row->name
            ];
        }
        wp_enqueue_style('style', '/wp-content/plugins/servics-calculater/include/css/style.css');
        wp_enqueue_script('calcPublicScript', plugin_dir_url(__FILE__).'include/js/public.js');
        wp_enqueue_script('calcPublicScript');
        wp_enqueue_script('calcscript', plugin_dir_url(__FILE__).'include/js/script.js');
        wp_enqueue_script('calcscript');
        wp_localize_script( 'calcscript', 'ajaxurl', 
            array(
		        'url' => admin_url('admin-ajax.php')
            )
	    ); 
        ob_start();
        include( 'include/show_form_in_page.php' );
        return ob_get_clean(); 
    }
    
    public static function saveCart(){
        global $wpdb;
        $cart = $_POST['cart'];
        foreach ($cart as $key => &$val){
            if($val['price']=='false' && $val['priceProde']=='false'){
                unset($cart[$key]);
                continue;
            }
            if($val['price']=='false'){
                unset($val['price']);
            }
            if($val['priceProde']=='false'){
                unset($val['priceProde']);
            }
        }
        $cart = json_encode($cart);
        $phone = $_POST['phone'];
        $name = $_POST['name'];
        $table = $wpdb->prefix.'calc_cart';
        $data = [
            'cart' => $cart,
            'name' => $name,
            'phone' => $phone
        ];
        $wpdb->insert($table, $data);
        $my_id = $wpdb->insert_id;
        //sself::sendMail();
        echo $my_id;
        wp_die();
    }
    
    public static function updateAllPrice(){
        global $wpdb;
        $table = $wpdb->prefix.'calc_price';
        $query = '';
        foreach ($_POST['dataArray'] as $key => $value){
            if(!empty($value)){
                $query .= "`$key` = '$value',";
            }
        }
        $sql = "UPDATE `$table` SET ".$query;
        $sql = substr($sql,0,-1);
        $wpdb->query($sql);
        echo 'true';
        wp_die();
    }

    public static function uploadFile(){    
        if(!is_dir(__DIR__.'/uploads')){
            mkdir(__DIR__.'/uploads', 0777);
            chmod(__DIR__.'/uploads', 0777);
        }
        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error:';
        }
        move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.'/uploads/' . 'price.xlsx');
        @chmod(__DIR__.'/uploads/' . 'price.xlsx', 0777);
        echo 'true';
        wp_die();
    }

    public static function readExellFile(){
        global $wpdb;
        if(!file_exists(__DIR__.'/uploads/' . 'price.xlsx')){
            echo 'false';
            wp_die();
        }
        $excel = PHPExcel_IOFactory::load(__DIR__.'/uploads/' . 'price.xlsx');
        foreach($excel ->getWorksheetIterator() as $worksheet) {
            $lists[] = $worksheet->toArray();
        }
        foreach($lists[0] as $price){
            $priceTable = $wpdb->get_results("SELECT `id` FROM `".$wpdb->prefix."calc_code_price` WHERE `code`='".strtoupper($price[0])."'");
            $data = [
                'code' => strtoupper($price[0]),
                'price' => $price[1]
            ];
            if(count($priceTable)==0){
                $wpdb->insert($wpdb->prefix."calc_code_price", $data);
            }else{
                $wpdb->update($wpdb->prefix."calc_code_price", $data, ['code' => strtoupper($price[0])]);
            }
        }
        echo 'true';
        wp_die();
    }

    public static function sendMail(){
      wp_mail( 'shevch19944@gmail.com', 'TEst', 'Test_mes', 'webmaster@example.com' );
    }
}

