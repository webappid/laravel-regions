<?php


namespace WebAppId\Region\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 2019-07-29
 * Time: 18:20
 * Class RegionPostalCode
 * @package WebAppId\Region\Models
 */
class RegionPostalCode extends Model
{
    protected $table = 'region_postal_codes';
    protected $fillable = ['id', 'region_id', 'postal_code'];
}