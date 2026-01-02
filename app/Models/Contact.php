<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    // Ajoute ces lignes :
    protected $fillable = [
        'name',
        'phone',
        'collection_link_id'
    ];

    /**
     * Relation inverse : Un contact appartient à un lien de collecte
     */
    public function collectionLink() : BelongsTo
    {
        return $this->belongsTo(CollectionLink::class);
    }
}
