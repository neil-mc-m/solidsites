<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 27/10/2017
 * Time: 22:40
 */

namespace Solidsites;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConfigServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['config.file'] = '';
        $app['config'] = function() use ($app){
            $config = new IniConfig($app['config.file']);
            return $config->parse();
        };
    }
}