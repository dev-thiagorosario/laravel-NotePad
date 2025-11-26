<?php

declare(strict_types=1);

namespace App\Http\Traits;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

trait DecryptIdTrait
{
    protected function decryptId(string $id): ?int{
        try {
            return (int) Crypt::decrypt($id);
        } catch (DecryptException $e){
            return null;
        }
    }
}
