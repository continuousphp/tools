<?php

namespace ToolsTest;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);
date_default_timezone_set("Europe/Brussels");

class Bootstrap
{
    protected static $config;
    protected static $bootstrap;

    public static function init()
    {
        include __DIR__ . '/TestConfiguration.php';

        static::initAutoloader();
    }

    protected static function initAutoloader()
    {
        require_once(__DIR__ . '/../vendor/autoload.php');
    }
}

Bootstrap::init();