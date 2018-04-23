<?php
namespace App;
/**
* 
*/
class Nginx
{
	private $server;

	function __construct(Server $server)
	{
		$this->server = $server;
	}

	public function isActive()
	{
		return $this->server->isActive();
	}

	/**
	 * start Nginx Service
	 *
	 * @return void
	 */
	public function up()
	{
		return $this->server->up();
	}

	/**
	 * Stop Nginx Service
	 *
	 * @return void
	 */
	public function down()
	{
		return $this->server->down();
	}
}