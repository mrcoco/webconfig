<?php
namespace App;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

/**
* 
*/
class Server 
{
	private $server;

	function __construct($server)
	{
		$this->server = $server;
	}
	
	public function isActive()
	{
		$process = new Process('systemctl is-active '.$this->server);
		$process->run();
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
		return $process->getOutput();
	}

	public function down()
	{
		$process = new Process('sudo systemctl stop '.$this->server);
		$process->run();
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
		return $process->getOutput();
	}

	public function restart()
	{
		$process = new Process('sudo systemctl restart '.$this->server);
		$process->run();
        if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
        return $process->getOutput();
	}

	public function up()
	{
		$process = new Process('sudo systemctl start '.$this->server);
		$process->run();
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
		return $process->getOutput();
	}
}