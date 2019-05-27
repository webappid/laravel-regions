<?php
/**
 * @author Dyan Galih <dyan.galih@gmail.com>
 * @copyright 2018 WebAppId
 */

namespace WebAppId\Region\Tests;

use Faker\Factory as Faker;
use Illuminate\Container\Container;
use Orchestra\Testbench\TestCase as BaseTestCase;
use WebAppId\Region\Facade;
use WebAppId\Region\ServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected $faker;

    /**
     * @var Container
     */
    private $container;

    /**
     * Set up the test
     */
    public function setUp()
    {

        parent::setUp();
        $this->faker = Faker::create('id_ID');
        $this->loadMigrationsFrom([
            '--realpath' => realpath(__DIR__ . '/../src/migrations'),
        ]);

        $this->artisan('webappid:region:seed');
    }

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Region' => Facade::class,
        ];
    }

    protected function getFaker()
    {
        return Faker::create('id_ID');
    }

    protected function getContainer(): Container
    {
        if ($this->container == null) {
            $this->container = new Container();
        }
        return $this->container;
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}
