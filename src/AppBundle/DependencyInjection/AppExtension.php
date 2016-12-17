<?php

namespace AppBundle\DependencyInjection;

use AppBundle\Table;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

class AppExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        Table::row([
            'Extension::load()',
            $container->hasParameter('parameter') ? $container->getParameter('parameter') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('prepend') ? $container->getParameter('prepend') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('load') ? $container->getParameter('load') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('compilerpass') ? $container->getParameter('compilerpass') : '<span style="font-style: italic">not set</span>',
        ]);

        $container->setParameter('parameter', 'Set on Extension::load()');
        $container->setParameter('prepend', 'Set on Extension::load()');
        $container->setParameter('load', 'Set on Extension::load()');

        Table::row([
            'Extension::load()',
            $container->hasParameter('parameter') ? $container->getParameter('parameter') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('prepend') ? $container->getParameter('prepend') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('load') ? $container->getParameter('load') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('compilerpass') ? $container->getParameter('compilerpass') : '<span style="font-style: italic">not set</span>',
        ]);

        (new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config')))->load('parameters.yml');

        Table::row([
            'Extension::load()',
            $container->hasParameter('parameter') ? $container->getParameter('parameter') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('prepend') ? $container->getParameter('prepend') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('load') ? $container->getParameter('load') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('compilerpass') ? $container->getParameter('compilerpass') : '<span style="font-style: italic">not set</span>',
        ]);
    }

    public function prepend(ContainerBuilder $container)
    {
        Table::init([
            'Evaluated on',
            'parameter',
            'prepend',
            'load',
            'compilerpass'
        ]);

        Table::row([
            'Extension::prepend()',
            $container->hasParameter('parameter') ? $container->getParameter('parameter') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('prepend') ? $container->getParameter('prepend') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('load') ? $container->getParameter('load') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('compilerpass') ? $container->getParameter('compilerpass') : '<span style="font-style: italic">not set</span>',
        ]);

        $container->setParameter('parameter', 'Set on Extension::prepend()');
        $container->setParameter('prepend', 'Set on Extension::prepend()');

        Table::row([
            'Extension::prepend()',
            $container->hasParameter('parameter') ? $container->getParameter('parameter') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('prepend') ? $container->getParameter('prepend') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('load') ? $container->getParameter('load') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('compilerpass') ? $container->getParameter('compilerpass') : '<span style="font-style: italic">not set</span>',
        ]);

        $config = Yaml::parse(file_get_contents(__DIR__ . '/../Resources/config/parameters.yml'));
        $container->prependExtensionConfig('parameters', $config['parameters']);

        Table::row([
            'Extension::prepend()',
            $container->hasParameter('parameter') ? $container->getParameter('parameter') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('prepend') ? $container->getParameter('prepend') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('load') ? $container->getParameter('load') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('compilerpass') ? $container->getParameter('compilerpass') : '<span style="font-style: italic">not set</span>',
        ]);
    }
}
