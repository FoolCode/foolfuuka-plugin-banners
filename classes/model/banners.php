<?php

namespace Foolz\Foolfuuka\Plugins\Banners\Model;

class Banners
{
	static $processed = false;

	public static function display($result)
	{
		if (static::$processed === true)
		{
			return null;
		}

		if (\Cookie::get('theme') === 'yotsubatwo')
		{
			return null;
		}

		$board = $result->getParam('board');

		if ( ! is_object($board) || ! in_array($board->shortname, ['dev', 'foolz', 'kuku']))
		{
			return null;
		}

		$banners = glob(__DIR__.'/../../assets/banners/'.$board->shortname.'/*.*');

		if ($banners !== false && ! empty($banners))
		{
			$plugin = \Plugins::getPlugin('foolz/foolfuuka', 'foolz/foolfuuka-plugin-banners');

			echo '<img src="'.$plugin->getAssetManager()->getAssetLink('banners/'.$board->shortname.'/'.basename($banners[array_rand($banners)])).'" style="float: right; display: block; margin-bottom: 3px; position: relative; bottom: 10px" />';
		}

		static::$processed = true;
	}
}