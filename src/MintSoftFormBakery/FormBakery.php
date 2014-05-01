<?php
/**
 * Created by PhpStorm.
 * User: sokool
 * Date: 01/05/14
 * Time: 11:46
 */

namespace MintSoftFormBakery;

use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Cache\Storage\Adapter\Memory as MemoryCache;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Stdlib\ArrayUtils;

class FormBakery
{
    protected $annotationBuilder;
    protected $cacheAdapter;

    public function __construct(AnnotationBuilder $annotationBuilder)
    {
        $this->annotationBuilder = $annotationBuilder;
    }

    public function setAnnotationBuilder(AnnotationBuilder $annotationBuilder)
    {
        $this->annotationBuilder = $annotationBuilder;
    }

    public function getAnnotationBuilder()
    {
        return $this->annotationBuilder;
    }

    public function setCacheAdapter(AbstractAdapter $cacheAdapter)
    {
        $this->cacheAdapter = $cacheAdapter;

        return $this;
    }

    /**
     * @return \Zend\Cache\Storage\Adapter\AbstractAdapter
     */
    public function getCacheAdapter()
    {
        if (!$this->cacheAdapter) {
            $this->cacheAdapter = new MemoryCache();
        }

        return $this->cacheAdapter;
    }

    public function test($entity)
    {
        $entityNameHash    = is_object($entity) ? get_class($entity) : $entity;
        $entityNameHash    = strtolower(str_replace('\\', '-', $entityNameHash));
        $formFactory       = $this->getAnnotationBuilder()->getFormFactory();
        $cacheAdapter      = $this->getCacheAdapter();
        $formSpecification = $cacheAdapter->getItem($entityNameHash);

        if (!empty($formSpecification)) {
            $formSpecification = unserialize($formSpecification);
        } else {
            $formSpecification = ArrayUtils::iteratorToArray($this->getAnnotationBuilder()->getFormSpecification($entity));
            $cacheAdapter->setItem($entityNameHash, serialize($formSpecification));
        }

        return $formFactory->createForm($formSpecification);
    }
}