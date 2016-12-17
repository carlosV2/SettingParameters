<?php

namespace AppBundle\Controller;

use AppBundle\Table;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // Force a cache clear so next time the container builder is executed again
        exec("rm -rf ../var/cache/");

        Table::row([
            'DefaultController::indexAction()',
            $this->getParameter('parameter'),
            $this->getParameter('prepend'),
            $this->getParameter('load'),
            $this->getParameter('compilerpass')
        ]);

        Table::close();

        echo '<hr/>';

        echo '<h3>Analysis of `parameter`</h3>';
        Table::init(['Evaluated on', 'parameter', 'Comments']);
        Table::row(['Extension::prepend()', 'Set on app/parameters.yml', '<span style="color: green">Expected value at this point</span>']);
        Table::row(['Extension::prepend()', 'Set on Extension::prepend()', '<span style="color: green">Expected value at this point</span>']);
        Table::row(['Extension::prepend()', 'Set on Extension::prepend()', '<span style="color: red">Unexpected value. Expected value was: "Set on AppBundle/.../parameters.yml"</span>']);
        Table::row(['Extension::load()', 'Set on app/parameters.yml', '<span style="color: red">Unexpected value. Expected value was same as last set value: "Set on Extension::prepend()"</span>']);
        Table::row(['Extension::load()', 'Set on Extension::load()', '<span style="color: green">Expected value at this point</span>']);
        Table::row(['Extension::load()', 'Set on AppBundle/.../parameters.yml', '<span style="color: green">Expected value at this point</span>']);
        Table::row(['TestingCompilerPass::process()', 'Set on app/parameters.yml', '<span style="color: red">Unexpected value. Expected value was same as last set value: "Set on AppBundle/.../parameters.yml"</span>']);
        Table::row(['TestingCompilerPass::process()', 'Set on TestingCompilerPass::process()', '<span style="color: green">Expected value at this point</span>']);
        Table::row(['DefaultController::indexAction()', 'Set on TestingCompilerPass::process()', '<span style="color: green">Expected value at this point</span>']);
        Table::close();

        echo '<hr/>';

        echo '<h3>Analysis of `prepend`, `load` and `compilerpass`</h3>';
        Table::init(['Evaluated on', 'prepend', 'load', 'compilerpass', 'Comments']);
        Table::row(['Extension::prepend()', '<span style="font-style: italic">not set</span>', '<span style="font-style: italic">not set</span>', '<span style="font-style: italic">not set</span>', '<span style="color: green">Expected values at this point</span>']);
        Table::row(['Extension::prepend()', 'Set on Extension::prepend()', '<span style="font-style: italic">not set</span>', '<span style="font-style: italic">not set</span>', '<span style="color: green">Expected values at this point</span>']);
        Table::row(['Extension::prepend()', 'Set on Extension::prepend()', '<span style="font-style: italic">not set</span>', '<span style="font-style: italic">not set</span>', '<span style="color: green">Expected values at this point</span>']);
        Table::row(['Extension::load()', 'Set on Extension::prepend()', '<span style="font-style: italic">not set</span>', '<span style="font-style: italic">not set</span>', '<span style="color: green">Expected values at this point</span>']);
        Table::row(['Extension::load()', 'Set on Extension::load()', 'Set on Extension::load()', '<span style="font-style: italic">not set</span>', '<span style="color: green">Expected values at this point</span>']);
        Table::row(['Extension::load()', 'Set on Extension::load()', 'Set on Extension::load()', '<span style="font-style: italic">not set</span>', '<span style="color: green">Expected values at this point</span>']);
        Table::row(['TestingCompilerPass::process()', 'Set on Extension::load()', 'Set on Extension::load()', '<span style="font-style: italic">not set</span>', '<span style="color: green">Expected values at this point</span>']);
        Table::row(['TestingCompilerPass::process()', 'Set on TestingCompilerPass::process()', 'Set on TestingCompilerPass::process()', 'Set on TestingCompilerPass::process()', '<span style="color: green">Expected values at this point</span>']);
        Table::row(['DefaultController::indexAction()', 'Set on TestingCompilerPass::process()', 'Set on TestingCompilerPass::process()', 'Set on TestingCompilerPass::process()', '<span style="color: green">Expected values at this point</span>']);
        Table::close();

        return new Response();
    }
}
