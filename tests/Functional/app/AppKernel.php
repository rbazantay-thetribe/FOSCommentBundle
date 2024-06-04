<?php

/*
 * This file is part of the FOSCommentBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FOS\CommentBundle\Tests\Functional;

use Exception;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class AppKernel extends Kernel
{
    use MicroKernelTrait;

    private const CONFIG_EXITS = '.{php,xml,yaml,yml}';
    private ?string $testCase;
    private ?string $rootConfig;

    public function __construct(
        $environment,
        $debug,
        $testCase = 'Basic',
        $rootConfig = 'config.yml"'
    ) {
        $root = str_contains(__DIR__, '/app') ? __DIR__ : __DIR__ . '/app';
        if (!is_dir($root.'/'.$testCase)) {
            throw new \InvalidArgumentException(sprintf('The test case "%s" does not exist.', $testCase));
        }
        $this->testCase = $testCase;
        $this->rootConfig = $root.'/'.$testCase.'/'.$rootConfig;
        parent::__construct($environment, $debug);
    }

    public function registerBundles(): iterable
    {
        if (!is_file($filename = $this->getRootDir().'/'.$this->testCase.'/bundles.php')) {
            throw new \RuntimeException(sprintf('The bundles file "%s" does not exist.', $filename));
        }
        $contents = require $this->getRootDir().'/'.$this->testCase.'/bundles.php';

        foreach ($contents as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                yield new $class();
            }
        }
    }

    private function configureRoutes(RoutingConfigurator $routes): void
    {
        $confDir = $this->getProjectDir() . '/' . $this->testCase;
        $routes->import($confDir . '/{routing}' . self::CONFIG_EXITS);$routes->import($confDir.'/{routes}/'.$this->environment.'/*.{php,yaml}');
    }

    public function getProjectDir(): string
    {
        $path = \dirname(__DIR__);
        return strpos($path, '/app') ? $path : $path . '/app';
    }

    public function getRootDir(): string
    {
        $path = \dirname(__DIR__);
        return strpos($path, '/app') ? $path : $path . '/app';
    }

    public function getCacheDir(): string
    {
        return $this->getProjectDir().'/data/'.Kernel::VERSION.'/'.$this->testCase.'/cache/'.$this->environment;
    }

    public function getLogDir(): string
    {
        return $this->getProjectDir().'/data/'.Kernel::VERSION.'/'.$this->testCase.'/logs';
    }

    /**
     * @throws Exception
     */
    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void    {
        $container->addResource(new FileResource($this->getRootDir().'/'.$this->testCase.'/bundles.php'));
        $container->setParameter('container.dumper.inline_class_loader', $this->debug);
        $container->setParameter('container.dumper.inline_factories', true);
        $loader->load($this->getRootDir().'/'.$this->testCase. '/config' . self::CONFIG_EXITS, 'glob');
        $loader->load($this->getRootDir().'/config/'. self::CONFIG_EXITS, 'glob');
    }

    public function serialize(): string
    {
        return serialize([$this->testCase, $this->rootConfig, $this->getEnvironment(), $this->isDebug()]);
    }

    public function unserialize($str): void
    {
        call_user_func_array([$this, '__construct'], unserialize($str));
    }

    protected function getKernelParameters(): array
    {
        $parameters = parent::getKernelParameters();
        $parameters['kernel.test_case'] = $this->testCase;

        return $parameters;
    }
}
