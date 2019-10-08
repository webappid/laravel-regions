<?php


namespace WebAppId\Region\Repositories\Contracts;


use WebAppId\Region\Models\RegionPostalCode;
use WebAppId\Region\Services\Params\RegionPostalCodeParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 2019-07-29
 * Time: 18:22
 * Class RegionPostalCodeContract
 * Interface RegionPostalCodeContract
 * @package WebAppId\Region\Repositories\Contracts
 */
interface RegionPostalCodeContract
{
    /**
     * @param RegionPostalCodeParam $regionPostalCodeParam
     * @param RegionPostalCode $regionPostalCode
     * @return RegionPostalCode|null
     */
    public function store(RegionPostalCodeParam $regionPostalCodeParam, RegionPostalCode $regionPostalCode): ?RegionPostalCode;

    public function getByRegionId();
}