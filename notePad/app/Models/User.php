<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class User extends Model
{
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * Notes created by the user.
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Notes::class, 'user_id');
    }

    /**
     * Generate and persist an API token for the user.
     */
    public function generateApiToken(): string
    {
        $token = hash('sha256', Str::uuid()->toString() . microtime(true));
        $this->remember_token = $token;
        $this->save();

        return $token;
    }
}
