<?php

namespace Stokoe\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiToken extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'token',
        'tokenable_id',
        'tokenable_type',
    ];

    public function tokenable()
    {
        return $this->morphTo();
    }
}
