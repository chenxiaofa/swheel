<?php
/**
 * Created by PhpStorm.
 * User: xfachen
 * Date: 2017/11/3
 * Time: 14:34
 */

namespace Swheel\Base;

use Swheel\Core\Object;

class Server extends Object
{
    /**
     * @var int server worker number
     */
    public $workerNum = 4;

    /**
     * @var int worker max request
     */
    public $maxRequest = 5000;

    /**
     * @var bool run as daemonize
     */
    public $daemonize = false;


    public $host = '127.0.0.1';

    public $port = 0;

    public $mode = SWOOLE_PROCESS;

    public $sockType = SWOOLE_SOCK_TCP;

}