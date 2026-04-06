<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'bio',
        'profile_image_url',
        'specialty_styles',
        'instagram_handle',
        'is_active',
    ];

    /**
     * Get the portfolio images for this artist.
     *
     * @return HasMany
     */
    public function portfolioImages(): HasMany
    {
        return $this->hasMany(PortfolioImage::class);
    }

    /**
     * Get the consultations that prefer this artist.
     *
     * @return HasMany
     */
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class, 'artist_preference_id');
    }
}