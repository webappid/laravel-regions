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
}
