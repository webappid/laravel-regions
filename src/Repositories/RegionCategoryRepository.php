<?php
/**
 * Author: galih
 * Date: 2019-05-24
 * Time: 18:30
 */

namespace WebAppId\Region\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use WebAppId\Region\Models\RegionCategory;
use WebAppId\Region\Repositories\Contracts\RegionCategoryRepositoryContract;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class RegionCategoryRepositoryContract
 * @package App\Http\Repositories
 */
class RegionCategoryRepository implements RegionCategoryRepositoryContract
{
    
    /**
     * @param string $name
     * @param RegionCategory $regionCategory
     * @return RegionCategory
     */
    public function store(string $name, RegionCategory $regionCategory): ?RegionCategory
    {
        try {
            $regionCategory->name = $name;
            $regionCategory->save();
            return $regionCategory;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }
    
    /**
     * @param string $name
     * @param RegionCategory $regionCategory
     * @return RegionCategory|null
     */
    public function getByName(string $name, RegionCategory $regionCategory): ?RegionCategory
    {
        return $regionCategory->where('name', $name)->first();
    }
    
    /**
     * @param int $id
     * @param RegionCategory $regionCategory
     * @return RegionCategory
     */
    public function getById(int $id, RegionCategory $regionCategory): RegionCategory
    {
        return $regionCategory->find($id);
    }
    
    /**
     * @param RegionCategory $regionCategory
     * @return Collection
     */
    public function getAll(RegionCategory $regionCategory): Collection
    {
        return $regionCategory->get();
    }
}