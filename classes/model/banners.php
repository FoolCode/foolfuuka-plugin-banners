<?php

namespace Foolz\Foolfuuka\Plugins\Banners\Model;

class Banners
{
    static $processed = false;

    public static function display($result)
    {
        if (static::$processed === true || !is_object(($board = $result->getParam('board', null)))) {
            return null;
        }

        $banners = glob(__DIR__.'/../../assets/banners/'.$board->shortname.'/*.*');
        if ($banners !== false && !empty($banners)) {
            $plugin = $result->getObject()->getContext()->getService('plugins')->getPlugin('foolz/foolfuuka-plugin-banners');

            echo '<img src="'.$plugin->getAssetManager()->getAssetLink('banners/'.$board->shortname.'/'.basename($banners[array_rand($banners)])).'" style="float: right; display: block; margin-bottom: 3px; position: relative; bottom: 10px">';
        }

        static::$processed = true;
    }
}
