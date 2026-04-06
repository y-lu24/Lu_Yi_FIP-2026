<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PortfolioImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'artist_id',
        'image_url',
        'title',
        'description',
        'completion_date',
    ];

    /**
     * Get the artist that owns this portfolio image.
     *
     * @return BelongsTo
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Get the styles for this portfolio image.
     *
     * @return BelongsToMany
     */
    public function styles(): BelongsToMany
    {
        return $this->belongsToMany(Style::class, 'portfolio_image_style');
    }
}