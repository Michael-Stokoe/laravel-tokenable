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

    public function getRelatedModel()
    {
        $model = $this->tokenable_type;
        $id = $this->tokenable_id;

        $related = $model::where('id', $id)->first();

        return $related;
    }
}
