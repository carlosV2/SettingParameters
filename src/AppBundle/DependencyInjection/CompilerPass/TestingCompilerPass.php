<?php

namespace AppBundle\DependencyInjection\CompilerPass;

use AppBundle\Table;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TestingCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        Table::row([
            'TestingCompilerPass::process()',
            $container->hasParameter('parameter') ? $container->getParameter('parameter') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('prepend') ? $container->getParameter('prepend') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('load') ? $container->getParameter('load') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('compilerpass') ? $container->getParameter('compilerpass') : '<span style="font-style: italic">not set</span>',
        ]);

        $container->setParameter('parameter', 'Set on TestingCompilerPass::process()');
        $container->setParameter('prepend', 'Set on TestingCompilerPass::process()');
        $container->setParameter('load', 'Set on TestingCompilerPass::process()');
        $container->setParameter('compilerpass', 'Set on TestingCompilerPass::process()');

        Table::row([
            'TestingCompilerPass::process()',
            $container->hasParameter('parameter') ? $container->getParameter('parameter') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('prepend') ? $container->getParameter('prepend') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('load') ? $container->getParameter('load') : '<span style="font-style: italic">not set</span>',
            $container->hasParameter('compilerpass') ? $container->getParameter('compilerpass') : '<span style="font-style: italic">not set</span>',
        ]);
    }
}
