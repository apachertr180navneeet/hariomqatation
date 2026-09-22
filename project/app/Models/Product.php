<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'barcode',
        'category_id',
        'subcategory_id',
        'brand_id',
        'model',
        'specs',
        'description',
        'purchase_price',
        'selling_price',
        'mrp',
        'gst_rate',
        'stock',
        'min_stock',
        'warranty',
        'status',
        'rating',
        'image',
        'is_featured',
        'socket',
        'ram_type',
        'wattage_req',
        'wattage',
        'pcb_type',
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'mrp' => 'decimal:2',
        'gst_rate' => 'decimal:2',
        'stock' => 'integer',
        'min_stock' => 'integer',
        'rating' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $baseSlug = Str::slug($product->name);
                $product->slug = $baseSlug . '-' . Str::lower(Str::random(4));
            }
            if (empty($product->sku)) {
                $product->sku = 'HOC-' . strtoupper(Str::random(6));
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class)->latest();
    }

    public function isLowStock(): bool
    {
        return $this->stock <= $this->min_stock;
    }

    public function isOutOfStock(): bool
    {
        return $this->stock <= 0;
    }

    public function formattedSellingPrice(): string
    {
        return '₹' . number_format($this->selling_price, 2);
    }

    public function formattedPurchasePrice(): string
    {
        return '₹' . number_format($this->purchase_price, 2);
    }

    public function formattedMrp(): string
    {
        return $this->mrp ? '₹' . number_format($this->mrp, 2) : '-';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeLaptops($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('name', 'Laptops')->orWhere('slug', 'laptops');
        });
    }

    public function scopeComputers($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('name', 'Desktop Computers')
              ->orWhere('slug', 'desktop-computers')
              ->orWhere('slug', 'computers');
        });
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock', '<=', 'min_stock');
    }
}
