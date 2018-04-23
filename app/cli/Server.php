<?php
namespace App;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

/**
* 
*/
class Server 
{
	private $service;

	function __construct($service)
	{
		$this->service = $service;
	}
	
	public function isActive()
	{
		$process = new Process('systemctl is-active '.$this->service);
		$process->run();
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
		return $process->getOutput();
	}

	public function down()
	{
		$process = new Process('sudo systemctl stop '.$this->service);
		$process->run();
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
		return $process->getOutput();
	}

	public function restart()
	{
		$process = new Process('sudo systemctl restart '.$this->service);
		$process->run();
        if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
        return $process->getOutput();
	}

	public function up()
	{
		$process = new Process('sudo systemctl start '.$this->service);
		$process->run();
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
		return $process->getOutput();
	}
}