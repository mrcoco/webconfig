<?php
namespace App;
/**
* 
*/
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use App\Postgresql;
use App\Server;

class PostgresqlCommand extends Command
{
	protected function configure()
	{
		$this
        ->setName('postgresql')
        ->setDescription('Postgresql Service Command.')
		->setHelp('This command allows you to strart/stop Postgresql service...')
        ->addArgument('service', InputArgument::REQUIRED, 'The Postgresql service.');
	}
	protected function execute(InputInterface $input, OutputInterface $output)
    {
		$com 	= $input->getArgument('service');
		$server = new Server('postgresql');
    	$pgsql 	= new Postgresql();
    	switch ($com) {
    		case 'start':
    			$output->writeln('Starting Postgresql ...');
    			$output->writeln('Start Postgresql: ...'.$pgsql->up());
     			$output->writeln('Postgresql Status: '.$pgsql->isActive());
    			break;
			case 'restart':
				$output->writeln('Restarting Postgresql ...');
    			$output->writeln('Restart Postgresql: ...'.$pgsql->restart());
     			$output->writeln('Postgresql Status: '.$pgsql->isActive());
				break;
			case 'stop':
				$output->writeln('Stoping Postgresql ...');
    			$output->writeln('Stop Postgresql: ...'.$pgsql->down());
     			$output->writeln('Postgresql Status: '.$pgsql->isActive());
				break;
    		
    		default:
     			$output->writeln('Postgresql Status: '.$pgsql->isActive());
    			break;
    	}
    }
}