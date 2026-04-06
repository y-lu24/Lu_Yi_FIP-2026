<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Style extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the portfolio images for this style.
     *
     * @return BelongsToMany
     */
    public function portfolioImages(): BelongsToMany
    {
        return $this->belongsToMany(PortfolioImage::class, 'portfolio_image_style');
    }
}