<?php
namespace App;

use App\Server;
/**
* 
*/
class Mysql
{
	
	private $server;

	function __construct()
	{
		$this->server = new Server('mysqld');
	}

	public function isActive()
	{
		return $this->server->isActive();
	}

	public function restart()
	{
		return $this->server->restart();
	}

	public function up()
	{
		return $this->server->up();
	}

	public function down()
	{
		return $this->server->down();
	}
}