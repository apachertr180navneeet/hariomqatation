<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'phone',
        'email',
        'gstin',
        'address',
        'city',
        'type',
        'status',
        'notes',
    ];

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class)->latest();
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class, 'customer_phone', 'phone')->latest();
    }

    public function totalPurchases(): float
    {
        return (float) $this->invoices()->where('status', 'Issued')->sum('grand_total');
    }

    public function pendingBalance(): float
    {
        return (float) $this->invoices()->where('status', 'Issued')->sum('balance_amount');
    }

    public function totalInvoicesCount(): int
    {
        return $this->invoices()->count();
    }
}
