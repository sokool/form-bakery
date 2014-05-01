<?php
/**
 * Created by PhpStorm.
 * User: sokool
 * Date: 01/05/14
 * Time: 11:25
 */

namespace MintSoftFormBakery;

use Zend\Form\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Cache\StorageFactory;

class FormBakeryFactory implements FactoryInterface
{
    protected $serviceLocator;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        /** @var $options \MintSoftFormBakery\ModuleOptions */
        $options = $serviceLocator->get('MintSoftFormBakery\ModuleOptions');

        $annotationBuilder = $this->instanceFromString($options->getAnnotationBuilder());
        $cacheAdapter      = StorageFactory::factory($options->getCache());

        $formFactory = new Factory();
        $formFactory->setFormElementManager($serviceLocator->get('FormElementManager'));
        $formFactory->getInputFilterFactory()->setInputFilterManager($serviceLocator->get('InputFilterManager'));

        $annotationBuilder->setFormFactory($formFactory);

        $formBakery = new FormBakery($annotationBuilder);
        $formBakery->setCacheAdapter($cacheAdapter);

        return $formBakery;
    }

    public function instanceFromString($className)
    {
        if (is_string($className)) {
            if ($this->serviceLocator->has($className)) {
                return $this->serviceLocator->get($className);
            } else {
                return new $className();
            }
        }
    }
}