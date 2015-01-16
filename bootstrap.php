<?php

use Foolz\Plugin\Event;

class HHVM_Banners
{
    public function run()
    {
        Event::forge('Foolz\Plugin\Plugin::execute#foolz/foolfuuka-plugin-banners')
            ->setCall(function ($result) {
                /* @var Context $context */
                $context = $result->getParam('context');
                /** @var Autoloader $autoloader */
                $autoloader = $context->getService('autoloader');
                $autoloader->addClassMap([
                    'Foolz\Foolfuuka\Plugins\Banners\Model\Banners' => __DIR__.'/classes/model/banners.php'
                ]);

                Event::forge(['foolfuuka.themes.default_after_op_open', 'foolfuuka.themes.default_after_headless_open'])
                    ->setCall('Foolz\Foolfuuka\Plugins\Banners\Model\Banners::display')
                    ->setPriority(5);
            });
    }
}

(new HHVM_Banners())->run();
