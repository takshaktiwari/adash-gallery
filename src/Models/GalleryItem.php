<?php

namespace Takshak\Agallery\Models;

use Database\Factories\GalleryItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Takshak\Adash\Traits\Models\CommonModelTrait;

class GalleryItem extends Model
{
    use HasFactory, CommonModelTrait;
    protected $guarded = [];

    protected static function newFactory()
    {
        return GalleryItemFactory::new();
    }

    /**
     * The galleries that belong to the GalleryItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function galleries(): BelongsToMany
    {
        return $this->belongsToMany(Gallery::class);
    }
}
