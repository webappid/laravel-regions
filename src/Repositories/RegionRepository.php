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
     */
    public function store(RegionParam $regionParam, Region $region): ?Region
    {
        try {
            if ($regionParam->getId() != null) {
                $region->id = $regionParam->getId();
            }

            $region->category_id = $regionParam->getCategoryId();
            $region->parent_id = $regionParam->getParentId();
            $region->name = $regionParam->getName();

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
    protected function getStructProvince(?string $q, array $column, ?int $id, Region $region)
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
     * @param int $id
     * @param Region $region
     * @return mixed
     */
    protected function getStructCity(?string $q, array $column, ?int $id, Region $region)
    {
        $city = array(
            "city.id AS city_id",
            "city.name AS city_name"
        );

        $column = array_merge($city, $column);

        return
            $this->getStructProvince($q, $column, null, $region)
                ->join('regions AS city', function ($query) {
                    return $query->on('province.id', 'city.parent_id')
                        ->on('province.category_id', '1')
                        ->on('city.category_id', '2');
                })->when(!is_null($q), function ($query) use ($q) {
                    return $query
                        ->orWhere('city.name', 'LIKE', '%' . $q . '%');
                })->when(!is_null($id), function ($query) use ($id) {
                    return $query->where('city.id', $id);
                });

    }

    /**
     * @param string $q
     * @param array $column
     * @param int $id
     * @param Region $region
     * @return mixed
     */
    protected function getStructDistrict(?string $q, array $column, ?int $id, Region $region)
    {
        $district = array(
            "district.id AS district_id",
            "district.name AS district_name");

        $column = array_merge($district, $column);

        return $this->getStructCity($q, $column, null, $region)
            ->join('regions AS district', function ($query) {
                return $query->on('district.parent_id', 'city.id')
                    ->on('district.category_id', '3');
            })->when(!is_null($q), function ($query) use ($q) {
                return $query
                    ->orWhere('district.name', 'LIKE', '%' . $q . '%');
            })->when(!is_null($id), function ($query) use ($id) {
                return $query->where('district.id', $id);
            });

    }

    /**
     * @param string $q
     * @param int $id
     * @param Region $region
     * @return mixed
     */
    protected function getStructSubDistrict(?string $q, ?int $id, Region $region)
    {
        $sub_district = array(
            "sub_district.id AS sub_district_id",
            "sub_district.name AS sub_district_name"
        );

        return $this->getStructDistrict($q, $sub_district, null, $region)
            ->join('regions AS sub_district', function ($query) {
                return $query->on('district.id', 'sub_district.parent_id')
                    ->on('sub_district.category_id', '4');
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
            ->getStructProvince($q, [], null, $region)
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
            ->getStructCity($q, [], null, $region)
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
            ->getStructDistrict($q, [], null, $region)
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
            ->getStructSubDistrict($q, null, $region)
            ->paginate($limit);
    }

    /**
     * @param int $id
     * @param Region $region
     * @return Region|null
     */
    public function getProvinceById(int $id, Region $region): ?Region
    {
        return $this->getStructProvince(null, [], $id, $region)->first();
    }

    /**
     * @param int $id
     * @param Region $region
     * @return Region|null
     */
    public function getCityById(int $id, Region $region): ?Region
    {
        return $this->getStructCity(null, [], $id, $region)->first();
    }

    /**
     * @param int $id
     * @param Region $region
     * @return Region|null
     */
    public function getDistrictId(int $id, Region $region): ?Region
    {
        return $this->getStructDistrict(null, [], $id, $region)->first();
    }

    /**
     * @param int $id
     * @param Region $region
     * @return Region
     */
    public function getSubDistrictId(int $id, Region $region): Region
    {
        return $this->getStructSubDistrict(null, $id, $region)->first();
    }
}