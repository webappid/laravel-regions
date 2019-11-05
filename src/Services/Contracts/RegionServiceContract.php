<?php


namespace WebAppId\Region\Services\Contracts;


use WebAppId\Region\Repositories\RegionRepository;
use WebAppId\Region\Responses\RegionResponse;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 2019-05-28
 * Time: 00:40
 * Class RegionServiceContract
 * Interface RegionServiceContract
 * @package App\Http\Services\Contracts
 */
interface RegionServiceContract
{

    /**
     * @param string $q
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getProvinceLike(string $q, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse;


    /**
     * @param string $q
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getCityLike(string $q, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse;

    /**
     * @param string $q
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getDistrictLike(string $q, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse;

    /**
     * @param string $q
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getSubDistrictLike(string $q, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse;

    /**
     * @param string $q
     * @param int $provinceId
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getCityLikeWithProvinceId(string $q, int $provinceId, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse;

    /**
     * @param string $q
     * @param int $provinceId
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getDistrictLikeWithProvinceId(string $q, int $provinceId, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse;

    /**
     * @param string $q
     * @param int $cityId
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getDistrictLikeWithCityId(string $q, int $cityId, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse;

    /**
     * @param string $q
     * @param array $provinces
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getCityLikeWithProvinceIn(string $q, array $provinces, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse;

    /**
     * @param string $q
     * @param array $provinces
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getDistrictLikeWithProvinceIn(string $q, array $provinces, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse;

    /**
     * @param string $q
     * @param array $cities
     * @param RegionRepository $regionRepository
     * @param RegionResponse $regionResponse
     * @return RegionResponse
     */
    public function getDistrictLikeWithCityIn(string $q, array $cities, RegionRepository $regionRepository, RegionResponse $regionResponse): RegionResponse;
}
