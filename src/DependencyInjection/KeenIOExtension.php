<?php

namespace KeenIO\Bundle\KeenIOBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

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

        $definition = new Definition('%keen_io.class%', array($arguments));

        if (method_exists($definition, 'setFactory')) {
            $definition->setFactory(array('%keen_io_factory.class%', 'factory'));
        } else {
            // BC layer for Symfony 2.5 and older
            $definition
                ->setFactoryClass('%keen_io_factory.class%')
                ->setFactoryMethod('factory');
        }

        $container->setDefinition('keen_io', $definition);

        // Support autowiring in Symfony 3.3+
        $container->setAlias('KeenIO\Client\KeenIOClient', new Alias('keen_io', false));
    }
}
