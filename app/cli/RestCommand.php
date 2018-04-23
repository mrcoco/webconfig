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

class RestCommand extends Command
{
	
	protected function configure()
	{
		$this
        ->setName('rest')
        ->setDescription('Restful API Client.')
		->setHelp('This command allows you Testing Restful API..')
		->addArgument('url', InputArgument::REQUIRED, 'The URL API Request.')
		->addArgument('method', InputArgument::REQUIRED, 'The Methode API Request.')
		->addArgument('parrams', InputArgument::OPTIONAL, 'The array Parrams API Request.')
		->addArgument('headers', InputArgument::OPTIONAL, 'The array Header API Request.');
		/**
		->addArgument(
			'headers',
			InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
			'Request Parrameter (separate multiple parramse with a space)?'
		);
		**/
	}
	protected function execute(InputInterface $input, OutputInterface $output)
    {
		$url		= $input->getArgument('url');
		$method     = $input->getArgument('method');
		$parrams 	= $input->getArgument('parrams');

		$client 	= \SimpleRestClient::get($url, $parrams);
		//print_r($parrams);
		$output->writeln(json_encode($client));
    }
}