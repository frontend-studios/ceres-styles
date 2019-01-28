<?php

namespace CeresGlamour\Providers;

use Ceres\Caching\NavigationCacheSettings;
use Ceres\Caching\SideNavigationCacheSettings;
use IO\Services\ContentCaching\Services\Container;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\Templates\Twig;
use IO\Helper\TemplateContainer;
use IO\Extensions\Functions\Partial;
use IO\Services\ItemSearch\Helper\ResultFieldTemplate;
use Plenty\Plugin\ConfigRepository;


/**
 * Class CeresGlamourServiceProvider
 * @package CeresGlamour\Providers
 */
class CeresGlamourServiceProvider extends ServiceProvider
{
    const PRIORITY = 0;

    public function register()
    {

    }

    public function boot(Twig $twig, Dispatcher $dispatcher, ConfigRepository $config)
    {

        $enabledOverrides = explode(", ", $config->get("CeresGlamour.templates.override"));

        // Override partials
        $dispatcher->listen('IO.init.templates', function (Partial $partial) use ($enabledOverrides)
        {

            $partial->set('page-design', 'Ceres::PageDesign.PageDesign');

            if (in_array("page_design", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $partial->set('page-design', 'CeresGlamour::PageDesign.PageDesign');
            }

            return false;
        }, self::PRIORITY);

        // Override homepage
        if (in_array("homepage", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.home', function (TemplateContainer $container)
            {
                $container->setTemplate('CeresGlamour::Homepage.Homepage');
                return false;
            }, self::PRIORITY);
        }
    }
}
