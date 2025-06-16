<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chief_Gear extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chief__gears';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Tier', 'Stars', 'Hardened_Alloy', 'Polishing_Solution', 'Design_Plans', 'Lunar_Amber', 'Power'];

    
}
