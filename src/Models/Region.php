<?php
/**
 * Author: galih
 * Date: 2019-05-24
 * Time: 07:14
 */

namespace WebAppId\Region\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class Region
 * @package App\Http\Models
 */
class Region extends Model
{
    protected $table = 'regions';

    protected $fillable = ['id', 'category_id', 'parent_id', 'name'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Region::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function childs()
    {
        return $this->hasMany(Region::class, 'parent_id');
    }

    /**
     * @return HasOne
     */
    public function postalCode()
    {
        return $this->hasOne('region_postal_codes', 'region_id', 'id');
    }
}