<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    /* protected $fillable = [];
 */    protected $guarded = [
        'is_active',
    ];
}
