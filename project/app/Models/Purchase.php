<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_no',
        'supplier_id',
        'supplier_invoice_no',
        'purchase_date',
        'due_date',
        'payment_status',
        'status',
        'subtotal',
        'discount_total',
        'taxable_amount',
        'cgst_amount',
        'sgst_amount',
        'gst_total',
        'grand_total',
        'paid_amount',
        'balance_amount',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'discount_total' => 'decimal:2',
        'taxable_amount' => 'decimal:2',
        'cgst_amount' => 'decimal:2',
        'sgst_amount' => 'decimal:2',
        'gst_total' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance_amount' => 'decimal:2',
    ];

    /**
     * Line items in this purchase bill.
     */
    public function items(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }

    /**
     * Supplier distributor for this invoice.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Staff/Admin who recorded this inward entry.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Generate sequential purchase number format: HOC/PUR/YYYY/NNNN
     */
    public static function generateNextPurchaseNumber(): string
    {
        $year = date('Y');
        $prefix = "HOC/PUR/{$year}/";

        $latest = self::where('purchase_no', 'like', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        if ($latest && preg_match('/(\d+)$/', $latest->purchase_no, $matches)) {
            $nextSeq = str_pad((int) $matches[1] + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextSeq = '0001';
        }

        return "{$prefix}{$nextSeq}";
    }
}
