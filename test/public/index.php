<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';


/*Dastabase datas*/

define("DB_DSN", 'localhost');
define("DB_USERNAME", 'root');
define("DB_PASSWORD", '');
define("DB_NAME", 'test_project');

//mysql:host=DB_HOST;dbname=DB_NAME

//$params = array(
//    'host'           => '127.0.0.1',
//    'username'       => 'webuser',
//    'password'       => 'xxxxxxxx',
//    'dbname'         => 'test',
//
//);




/*end of Database datas */





// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
