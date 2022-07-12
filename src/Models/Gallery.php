<?php

namespace Takshak\Agallery\Models;

use App\Models\User;
use Database\Factories\GalleryItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Takshak\Adash\Traits\Models\CommonModelTrait;

class Gallery extends Model
{
    use HasFactory, CommonModelTrait;
    protected $guarded = [];

    protected static function newFactory()
    {
        return GalleryItemFactory::new();
    }

    /**
     * The galleryItems that belong to the Gallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function galleryItems(): BelongsToMany
    {
        return $this->belongsToMany(GalleryItem::class);
    }

    /**
     * Get the user that owns the Gallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
