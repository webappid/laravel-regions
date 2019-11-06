<?php


namespace WebAppId\Region\Services;

use WebAppId\DDD\Services\BaseService;
use WebAppId\Region\Repositories\RegionRepository;
use WebAppId\Region\Responses\RegionResponse;
use WebAppId\Region\Services\Contracts\RegionServiceContract;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 2019-07-29
 * Time: 14:26
 * Class RegionService
 * @package WebAppId\Region\Services
 */
class RegionService extends BaseService implements RegionServiceContract
{

    /**
     * @param string $q
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getProvinceLike(string $q, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse
    {
        $result = $this->getContainer()->call([$regionRepository, 'getProvinceLike'], ['q' => $q]);
        if (count($result) > 0) {
            $regionResponse->setStatus(true);
            $regionResponse->setMessage('Get Province Data Found');
            $regionResponse->setRegion($result);
        } else {
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No Province Data Available');
        }
        return $regionResponse;
    }

    /**
     * @param string $q
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getCityLike(string $q, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse
    {
        $result = $this->getContainer()->call([$regionRepository, 'getCityLike'], ['q' => $q]);
        if (count($result) > 0) {
            $regionResponse->setStatus(true);
            $regionResponse->setMessage('Get City Data Found');
            $regionResponse->setRegion($result);
        } else {
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No City Data Available');
        }
        return $regionResponse;
    }

    /**
     * @param string $q
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getDistrictLike(string $q, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse
    {
        $result = $this->getContainer()->call([$regionRepository, 'getDistrictLike'], ['q' => $q]);
        if (count($result) > 0) {
            $regionResponse->setStatus(true);
            $regionResponse->setMessage('Get District Data Found');
            $regionResponse->setRegion($result);
        } else {
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No District Data Available');
        }
        return $regionResponse;
    }

    /**
     * @param string $q
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getSubDistrictLike(string $q, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse
    {
        $result = $this->getContainer()->call([$regionRepository, 'getSubDistrictLike'], ['q' => $q]);
        if (count($result) > 0) {
            $regionResponse->setStatus(true);
            $regionResponse->setMessage('Get Sub District Data Found');
            $regionResponse->setRegion($result);
        } else {
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No Sub District Data Available');
        }
        return $regionResponse;
    }

    /**
     * @param string $q
     * @param int $provinceId
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getCityLikeWithProvinceId(string $q, int $provinceId, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse
    {
        $result = $this->getContainer()->call([$regionRepository, 'getCityLikeWithProvinceId'], ['q' => $q, 'provinceId' => $provinceId]);
        if (count($result) > 0) {
            $regionResponse->setStatus(true);
            $regionResponse->setMessage('Get City Data By Province Id Found');
            $regionResponse->setRegion($result);
        } else {
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No City Data By Province Id Data Available');
        }
        return $regionResponse;
    }

    /**
     * @param string $q
     * @param int $provinceId
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getDistrictLikeWithProvinceId(string $q, int $provinceId, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse
    {
        $result = $this->getContainer()->call([$regionRepository, 'getDistrictLikeWithProvinceId'], ['q' => $q, 'provinceId' => $provinceId]);
        if (count($result) > 0) {
            $regionResponse->setStatus(true);
            $regionResponse->setMessage('Get District Data By Province Id Found');
            $regionResponse->setRegion($result);
        } else {
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No District Data By Province Id Available');
        }
        return $regionResponse;
    }

    /**
     * @param string $q
     * @param int $cityId
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getDistrictLikeWithCityId(string $q, int $cityId, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse
    {
        $result = $this->getContainer()->call([$regionRepository, 'getDistrictLikeWithCityId'], ['q' => $q, 'cityId' => $cityId]);
        if (count($result) > 0) {
            $regionResponse->setStatus(true);
            $regionResponse->setMessage('Get District Data By Province Id Found');
            $regionResponse->setRegion($result);
        } else {
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No District Data By Province Id Available');
        }
        return $regionResponse;
    }

    /**
     * @param string $q
     * @param array $provinces
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getCityLikeWithProvinceIn(string $q, array $provinces, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse
    {
        $result = $this->getContainer()->call([$regionRepository, 'getCityLikeWithProvinceIn'], ['q' => $q, 'provinces' => $provinces]);
        if (count($result) > 0) {
            $regionResponse->setStatus(true);
            $regionResponse->setMessage('Get City Data By Provinces Found');
            $regionResponse->setRegion($result);
        } else {
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No City Data By Provinces Available');
        }
        return $regionResponse;
    }

    /**
     * @param string $q
     * @param array $provinces
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getDistrictLikeWithProvinceIn(string $q, array $provinces, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse
    {
        $result = $this->getContainer()->call([$regionRepository, 'getDistrictLikeWithProvinceIn'], ['q' => $q, 'provinces' => $provinces]);
        if (count($result) > 0) {
            $regionResponse->setStatus(true);
            $regionResponse->setMessage('Get District Data By Provinces Found');
            $regionResponse->setRegion($result);
        } else {
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No District Data By Provinces Available');
        }
        return $regionResponse;
    }

    /**
     * @param string $q
     * @param array $cities
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getDistrictLikeWithCityIn(string $q, array $cities, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse
    {
        $result = $this->getContainer()->call([$regionRepository, 'getDistrictLikeWithCityIn'], ['q' => $q, 'cities' => $cities]);
        if (count($result) > 0) {
            $regionResponse->setStatus(true);
            $regionResponse->setMessage('Get District Data By Cities Found');
            $regionResponse->setRegion($result);
        } else {
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No District Data By Cities Available');
        }
        return $regionResponse;
    }

    /**
     * @param string $q
     * @param array $ids
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getProvinceLikeWhereIdIn(string $q, array $ids, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse
    {
        $result = $this->getContainer()->call([$regionRepository, 'getProvinceLikeWhereIdIn'], ['q' => $q, 'ids'=> $ids]);
        if (count($result) > 0) {
            $regionResponse->setStatus(true);
            $regionResponse->setMessage('Get Province Data Found');
            $regionResponse->setRegion($result);
        } else {
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No Province Data Available');
        }
        return $regionResponse;
    }
}