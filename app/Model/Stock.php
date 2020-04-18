<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'capital',
        'industry_code',
        'classification',
        'issued',
        'twse_date',
        'otc_date',
        'creation_date',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
