<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CollectionLink extends Model
{
    protected $fillable = ['user_id', 'title', 'slug', 'target_count'];

    public function contacts() : HasMany {
        return $this->hasMany(Contact::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
