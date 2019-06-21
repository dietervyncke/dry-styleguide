<?php

namespace Tnt\Styleguide\Provider;

use dry\http\Response;
use dry\route\Router;
use Oak\ServiceProvider;
use Oak\Contracts\Container\ContainerInterface;
use Tnt\Styleguide\Template;

/**
 * Class StyleguideServiceProvider
 * @package Tnt\Styleguide\Provider
 */
class StyleguideServiceProvider extends ServiceProvider
{
	/**
	 * @param ContainerInterface $app
	 * @return mixed|void
	 */
	public function register(ContainerInterface $app)
	{
		$app->set(Template::class, Template::class);
	}

	/**
	 * @param ContainerInterface $app
	 * @return mixed|void
	 */
	public function boot(ContainerInterface $app)
	{
		Router::register( Response::$language, null, [
			'styleguide/' => '\\Tnt\\Styleguide\\Controller\\StyleguideController::index',
			'styleguide/(?<type>(a|m|o))/(?<component>.*)--(?<modifier>.*)/' => '\\Tnt\\Styleguide\\Controller\\StyleguideController::viewComponentModifier',
			'styleguide/(?<type>(a|m|o))/(?<component>.*)/' => '\\Tnt\\Styleguide\\Controller\\StyleguideController::viewComponent',
			'styleguide/(?<type>(a|m|o))/' => '\\Tnt\\Styleguide\\Controller\\StyleguideController::viewType',
		]);
	}
}