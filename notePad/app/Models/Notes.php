<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notes extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'content'
        ];
    /**
     * Owner of the note.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
