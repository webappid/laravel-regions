<?php

namespace WebAppId\Region\Tests\Feature\Services;

use WebAppId\Region\Services\RegionService;
use WebAppId\Region\Tests\TestCase;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 2019-05-28
 * Time: 01:13
 * Class RegionServiceTest
 * @package Tests\Feature\Services
 */
class RegionServiceTest extends TestCase
{

    private const SEARCH = 'aiueo';

    /**
     * @var RegionService
     */
    private $regionService;


    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->regionService = $this->getContainer()->make(RegionService::class);
        parent::__construct($name, $data, $dataName);
    }

    private function getRandomString()
    {
        return $this->getFaker()->numberBetween(0, strlen(self::SEARCH) - 1);
    }

    public function testGetDistrictLike()
    {
        $results = $this->getContainer()->call([$this->regionService, 'getDistrictLike'], ['q' => self::SEARCH[$this->getRandomString()]]);
        $this->assertTrue($results->isStatus());
    }

    public function testGetCityLike()
    {
        $results = $this->getContainer()->call([$this->regionService, 'getCityLike'], ['q' => self::SEARCH[$this->getRandomString()]]);
        $this->assertTrue($results->isStatus());
    }

    public function testGetProvinceLike()
    {
        $results = $this->getContainer()->call([$this->regionService, 'getProvinceLike'], ['q' => self::SEARCH[$this->getRandomString()]]);
        $this->assertTrue($results->isStatus());
    }
}
