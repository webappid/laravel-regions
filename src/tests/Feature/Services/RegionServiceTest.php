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

    private const SEARCH = 'aiu';

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

    public function testDistrictLikeWithCityId()
    {
        $cities = [219, 327];
        $city = $cities[$this->getFaker()->numberBetween(0, count($cities) - 1)];
        $results = $this->getContainer()->call([$this->regionService, 'getDistrictLikeWithCityId'], ['q' => self::SEARCH[$this->getRandomString()], 'cityId' => $city]);
        $this->assertTrue($results->isStatus());
    }

    public function testCityLikeWithProvinceId()
    {
        $provinceList = [11, 15];
        $province = $provinceList[$this->getFaker()->numberBetween(0, count($provinceList) - 1)];
        $results = $this->getContainer()->call([$this->regionService, 'getCityLikeWithProvinceId'], ['q' => self::SEARCH[$this->getRandomString()], 'provinceId' => $province]);
        $this->assertTrue($results->isStatus());
    }

    public function testDistrictLikeWithProvinceId()
    {
        $provinceList = [11, 15];
        $province = $provinceList[$this->getFaker()->numberBetween(0, count($provinceList) - 1)];
        $results = $this->getContainer()->call([$this->regionService, 'getDistrictLikeWithProvinceId'], ['q' => self::SEARCH[$this->getRandomString()], 'provinceId' => $province]);
        $this->assertTrue($results->isStatus());
    }

    public function testDistrictLikeWithCityIn()
    {
        $cities = [219, 327];
        $results = $this->getContainer()->call([$this->regionService, 'getDistrictLikeWithCityIn'], ['q' => self::SEARCH[$this->getRandomString()], 'cities' => $cities]);
        $this->assertTrue($results->isStatus());
    }

    public function testCityLikeWithProvinceIn()
    {
        $provinceList = [11, 15];
        $results = $this->getContainer()->call([$this->regionService, 'getCityLikeWithProvinceIn'], ['q' => self::SEARCH[$this->getRandomString()], 'provinces' => $provinceList]);
        $this->assertTrue($results->isStatus());
    }

    public function testDistrictLikeWithProvinceIn()
    {
        $provinceList = [11, 15];
        $results = $this->getContainer()->call([$this->regionService, 'getDistrictLikeWithProvinceIn'], ['q' => self::SEARCH[$this->getRandomString()], 'provinces' => $provinceList]);
        $this->assertTrue($results->isStatus());
    }
}
