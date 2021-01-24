<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'tls' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'TQcy1YpiMkmIL%5aJlL&Cg=CP0Lrv8K/,(0hKe@68K+-q693?.>s[t>|;i>Y;@k!' );
define( 'SECURE_AUTH_KEY',  '<ut8y$uwIHj*hFb)}kfN;q-m$-1juIcI8vj%$gxyor8.}pp]#5L]/OEndPA(Uzw@' );
define( 'LOGGED_IN_KEY',    'g.r&fZ0w4G!dL?nO*tTp]X<4o$~@H30M]T2imQ,G@#i@q:Fxl.^@lcM+l]7Jw)M.' );
define( 'NONCE_KEY',        '?r#pOppV7Ol1wJ? &G2$H_}ItVe TQOm~7gX%PtesMms#5-5Br&ng:1;|JTrJ9~b' );
define( 'AUTH_SALT',        '(]1~I#AZoCDTCi|k9}n]F Y{n$y8bWVOHb-9Npeg@,Z{@mDP`L)0ZTuGp+}NXXOD' );
define( 'SECURE_AUTH_SALT', '2VYNb}-PGCEW*_x?CL9Zk3[=eDgxVkJlwH^T#WhR8IDD<1l;,m6MG&O`g_pFepGe' );
define( 'LOGGED_IN_SALT',   '8qe4t[RE.4vi.7d%#bPJTdrCf-X1/s S5K8|t?~|#<lJ`%UF#ODTlZ192TEl{1DK' );
define( 'NONCE_SALT',       'K(aE&.<_c9@%hzKgvg}9Jw*&qBE+Kc,HHN$39ALaD,GZ.Uh(uHW&H}$MJHdD)7Su' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

define('PREFIX', 'wp_');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
