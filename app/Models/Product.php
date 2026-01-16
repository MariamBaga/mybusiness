<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'partner_id',
        'category_id',
        'name',
        'price',
        'old_price',
        'stock',
        'sku',
        'image',
        'short_description',
        'description',
        'specifications',
        'weight',
        'dimensions',
        'is_featured',
        'is_sponsored',
        'status',
        'partner_product_url',
        'partner_contact_email',
        'redirect_to_partner'
    ];

    protected $casts = [
        'specifications' => 'array',
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'stock' => 'integer',
        'is_featured' => 'boolean',
        'is_sponsored' => 'boolean',
        'status' => 'boolean'
    ];

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        // Générer automatiquement le slug lors de la création
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);

                // Vérifier l'unicité
                $originalSlug = $product->slug;
                $counter = 1;
                while (Product::where('slug', $product->slug)->exists()) {
                    $product->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });

        // Mettre à jour le slug lors de la modification si le nom change
        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);

                // Vérifier l'unicité
                $originalSlug = $product->slug;
                $counter = 1;
                while (Product::where('slug', $product->slug)
                    ->where('id', '!=', $product->id)
                    ->exists()) {
                    $product->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the full image URL
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('StockPiece/products/' . $this->image);
        }
        return asset('adminlte/dist/img/default-product.png');
    }

    /**
     * Get the route key for the model (for pretty URLs)
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
