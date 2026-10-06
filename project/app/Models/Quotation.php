<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_no',
        'customer_name',
        'customer_company',
        'customer_phone',
        'customer_email',
        'customer_gstin',
        'customer_address',
        'quotation_date',
        'valid_until',
        'status',
        'subtotal',
        'discount_total',
        'taxable_amount',
        'gst_total',
        'round_off',
        'grand_total',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'quotation_date' => 'date',
        'valid_until' => 'date',
        'subtotal' => 'decimal:2',
        'discount_total' => 'decimal:2',
        'taxable_amount' => 'decimal:2',
        'gst_total' => 'decimal:2',
        'round_off' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    /**
     * Line items within this quotation.
     */
    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }

    /**
     * Associated tax invoice if converted.
     */
    public function invoice(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * User who generated this quotation.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Automatically generate the next sequential quotation number: HOC/QTN/YYYY/XXXX.
     */
    public static function generateNextQuotationNumber(): string
    {
        $year = date('Y');
        $prefix = "HOC/QTN/{$year}/";
        
        $latest = self::where('quotation_no', 'LIKE', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        if ($latest && preg_match('/(\d+)$/', $latest->quotation_no, $matches)) {
            $nextSeq = intval($matches[1]) + 1;
        } else {
            $nextSeq = 1;
        }

        return $prefix . str_pad($nextSeq, 4, '0', STR_PAD_LEFT);
    }
}
