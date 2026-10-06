<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'quotation_id',
        'customer_id',
        'customer_name',
        'customer_company',
        'customer_phone',
        'customer_email',
        'customer_gstin',
        'customer_address',
        'invoice_date',
        'due_date',
        'payment_mode',
        'payment_status',
        'status',
        'subtotal',
        'discount_total',
        'taxable_amount',
        'cgst_amount',
        'sgst_amount',
        'gst_total',
        'round_off',
        'grand_total',
        'paid_amount',
        'balance_amount',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'discount_total' => 'decimal:2',
        'taxable_amount' => 'decimal:2',
        'cgst_amount' => 'decimal:2',
        'sgst_amount' => 'decimal:2',
        'gst_total' => 'decimal:2',
        'round_off' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance_amount' => 'decimal:2',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function generateNextInvoiceNumber(): string
    {
        $year = date('Y');
        $prefix = "HOC/INV/{$year}/";
        $last = static::where('invoice_no', 'like', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        $nextSeq = 1;
        if ($last) {
            $parts = explode('/', $last->invoice_no);
            $lastNum = (int) end($parts);
            $nextSeq = $lastNum + 1;
        }

        return sprintf('%s%04d', $prefix, $nextSeq);
    }
}
