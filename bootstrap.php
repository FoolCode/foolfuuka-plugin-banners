<?php

\Foolz\Plugin\Event::forge('Foolz\Plugin\Plugin::execute.foolz/foolfuuka-plugin-banners')
	->setCall(function($result) {
		\Autoloader::add_classes([
			'Foolz\Foolfuuka\Plugins\Banners\Model\Banners' => __DIR__.'/classes/model/banners.php'
		]);

		\Foolz\Plugin\Event::forge(['foolfuuka.themes.default_after_op_open', 'foolfuuka.themes.default_after_headless_open'])
			->setCall('Foolz\Foolfuuka\Plugins\Banners\Model\Banners::display')
			->setPriority(5);
	});