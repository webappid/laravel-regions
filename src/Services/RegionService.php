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
        }else{
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
        }else{
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
        }else{
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
        }else{
            $regionResponse->setStatus(false);
            $regionResponse->setMessage('No Sub District Data Available');
        }
        return $regionResponse;
    }
}