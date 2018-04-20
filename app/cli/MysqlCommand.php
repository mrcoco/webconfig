<?php
namespace App;
/**
* 
*/
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use App\Mysql;

class MysqlCommand extends Command
{
	
	protected function configure()
	{
		$this
        ->setName('mysql')
        ->setDescription('Mysql Service Command.')
		->setHelp('This command allows you to strart/stop mysql service...')
        ->addArgument('service', InputArgument::REQUIRED, 'The mysql service.');
	}
	protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$com 	= $input->getArgument('service');
    	$mysql 	= new Mysql();
    	switch ($com) {
    		case 'start':
    			$output->writeln('Starting Mysql ...');
    			$output->writeln('Start Mysql: ...'.$mysql->up());
     			$output->writeln('Mysql Status: '.$mysql->isActive());
    			break;
			case 'restart':
				$output->writeln('Restarting Mysql ...');
    			$output->writeln('Restart Mysql: ...'.$mysql->restart());
     			$output->writeln('Mysql Status: '.$mysql->isActive());
				break;
			case 'stop':
				$output->writeln('Stoping Mysql ...');
    			$output->writeln('Stop Mysql: ...'.$mysql->down());
     			$output->writeln('Mysql Status: '.$mysql->isActive());
				break;
    		
    		default:
     			$output->writeln('Mysql Status: '.$mysql->isActive());
    			break;
    	}
    }
}