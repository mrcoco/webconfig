<?php
namespace App;
/**
* 
*/
class Configuration
{
	public $files;

	function __construct(Filesystem $file)
	{
		$this->files = $file;
	}

	public function nginxDir($dir)
	{
		if ($this->files->exists($dir)) {
            $this->files->copy('stub/nginx', 'nginx-');
        }
	}
}