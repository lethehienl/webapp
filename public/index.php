<?php
use App\Kernel;
/*define('DOMAIN', $_SERVER['REQUEST_SCHEME'] . '://' .  $_SERVER['HTTP_HOST']);*/
require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
