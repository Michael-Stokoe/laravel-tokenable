<?php

namespace Stokoe;

use Stokoe\Models\ApiToken;

trait Tokenable
{
    public function apiTokens()
    {
        return $this->morphMany('Stokoe\Models\ApiToken', 'tokenable', null, null, $this->primaryKey);
    }

    public function getApiTokenAttribute()
    {
        return $this->attributes['api_token'] = $this->apiTokens()->where('primary', true)->first()->token ?? null;
    }

    public function generateApiToken(int $length = null, bool $setAsPrimary = null)
    {
        $length ?? $length = config('tokenable.token_length');

        $token = bin2hex(random_bytes($length));

        $apiToken = new ApiToken([
            'token' => $token,
            'tokenable_id' => $this->{$this->primaryKey},
            'tokenable_type' => static::class,
        ]);

        $makePrimary = $setAsPrimary ?:config('tokenable.make_primary');

        $makePrimary ?? $apiToken->setPrimary(true);

        return $this->apiTokens()->save($apiToken)->token;
    }
}