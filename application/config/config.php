<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

define('URL',                       'http://localhost:8888/jobportal/');

define('DB_TYPE',                   'mysql');
define('DB_HOST',                   'localhost:8889');
define('DB_NAME',                   'jobportal');
define('DB_USER',                   'root');
define('DB_PASS',                   'root');


define('LIBS_PATH',                 'application/libs/');
define('MODELS_PATH',               'application/models/');
define('LOGIN_CONTROLLER_PATH',    'application/controllers/login/');
define('REGISTER_CONTROLLER_PATH', 'application/controllers/register/');
define('EMPLOYEE_CONTROLLER_PATH', 'application/controllers/employee/');
define('EMPLOYER_CONTROLLER_PATH', 'application/controllers/employer/');
define('LOGIN_VIEWS_PATH',          'application/views/login/');
define('EMPLOYEE_VIEWS_PATH',       'application/views/employee/');
define('EMPLOYER_VIEWS_PATH',       'application/views/employer/');
define('TEMPLATE_VIEWS_PATH',       'application/views/_templates/');

// 1209600 seconds = 2 weeks
define('COOKIE_RUNTIME',            1209600);
define('COOKIE_DOMAIN',             '.localhost');

