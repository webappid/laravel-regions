<?php
/**
 * Author: galih
 * Date: 2019-05-24
 * Time: 18:46
 */

namespace WebAppId\Region\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Tools\Lazy;
use WebAppId\Region\Models\Region;
use WebAppId\Region\Repositories\Contracts\RegionRepositoryContract;
use WebAppId\Region\Services\Params\RegionParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class RegionRepository
 * @package App\Http\Repositories
 */
class RegionRepository implements RegionRepositoryContract
{
    /**
     * @param RegionParam $regionParam
     * @param Region $region
     * @return Region|null
     * @throws \Exception
     */
    public function store(RegionParam $regionParam, Region $region): ?Region
    {
        try {
            if ($regionParam->id != null) {
                $region->id = $regionParam->id;
            }

            $region = Lazy::copy($regionParam, $region);

            $region->save();
            return $region;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @param string $name
     * @param int $parentId
     * @param Region $region
     * @return Region|null
     */
    public function getByNameAndParentId(string $name, int $parentId, Region $region): ?Region
    {
        return $region->where('name', $name)->where('parent_id', $parentId)->first();
    }

    /**
     * @param int $id
     * @param Region $region
     * @return Region|null
     */
    public function getById(int $id, Region $region): ?Region
    {
        return $region->find($id);
    }

    /**
     * @param int $categoryId
     * @param string $name
     * @param Region $region
     * @return mixed
     */
    public function getByNameLikeAndCategoryId(int $categoryId, string $name, Region $region): Collection
    {
        return $region->where('name', 'LIKE', '%' . $name . '%')->where('category_id', $categoryId)->get();
    }

    /**
     * @param string $q
     * @param array $column
     * @param int $id
     * @param Region $region
     * @return mixed
     */
    protected function getStructProvince(?string $q, array $column, Region $region, int $id = null)
    {
        $province = array(
            "province.id AS province_id",
            "province.name AS province_name"
        );
        $column = array_merge($province, $column);
        return
            $region
                ->select(
                    $column
                )
                ->from('regions AS province')
                ->when(!is_null($q), function ($query) use ($q) {
                    return $query
                        ->orWhere('province.name', 'LIKE', '%' . $q . '%');
                })
                ->when(!is_null($id), function ($query) use ($id) {
                    return $query->where('province.id', $id);
                });
    }

    /**
     * @param string $q
     * @param array $column
     * @param Region $region
     * @param int $id
     * @param int|null $provinceId
     * @param array $provinces
     * @return mixed
     */
    protected function getStructCity(?string $q, array $column, Region $region, int $id = null, int $provinceId = null, array $provinces = null)
    {
        $city = array(
            "city.id AS city_id",
            "city.name AS city_name"
        );

        $column = array_merge($city, $column);

        return
            $this->getStructProvince($q, $column, $region)
                ->join('regions AS city', function ($query) {
                    return $query->on('province.id', 'city.parent_id')
                        ->where('province.category_id', 1)
                        ->where('city.category_id', 2);
                })->when(!is_null($q), function ($query) use ($q) {
                    return $query
                        ->orWhere('city.name', 'LIKE', '%' . $q . '%');
                })->when(!is_null($id), function ($query) use ($id) {
                    return $query->where('city.id', $id);
                })->when(!is_null($provinceId), function ($query) use ($provinceId) {
                    return $query->where('city.parent_id', $provinceId);
                })->when(!is_null($provinces), function ($query) use ($provinces) {
                    return $query->whereIn('city.parent_id', $provinces);
                });

    }

    /**
     * @param string $q
     * @param array $column
     * @param Region $region
     * @param int $id
     * @param int|null $cityId
     * @param array|null $cities
     * @param int|null $provinceId
     * @param array|null $provinces
     * @return mixed
     */
    protected function getStructDistrict(?string $q, array $column, Region $region, int $id = null, int $cityId = null, array $cities = null, int $provinceId = null, array $provinces = null)
    {
        $district = array(
            "district.id AS district_id",
            "district.name AS district_name");

        $column = array_merge($district, $column);

        return $this->getStructCity($q, $column, $region, null, $provinceId, $provinces)
            ->join('regions AS district', function ($query) {
                return $query->on('district.parent_id', 'city.id')
                    ->where('district.category_id', 3);
            })->when(!is_null($q), function ($query) use ($q) {
                return $query
                    ->orWhere('district.name', 'LIKE', '%' . $q . '%');
            })->when(!is_null($id), function ($query) use ($id) {
                return $query->where('district.id', $id);
            })->when(!is_null($cityId), function ($query) use ($cityId) {
                return $query->where('district.parent_id', $cityId);
            })->when(!is_null($cities), function ($query) use ($cities) {
                return $query->whereIn('district.parent_id', $cities);
            });

    }

    /**
     * @param string $q
     * @param int $id
     * @param Region $region
     * @return mixed
     */
    protected function getStructSubDistrict(?string $q, Region $region, int $id = null)
    {
        $sub_district = array(
            "sub_district.id AS sub_district_id",
            "sub_district.name AS sub_district_name"
        );

        return $this->getStructDistrict($q, $sub_district, $region)
            ->join('regions AS sub_district', function ($query) {
                return $query->on('district.id', 'sub_district.parent_id')
                    ->where('sub_district.category_id', 4);
            })->when(!is_null($q), function ($query) use ($q) {
                return $query
                    ->orWhere('sub_district.name', 'LIKE', '%' . $q . '%');
            })->when(!is_null($id), function ($query) use ($id) {
                return $query->where('sub_district.id', $id);
            });
    }

    /**
     * @param string $q
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getProvinceLike(string $q, Region $region, int $limit = 20): LengthAwarePaginator
    {
        return $this
            ->getStructProvince($q, [], $region)
            ->paginate($limit);
    }

    /**
     * @param string $q
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getCityLike(string $q, Region $region, int $limit = 20): LengthAwarePaginator
    {
        return $this
            ->getStructCity($q, [], $region)
            ->paginate($limit);
    }

    /**
     * @param string $q
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getDistrictLike(string $q, Region $region, int $limit = 20): LengthAwarePaginator
    {
        return $this
            ->getStructDistrict($q, [], $region)
            ->paginate($limit);
    }

    /**
     * @param string $q
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getSubDistrictLike(string $q, Region $region, int $limit = 20): LengthAwarePaginator
    {
        return $this
            ->getStructSubDistrict($q, $region)
            ->paginate($limit);
    }

    /**
     * @param int $id
     * @param Region $region
     * @return Region|null
     */
    public function getProvinceById(int $id, Region $region): ?Region
    {
        return $this->getStructProvince(null, [], $region, $id)->first();
    }

    /**
     * @param int $id
     * @param Region $region
     * @return Region|null
     */
    public function getCityById(int $id, Region $region): ?Region
    {
        return $this->getStructCity(null, [], $region, $id)->first();
    }

    /**
     * @param int $id
     * @param Region $region
     * @return Region|null
     */
    public function getDistrictId(int $id, Region $region): ?Region
    {
        return $this->getStructDistrict(null, [], $region, $id)->first();
    }

    /**
     * @param int $id
     * @param Region $region
     * @return Region
     */
    public function getSubDistrictId(int $id, Region $region): Region
    {
        return $this->getStructSubDistrict(null, $region, $id)->first();
    }

    /**
     * @param string $q
     * @param int $provinceId
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getCityLikeWithProvinceId(string $q, int $provinceId, Region $region, int $limit = 20): LengthAwarePaginator
    {
        return $this
            ->getStructCity($q, [], $region, null, $provinceId)
            ->paginate($limit);
    }

    /**
     * @param string $q
     * @param int $cityId
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getDistrictLikeWithCityId(string $q, int $cityId, Region $region, int $limit = 20): LengthAwarePaginator
    {
        return $this
            ->getStructDistrict($q, [], $region, null, $cityId)
            ->paginate($limit);
    }

    /**
     * @param string $q
     * @param int $provinceId
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getDistrictLikeWithProvinceId(string $q, int $provinceId, Region $region, int $limit = 20): LengthAwarePaginator
    {
        return $this
            ->getStructDistrict($q, [], $region, null, null, null,  $provinceId)
            ->paginate($limit);
    }

    /**
     * @param string $q
     * @param array $provinces
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getCityLikeWithProvinceIn(string $q, array $provinces, Region $region, int $limit = 20): LengthAwarePaginator
    {
        return $this
            ->getStructCity($q, [], $region, null, null, $provinces)
            ->paginate($limit);
    }

    /**
     * @param string $q
     * @param array $cities
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getDistrictLikeWithCityIn(string $q, array $cities, Region $region, int $limit = 20): LengthAwarePaginator
    {
        return $this
            ->getStructDistrict($q, [], $region, null, null, $cities)
            ->paginate($limit);
    }

    /**
     * @param string $q
     * @param array $provinces
     * @param Region $region
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getDistrictLikeWithProvinceIn(string $q, array $provinces, Region $region, int $limit = 20): LengthAwarePaginator
    {
        return $this
            ->getStructDistrict($q, [], $region, null, null, null, null, $provinces)
            ->paginate($limit);
    }
}