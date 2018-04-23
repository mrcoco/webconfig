#!/usr/bin/env php
<?php
require 'vendor/autoload.php';
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;
use App\ProjectCommand;
use App\MysqlCommand;
use App\PostgresqlCommand;
use App\RestCommand;


$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

define('NGINX_CONF_DIR', getenv("NGINX_CONF_DIR"));
define('ROOT_DIR', getenv("ROOT_DIR"));
define('LOG_DIR', getenv("LOG_DIR"));

$application = new Application("Web Server config Tool","0.1.0");
$application->add(new ProjectCommand());
$application->add(new MysqlCommand());
$application->add(new PostgresqlCommand());
$application->add(new RestCommand());
$application->run();
