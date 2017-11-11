<?php

namespace Carnage\ZendLayoutPerModule;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\Controller\AbstractActionController;

class Module
{
    public function init(ModuleManager $mm)
    {
        $mm->getEventManager()->getSharedManager()->attach(AbstractActionController::class,
            'dispatch', function (EventInterface $e) {
                $controller = $e->getTarget();
                $namespace = strtolower(explode('\\', get_class($controller))[1]);
                $controller->layout($namespace . '/layout');
            });
    }
}