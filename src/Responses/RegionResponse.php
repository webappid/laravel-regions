<?php


namespace WebAppId\Region\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 2019-05-27
 * Time: 23:28
 * Class RegionResponse
 * @package App\Http\Responses
 */
class RegionResponse extends AbstractResponse
{
    /**
     * @var LengthAwarePaginator
     */
    private $region;

    /**
     * @return LengthAwarePaginator
     */
    public function getRegion(): LengthAwarePaginator
    {
        return $this->region;
    }

    /**
     * @param LengthAwarePaginator $region
     */
    public function setRegion(LengthAwarePaginator $region): void
    {
        $this->region = $region;
    }
}