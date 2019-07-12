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
        $type = $this->tokenable_type;
        $id = $this->tokenable_id;

        $record = $type::find($id);

        return $record;
    }

    /**
     * Scope a query to only include primary Api Tokens.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePrimary($query)
    {
        return $query->where('primary', true);
    }

    /**
     * Set Api Token as the model's current primary API token.
     *
     * @param [type] $primary
     * @return void
     */
    public function setPrimary($primary)
    {
        $currentPrimary = ApiToken::primary()->where([['tokenable_type', $this->tokenable_type], ['tokenable_id', $this->tokenable_id]])->first();

        if (isset($currentPrimary)) {
            $currentPrimary->primary = false;
            $currentPrimary->save();
        }

        $this->primary = $primary;
        $this->save();
    }
}
