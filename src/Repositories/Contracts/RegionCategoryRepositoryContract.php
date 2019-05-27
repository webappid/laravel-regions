<?php
/**
 * Author: galih
 * Date: 2019-05-24
 * Time: 18:30
 */

namespace WebAppId\Region\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use WebAppId\Region\Models\RegionCategory;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface RegionCategoryRepositoryContract
 * @package App\Http\Repositories\Contracts
 */
interface RegionCategoryRepositoryContract
{
    /**
     * @param string $name
     * @param RegionCategory $regionCategory
     * @return RegionCategory
     */
    public function store(string $name, RegionCategory $regionCategory): ?RegionCategory;
    
    /**
     * @param string $name
     * @param RegionCategory $regionCategory
     * @return RegionCategory|null
     */
    public function getByName(string $name, RegionCategory $regionCategory):?RegionCategory;
    
    /**
     * @param int $id
     * @param RegionCategory $regionCategory
     * @return RegionCategory
     */
    public function getById(int $id, RegionCategory $regionCategory): RegionCategory;
    
    /**
     * @param RegionCategory $regionCategory
     * @return Collection
     */
    public function getAll(RegionCategory $regionCategory): Collection;
}