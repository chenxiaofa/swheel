<?php
/**
 * Created by PhpStorm.
 * User: xfachen
 * Date: 2017/10/31
 * Time: 13:56
 */

namespace Swheel\Base;

require_once __DIR__.'/../Swheel.php';

use GetOptionKit\ContinuousOptionParser;
use GetOptionKit\OptionCollection;
use Swheel;
use Swheel\Core\Object;

class Application extends Object
{
    /**
     * @var string name of app
     */
    public $id = 'Swheel App';

    /**
     * @var string bast path
     */
    public $basePath = '';

    public $runtimePath = '';

    public $server = null;


    /**
     * @var int server dispatch mode
     */
    public $dispatchMode = 3;


    /**
     * @var array components configuration
     */
    public $components = [];


    public function __construct(array $config = [])
    {
        Swheel::$app = $this;
        parent::__construct($config);
    }

    protected $_components = [];

    public function init()
    {
        Swheel::setAlias('app', realpath($this->basePath));
        foreach($this->coreComponents() as $id=>$component)
        {
            if (!isset($this->components[$id])) {
                $this->components[$id] = $component;
            } elseif (is_array($this->components[$id]) && !isset($this->components[$id]['class'])) {
                $this->components[$id]['class'] = $component['class'];
            }
        }
        $core = $this->coreComponents();
        foreach($core as $id=>$component)
        {
            $this->set($id, Object::createObject($this->components[$id]));
        }
//        foreach ($this->components as $id=>$component)
//        {
//            if (array_key_exists($id, $core)) continue;
//            $this->set($id, Object::createObject($component));
//        }
    }

    /**
     * @inheritdoc
     */
    public function coreComponents()
    {
        return [
            'log'=>['class' => 'Swheel\Log\Dispatcher'],
        ];
    }

    /**
     * set component
     * @param $id
     * @param $object
     */
    public function set($id, $object)
    {
        $this->_components[$id] = $object;
    }

    /**
     * get component
     * @param $id
     * @return mixed|null
     */
    public function get($id)
    {
        if (array_key_exists($id,$this->_components))
        {
            return $this->_components[$id];
        }
        return null;
    }


    public function run()
    {
        global $argv;
        $specs = new \GetOptionKit\OptionCollection();
        $specs->add('d|daemon');

        // ContinuousOptionParser
        $parser = new \GetOptionKit\OptionParser( $specs );

        try{
            $args = $parser->parse($argv);
        }catch (\Exception $e)
        {
            echo "Arguments parse failed\n";
            echo $e->getMessage(),"\n";
            return false;
        }

        $options = $args->toArray();
        $arguments = $args->getArguments();
        if (empty($arguments) || !in_array(($action = $arguments[0]), ['start', 'stop', 'reload']))
        {
            echo "missing action start|stop|reload\n";
            return false;
        }

        return $this->$action($options);


    }


    protected function start($options=[])
    {

    }


    protected function stop($options=[])
    {

    }


    protected function reload($options=[])
    {

    }


    public function getRuntimePath()
    {
        if ($this->runtimePath)
        {
            return Swheel::getAlias($this->runtimePath);
        }
        return $this->basePath.'/runtime';
    }

    /**
     * @return Swheel\Log\Dispatcher
     */
    public function getLog()
    {
        return $this->get('log');
    }

    public function defaultServer()
    {
        return [
            'class' => 'Swheel\Base\Server'
        ];
    }

}