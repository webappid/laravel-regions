<?php
/**
 * Author: galih
 * Date: 2019-05-24
 * Time: 18:49
 */

namespace WebAppId\Region\Tests\Unit\Repositories;


use WebAppId\Region\Repositories\RegionRepository;
use WebAppId\Region\Services\Params\RegionParam;
use WebAppId\Region\Tests\TestCase;

class RegionRepositoryTest extends TestCase
{

    private const SEARCH = 'aiu';

    /**
     * @var RegionRepository
     */
    private $regionRepository;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->regionRepository = $this->getContainer()->make(RegionRepository::class);
        parent::__construct($name, $data, $dataName);
    }

    public function testGetByNameAndParentId()
    {
        $regionParam = $this->testStore();
        $result = $this->getContainer()->call([$this->regionRepository, 'getByNameAndParentId'], ['name' => $regionParam->name, 'parentId' => $regionParam->parent_id]);
        $this->assertNotEquals(null, $result);
    }

    public function dummy(): RegionParam
    {
        $dummy = new RegionParam();
        $dummy->name = $this->getFaker()->text(30);
        $dummy->category_id = $this->getFaker()->randomNumber();
        $dummy->parent_id = $this->getFaker()->randomNumber();
        return $dummy;
    }

    public function testStore()
    {
        $regionParam = $this->dummy();
        $result = $this->getContainer()->call([$this->regionRepository, 'store'], ['regionParam' => $regionParam]);
        $this->assertNotEquals(null, $result);
        $this->assertNotEquals(null, $result->id);
        return $result;
    }

    public function testGetById()
    {
        $region = $this->testStore();
        $result = $this->getContainer()->call([$this->regionRepository, 'getById'], ['id' => $region->id]);
        $this->assertNotEquals(null, $result);
    }

    private function getRandomString()
    {
        return $this->getFaker()->numberBetween(0, strlen(self::SEARCH) - 1);
    }

    public function testDistrictLike()
    {
        $results = $this->getContainer()->call([$this->regionRepository, 'getDistrictLike'], ['q' => self::SEARCH[$this->getRandomString()]]);
        $this->assertGreaterThanOrEqual(1, count($results));
    }

    public function testCityLike()
    {
        $results = $this->getContainer()->call([$this->regionRepository, 'getCityLike'], ['q' => self::SEARCH[$this->getRandomString()]]);
        $this->assertGreaterThanOrEqual(1, count($results));
    }

    public function testProvinceLike()
    {
        $results = $this->getContainer()->call([$this->regionRepository, 'getProvinceLike'], ['q' => self::SEARCH[$this->getRandomString()]]);
        $this->assertGreaterThanOrEqual(1, count($results));
    }

    public function testProvinceId()
    {
        $results = $this->getContainer()->call([$this->regionRepository, 'getProvinceLike'], ['q' => self::SEARCH[$this->getRandomString()]]);
        $result = $this->getContainer()->call([$this->regionRepository, 'getProvinceById'], ['id' => $results[0]->province_id]);
        self::assertNotEquals(null, $result);
    }

    public function testCityId()
    {
        $results = $this->getContainer()->call([$this->regionRepository, 'getCityLike'], ['q' => self::SEARCH[$this->getRandomString()]]);
        $result = $this->getContainer()->call([$this->regionRepository, 'getCityById'], ['id' => $results[0]->city_id]);
        self::assertNotEquals(null, $result);
    }

    public function testDistrictId()
    {
        $results = $this->getContainer()->call([$this->regionRepository, 'getDistrictLike'], ['q' => self::SEARCH[$this->getRandomString()]]);
        $result = $this->getContainer()->call([$this->regionRepository, 'getDistrictId'], ['id' => $results[0]->district_id]);
        self::assertNotEquals(null, $result);
    }

    public function testDistrictLikeWithCityId()
    {
        $cities = [219, 327];
        $city = $cities[$this->getFaker()->numberBetween(0, count($cities) - 1)];
        $results = $this->getContainer()->call([$this->regionRepository, 'getDistrictLikeWithCityId'], ['q' => self::SEARCH[$this->getRandomString()], 'cityId' => $city]);
        $this->assertGreaterThanOrEqual(1, count($results));
    }

    public function testCityLikeWithProvinceId()
    {
        $provinceList = [11, 15];
        $province = $provinceList[$this->getFaker()->numberBetween(0, count($provinceList) - 1)];
        $results = $this->getContainer()->call([$this->regionRepository, 'getCityLikeWithProvinceId'], ['q' => self::SEARCH[$this->getRandomString()], 'provinceId' => $province]);
        $this->assertGreaterThanOrEqual(1, count($results));
    }

    public function testDistrictLikeWithProvinceId()
    {
        $provinceList = [11, 15];
        $province = $provinceList[$this->getFaker()->numberBetween(0, count($provinceList) - 1)];
        $results = $this->getContainer()->call([$this->regionRepository, 'getDistrictLikeWithProvinceId'], ['q' => self::SEARCH[$this->getRandomString()], 'provinceId' => $province]);
        $this->assertGreaterThanOrEqual(1, count($results));
    }

    public function testCityLikeWithProvinceIn()
    {
        $provinces = [11, 15];
        $results = $this->getContainer()->call([$this->regionRepository, 'getCityLikeWithProvinceIn'], ['q' => self::SEARCH[$this->getRandomString()], 'provinces' => $provinces]);
        $this->assertGreaterThanOrEqual(1, count($results));
    }

    public function testDistrictLikeWithCityIn()
    {
        $cities = [11, 15];
        $results = $this->getContainer()->call([$this->regionRepository, 'getDistrictLikeWithCityIn'], ['q' => self::SEARCH[$this->getRandomString()], 'cities' => $cities]);
        $this->assertGreaterThanOrEqual(1, count($results));
    }

    public function testDistrictLikeWithProvinceIn()
    {
        $provinces = [11, 15];
        $results = $this->getContainer()->call([$this->regionRepository, 'getDistrictLikeWithProvinceIn'], ['q' => self::SEARCH[$this->getRandomString()], 'provinces' => $provinces]);
        $this->assertGreaterThanOrEqual(1, count($results));
    }

    public function testProvinceLikeWhereIdIn()
    {
        $provinces = [11, 15];
        $results = $this->getContainer()->call([$this->regionRepository, 'getProvinceLikeWhereIdIn'], ['q' => self::SEARCH[$this->getRandomString()], 'ids' => $provinces]);
        $this->assertGreaterThanOrEqual(1, count($results));
    }
}
