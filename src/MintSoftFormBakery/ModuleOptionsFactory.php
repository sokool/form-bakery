<?php
/**
 * Created by PhpStorm.
 * User: sokool
 * Date: 01/05/14
 * Time: 17:44
 */

namespace MintSoftFormBakery;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Configuration');

        return new ModuleOptions(isset($config['form_bakery']) ? $config['form_bakery'] : []);
    }
}