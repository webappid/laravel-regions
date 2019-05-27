<?php
/**
 * Author: galih
 * Date: 2019-05-24
 * Time: 07:12
 */

namespace WebAppId\Region\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class RegionCategory
 * @package App\Http\Models
 */
class RegionCategory extends Model
{
    protected $table = 'region_categories';
    
    protected $fillable = ['id', 'name'];
    
    protected $hidden = ['created_at', 'updated_at'];
    
}