<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks {
    /**
     * Installs the serverless framework
     */
    function init() {
        $isSuccessful = $this->taskExec('npm')
                ->arg('update')
                ->run()->wasSuccessful();
        
        if ($isSuccessful == false) {
            return $this->say('Failed.');
        }
    }

    /**
     * Deploys the app to serverless
     */
    function deploy() {
        $isSuccessful = $this->taskExec('composer')
                ->arg('update')
                ->option('prefer-dist')
                ->option('optimize-autoloader')
                ->run()->wasSuccessful();
        
        if ($isSuccessful == false) {
            return $this->say('Failed.');
        }

        $isSuccessful = $this->taskExec('phpunit')
                ->dir('vendor/bin')
                ->option('configuration', '../../phpunit.xml')
                ->run()
                ->wasSuccessful();
                
        if ($isSuccessful == false) {
            return $this->say('Failed');
        }

        $this->taskExec('sls')
                ->arg('deploy')
                ->option('function', 'YOURFUNCTIONNAME')
                ->run();
    }
    
    /**
     * Retrieves the logs from serverless
     */
    function logs() {

        $this->taskExec('sls')
                ->arg('logs')
                ->option('function', 'YOURFUNCTIONNAME')
                ->run();
    }

}