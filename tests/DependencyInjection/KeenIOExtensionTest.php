<?php

namespace KeenIO\Bundle\KeenIOBundle\Tests\DependencyInjection;

use KeenIO\Bundle\KeenIOBundle\DependencyInjection\KeenIOExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class KeenIOExtensionTest extends TestCase
{
    /**
     * @var KeenIOExtension
     */
    private $extension;

    /**
     * Container
     *
     * @var ContainerBuilder
     */
    private $container;

    protected function setUp()
    {
        $this->extension = new KeenIOExtension();
        $this->container = new ContainerBuilder();

        $this->container->registerExtension($this->extension);
    }

    public function testConfiguration()
    {
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__.'/../Fixtures/'));
        $loader->load('config_test.yml');

        $this->container->compile();

        $this->assertTrue($this->container->has('keen_io'));
        $this->assertInstanceOf('KeenIO\Client\KeenIOClient', $this->container->get('keen_io'));
    }
}
