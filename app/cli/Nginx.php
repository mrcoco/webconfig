<?php
namespace App;
use App\Server;
/**
* 
*/
class Nginx
{
	private $server;

	function __construct()
	{
		$this->server = new Server('nginx');
	}

	public function isActive()
	{
		return $this->server->isActive();
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