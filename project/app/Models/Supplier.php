<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
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
        'state',
        'payment_terms',
        'bank_details',
        'opening_balance',
        'status',
    ];

    protected $casts = [
        'opening_balance' => 'decimal:2',
    ];

    /**
     * All inward purchases from this distributor.
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Lifetime purchases sum from this vendor.
     */
    public function totalPurchases(): float
    {
        return (float) $this->purchases()->sum('grand_total');
    }

    /**
     * Total pending payables to this vendor.
     */
    public function outstandingBalance(): float
    {
        return (float) $this->purchases()->sum('balance_amount');
    }
}
