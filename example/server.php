<?php
/**
 * Created by PhpStorm.
 * User: xfachen
 * Date: 2017/10/31
 * Time: 13:51
 */
define('SWHEEL_DEBUG', 1);

include __DIR__."/../vendor/autoload.php";

$app = new \Swheel\Base\Application([
    'name'=>'test app',
    'basePath'=>__DIR__,
    'components'=>[
        'log'=>[
            'traceLevel'=>3 ,
            'targets'=> [
                [
                    'class'=>'Swheel\Log\FileTarget',
                    'levels'=> \Swheel\Log\Logger::LEVEL_WARNING ,
                    'logFile'=> '@app/runtime/logs/warning.log',
                ],
                [
                    'class'=>'Swheel\Log\FileTarget',
                    'levels'=> \Swheel\Log\Logger::LEVEL_ERROR,
                    'logFile'=> '@app/runtime/logs/error.log',
                ],
                [
                    'class'=>'Swheel\Log\FileTarget',
                    'levels'=> \Swheel\Log\Logger::LEVEL_TRACE ,
                    'logFile'=> '@app/runtime/logs/trace.log',
                ],
                [
                    'class'=>'Swheel\Log\FileTarget',
                    'levels'=> \Swheel\Log\Logger::LEVEL_INFO ,
                    'logFile'=> '@app/runtime/logs/info.log',
                ],
            ]
        ]
    ]
]);

$app->run();