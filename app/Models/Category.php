<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_id'
    ];

    # Parent
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    # Childs
    public function childs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    # Product
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_category', 'product_id', 'category_id');
    }
}
