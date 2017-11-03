<?php

/**
 * Created by PhpStorm.
 * User: xfachen
 * Date: 2017/10/31
 * Time: 13:54
 */

namespace Swheel\Core;

use Exception;

class Object
{
    public function __construct(array $config = [])
    {
        self::configure($this, $config);
        $this->init();
    }

    public function init()
    {

    }

    /**
     * @param $object
     * @param $properties
     * @return mixed
     */
    public static function configure($object, $properties)
    {
        foreach ($properties as $name => $value) {
            if (property_exists($object, $name))
            {
                $object->$name = $value;
            }
        }
        return $object;
    }

    public static  function createObject($config)
    {
        if (is_string($config))
        {
            $config = ['class'=>$config];
        }

        if (!array_key_exists('class',$config))
        {
            throw new Exception('miss class type');
        }

        $className = $config['class'];

        if (!class_exists($className))
        {
            throw new Exception('class not found:'.$className);
        }
        unset($config['class']);
        return new $className($config);
    }

}