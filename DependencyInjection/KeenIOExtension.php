<?php

namespace KeenIO\Bundle\KeenIOBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use KeenIO\Bundle\KeenIOBundle\DependencyInjection\Configuration;

class KeenIOExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $arguments = array();
        foreach ($config as $key => $value) {
            $key = preg_replace_callback('/_([a-z])/', function ($str) { return strtoupper($str[1]); }, $key);
            $arguments[ $key ] = $value;
        }

        $container->setParameter('keen_io.class', 'KeenIO\\Client\\KeenIOClient');
        $container->setParameter('keen_io_factory.class', 'KeenIO\\Client\\KeenIOClient');

        $container->setDefinition('keen_io', new Definition('%keen_io.class%', array($arguments)))
            ->setFactoryClass('%keen_io_factory.class%')
            ->setFactoryMethod('factory');
    }
}
