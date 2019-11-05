<?php
/**
 * Author: galih
 * Date: 2019-05-24
 * Time: 18:42
 */

namespace WebAppId\Region\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Region\Models\Region;
use WebAppId\Region\Services\Params\RegionParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface RegionRepositoryContract
 * @package App\Http\Repositories\Contracts
 */
interface RegionRepositoryContract
{
    /**
     * @param RegionParam $regionParam
     * @param Region $region
     * @return Region|null
     */
    public function store(RegionParam $regionParam, Region $region): ?Region;

    /**
     * @param string $name
     * @param int $parentId
     * @param Region $region
     * @return Region|null
     */
    public function getByNameAndParentId(string $name, int $parentId, Region $region): ?Region;

    /**
     * @param int $id
     * @param Region $region
     * @return Region|null
     */
    public function getById(int $id, Region $region): ?Region;

    /**
     * @param int $categoryId
     * @param string $name
     * @param Region $region
     * @return mixed
     */
    public function getByNameLikeAndCategoryId(int $categoryId, string $name, Region $region): Collection;

    /**
     * @param string $q
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getProvinceLike(string $q, Region $region, int $limit = 20): LengthAwarePaginator;

    /**
     * @param int $id
     * @param Region $region
     * @return Region|null
     */
    public function getProvinceById(int $id, Region $region): ?Region;

    /**
     * @param string $q
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getCityLike(string $q, Region $region, int $limit = 20): LengthAwarePaginator;

    /**
     * @param int $id
     * @param Region $region
     * @return Region|null
     */
    public function getCityById(int $id, Region $region): ?Region;


    /**
     * @param string $q
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getDistrictLike(string $q, Region $region, int $limit = 20): LengthAwarePaginator;

    /**
     * @param int $id
     * @param Region $region
     * @return Region|null
     */
    public function getDistrictId(int $id, Region $region): ?Region;

    /**
     * @param string $q
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getSubDistrictLike(string $q, Region $region, int $limit = 20): LengthAwarePaginator;

    /**
     * @param int $id
     * @param Region $region
     * @return Region
     */
    public function getSubDistrictId(int $id, Region $region): Region;

    /**
     * @param string $q
     * @param int $provinceId
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getCityLikeWithProvinceId(string $q, int $provinceId, Region $region, int $limit = 20): LengthAwarePaginator;


    /**
     * @param string $q
     * @param int $cityId
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getDistrictLikeWithCityId(string $q, int $cityId, Region $region, int $limit = 20): LengthAwarePaginator;

    /**
     * @param string $q
     * @param int $provinceId
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getDistrictLikeWithProvinceId(string $q, int $provinceId, Region $region, int $limit = 20): LengthAwarePaginator;

    /**
     * @param string $q
     * @param array $provinces
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getCityLikeWithProvinceIn(string $q, array $provinces, Region $region, int $limit = 20): LengthAwarePaginator;


    /**
     * @param string $q
     * @param array $cities
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getDistrictLikeWithCityIn(string $q, array $cities, Region $region, int $limit = 20): LengthAwarePaginator;

    /**
     * @param string $q
     * @param array $provinces
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getDistrictLikeWithProvinceIn(string $q, array $provinces, Region $region, int $limit = 20): LengthAwarePaginator;
}