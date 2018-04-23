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

use App\FileSystem;
use App\Server;
use App\Nginx;


class ProjectCommand extends Command
{
	
	protected function configure()
    {
        $this
        ->setName('create')
        ->setDescription('Creates a new project.')
		->setHelp('This command allows you to create a Project...')
        ->addArgument('project-name', InputArgument::REQUIRED, 'The Project Name.')
        ->addArgument('git-repository', InputArgument::OPTIONAL, 'Clone Your Git Repository?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
     	
     	$project = $input->getArgument('project-name');
     	$git 	= $input->getArgument('git-repository');
     	$files = new FileSystem();
     	$nginxDir 	= NGINX_CONF_DIR;
     	$rootDir 	= ROOT_DIR.$project;
     	$source 	= 'stub/nginx';
     	$filedestination = $nginxDir.'/'.$project;
     	if($files->isDir($nginxDir)){
     		$files->copy($source, $filedestination);
     		$output->writeln('Copying Nginx config: ...');
     	}
     	$nginxConf = [
     		'{domain}' 		=> $project.".test",
     		'{root_dir}'	=> $rootDir,
     		'{log-access}'	=> LOG_DIR.$project,
     		'{log-error}'	=> LOG_DIR.$project
     	];

     	$current = $files->get($filedestination);
        $current = $files->str_replace_assoc($nginxConf, $current);
        $files->put($filedestination, $current);
        $output->writeln('Write Nginx configuration: ...');

        if($git){
        	$gitProcess = new Process('git clone '.$git.' '.$rootDir);
        	$output->writeln('Cloning Git Repository: ...');
        	$gitProcess->run();
        	$output->writeln($gitProcess->getOutput());
        }
		$server = new Server('nginx');
     	$nginx = new Nginx($server);
     	if($nginx->isActive() == 'active')
     	{
     		$output->writeln('Restart Nginx: ...'.$nginx->restart());
     		$output->writeln('Nginx Status: '.$nginx->isActive());
     	}else{
     		$output->writeln('Start Nginx: ...'.$nginx->up());
     		$output->writeln('Nginx Status: '.$nginx->isActive());
     	}
    }

}