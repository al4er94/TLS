<?php

/*
Plugin Name: Калькулятор сервиса
Description: Краткое описание плагина.
Version: Номер версии плагина, например: 1.0.0
Author: Имя автора плагина
*/
define('SERVICE_CALC', plugin_dir_path(__FILE__));
new ServicsCalc();
class ServicsCalc{
    
    public $DB;


    public function __construct() {
        add_filter('the_title', array(__CLASS__, 'changeTitle'));
        add_action('admin_menu', array(__CLASS__, 'anblog_bloknot_menu') );
        
        //
        add_action( 'wp_ajax_addManufacturer', array(__CLASS__, 'addManufacturer') );
        
        self::updateBD();
    }
    
    public function changeTitle($title){
        return $title;
    }
    public static function anblog_bloknot_menu() {        
        wp_enqueue_script( 'calcscript', plugin_dir_url(__FILE__).'include/js/script.js');
        wp_enqueue_script('calcscript');
        add_menu_page('Калькулятор сервиса', 'Калькулятор сервиса', 'manage_options', 'servics-calculater/include/service-calculater-page.php', '', 'dashicons-calculator' );
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
}

