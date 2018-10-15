<?php

namespace CeresCoffee\Providers;

use IO\Helper\TemplateContainer;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;

class CeresCoffeeServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register() {

    }
    public function boot (Twig $twig, Dispatcher $eventDispatcher)
    {
        // provide template to use for homepage
        $eventDispatcher->listen('IO.tpl.home', function(TemplateContainer $container, $templateData) {
            $container->setTemplate("CeresCoffee::Homepage.Homepage");
            return false;
        });
        $eventDispatcher->listen('IO.init.templates', function (Partial $partial) {
           $partial->set('page-design', 'CeresCoffee::PageDesign.PageDesign');
       }, self::EVENT_LISTENER_PRIORITY);

    }
}
