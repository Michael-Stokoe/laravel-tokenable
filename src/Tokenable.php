<?php

namespace Stokoe;

use Stokoe\Models\ApiToken;

trait Tokenable
{
    public function apiToken()
    {
        return $this->morphOne('Stokoe\Models\ApiToken', 'tokenable');
    }

    public function getApiTokenAttribute()
    {
        return $this->attributes['api_token'] = $this->apiToken()->first()->token ?? null;
    }

    public function generateApiToken()
    {
        if (function_exists('random_bytes')) {
            $token = bin2hex(random_bytes(config('tokenable.token_length')));
        } else {
            $token = bin2hex(openssl_random_pseudo_bytes(config('tokenable.token_length')));
        }
        
        $apiToken = new ApiToken([
            'token' => $token,
            'tokenable_id' => $this->id,
            'tokenable_type' => static::class,
        ]);

        return $this->apiToken()->save($apiToken)->token;
    }
}