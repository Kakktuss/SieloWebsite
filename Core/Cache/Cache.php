<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24/06/2018
 * Time: 18:26
 */

namespace Core\Cache;

use Core\Config\Config;

class Cache
{

	private $cachePath;

	public function __construct($type)
	{

		$this->cachePath = 'Application/'.$type.'/Cache/';

	}

	public function add($fileName, $content)
	{
		file_put_contents($this->cachePath.$fileName.'.html', $content);
	}

	public function delete($fileName)
	{
		unlink($this->cachePath.$fileName.'.html');
	}

	public function isExpired($fileName)
	{
		$expireTime = time() - Config::getInstance()->getCacheExpirationTime();
		if (file_exists($this->cachePath.$fileName.'.html')  && filemtime($this->cachePath.$fileName.'.html') > $expireTime)
		{
			return false;
		} else {
			return true;
		}
	}

	public function get($fileName)
	{
		echo readfile($this->cachePath.$fileName.'.html');
	}

}