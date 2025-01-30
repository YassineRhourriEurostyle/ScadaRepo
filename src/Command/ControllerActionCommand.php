<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ControllerActionCommand extends Command {

    protected static $defaultName = 'controller:action';

    protected function configure() {
        $this
                ->setDescription('Adds an action to a given controller')
                ->addArgument('controller', InputArgument::REQUIRED, sprintf('The class name of the controller to create action'))
                ->addArgument('action', InputArgument::REQUIRED, sprintf('The action name'));
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $io = new SymfonyStyle($input, $output);
        $controller = $input->getArgument('controller');
        $c=strtolower(substr($controller, 0, strlen($controller)-10));
        $action = $input->getArgument('action');
        $a=strToLower($action);

        $io->note(sprintf('You passed an argument: %s', $controller));

        /*
         * Search controller
         */
        $file = trim(file_get_contents(__DIR__ . '/../Controller/' . $controller . '.php'));
        $file = substr($file, 0, strlen($file) - 1);
        $file .= "
    /**
     * @Route(\"/$action\", name=\"".$c."_$a\")
     */
    public function $action() {
        
        UserLog::isAllowed(\$this->session, UserLog::DEV_ADMIN);
            
        \$em = \$this->getDoctrine()->getManager();

        return \$this->render('$c/$action.html.twig', array(
                    
        ));
    }
";

        file_put_contents(__DIR__ . '/../Controller/' . $controller . '.php', $file.'}');
        file_put_contents(__DIR__ . '/../../templates/'.$c.'/'.$action.'.html.twig',"
{% extends 'column.html.twig' %}

{% block title %}$controller $action{% endblock %}


{% block submenu %}
    {% include '$c/_submenu.html.twig' %}
{% endblock %}
{% block body %}

<h1>$controller $action</h1>

{%  endblock %}            
            ");
        
        $io->success("New action <$action> added to <$controller>.");

        return 0;
    }

}
