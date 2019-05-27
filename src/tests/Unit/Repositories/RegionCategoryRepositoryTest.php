<?php
/**
 * Author: galih
 * Date: 2019-05-24
 * Time: 18:35
 */

namespace WebAppId\Region\Tests\Unit\Repositories;

use WebAppId\Region\Repositories\RegionCategoryRepository;
use WebAppId\Region\Tests\TestCase;

class RegionCategoryRepositoryTest extends TestCase
{
    /**
     * @var RegionCategoryRepository;
     */
    private $regionCategoryRepository;
    
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->regionCategoryRepository = $this->getContainer()->make(RegionCategoryRepository::class);
        parent::__construct($name, $data, $dataName);
    }
    
    public function testGetByName()
    {
        $regionCategory = $this->testStore();
        $result = $this->getContainer()->call([$this->regionCategoryRepository,'getByName'],['name' => $regionCategory->name]);
        $this->assertNotEquals(null, $result);
    }
    
    public function testStore()
    {
        $result = $this->getContainer()->call([$this->regionCategoryRepository,'store'],['name' => $this->getFaker()->text(10)]);
        $this->assertNotEquals(null, $result);
        $this->assertNotEquals(null, $result->id);
        return $result;
    }
    
    public function testGetById(){
        $regionCategory = $this->testStore();
        $result = $this->getContainer()->call([$this->regionCategoryRepository,'getById'],['id' => $regionCategory->id]);
        $this->assertNotEquals(null, $result);
    }
    
    public function testGetAll(){
        $this->testStore();
        $result = $this->getContainer()->call([$this->regionCategoryRepository,'getAll']);
        $this->assertGreaterThanOrEqual(1, count($result));
    }
}
