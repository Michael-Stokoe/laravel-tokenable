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
        return $this->attributes['api_token'] = $this->apiToken()->orderBy('created_at', 'desc')->first()->token ?? null;
    }

    public function generateApiToken(int $length = null)
    {
        if (!isset($length))
        {
            $length = config('tokenable.token_length');
        }

        // if (function_exists('random_bytes')) {
            // $token = bin2hex(random_bytes($length));
        // } else {
            $token = bin2hex(openssl_random_pseudo_bytes($length));
        // }
        
        $apiToken = new ApiToken([
            'token' => $token,
            'tokenable_id' => $this->id,
            'tokenable_type' => static::class,
        ]);

        return $this->apiToken()->save($apiToken)->token;
    }
}