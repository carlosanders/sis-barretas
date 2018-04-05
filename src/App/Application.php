<?php
namespace App;

use App\Loader\ServiceLoader;
use Slim\App;
use Symfony\Component\Finder\Finder;

/**
 * {@inheritDoc}
 */
class Application extends App
{
    private $dir = null;

    public function __construct($container = [])
    {
        parent::__construct($container);
        $this->loadServices();
    }

    private function loadServices()
    {
        $serviceLoader = new ServiceLoader(new Finder);
        $serviceLoader->loadServices(
            $this,
            $this->getContainer()->get("settings")["service_directories"]
        );
    }

    /**
     * Get root directory.
     * @return string
     * @throws ConstantNotSetException
     */
    public function getRootDir()
    {
        if (!defined('APP_ROOT')) {
            throw new ConstantNotSetException('Application root not defined.');
        }

        return APP_ROOT;
    }
}
