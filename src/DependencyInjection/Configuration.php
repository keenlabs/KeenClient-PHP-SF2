<?php
namespace KeenIO\Bundle\KeenIOBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('keen_io');

        $rootNode
            ->children()
                ->scalarNode('version')
                    ->beforeNormalization()
                        // force the version to be a string, even if the Yaml config files parsed it as float
                        ->ifTrue(function ($v) { return !is_string($v) && is_numeric($v); })
                        ->then(function ($v) { return number_format($v, 1); })
                    ->end()
                    ->defaultValue('3.0')
                    ->info('The Keen IO API Version')
                    ->example('3.0')
                ->end()
                ->scalarNode('project_id')
                    ->defaultValue(null)
                    ->info('The Keen IO Project Id')
                    ->example('52x4329473x4bx16x300000x')
                ->end()
                ->scalarNode('master_key')
                    ->defaultValue(null)
                    ->info('The Master API Key for the specified Project Id')
                    ->example('BAX7BX5X92EX223X8F26A2EX3690AX65')
                ->end()
            ->scalarNode('write_key')
                ->defaultValue(null)
                ->info('The Write API Key for the specified Project Id')
                ->example('...really long hash.')
            ->end()
            ->scalarNode('read_key')
                ->defaultValue(null)
                ->info('The Read API Key for the specified Project Id')
                ->example('...really long hash.')
            ->end()
            ->end();

        return $treeBuilder;
    }
}
