<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id', 'payment_method_id', 'reference', 'amount', 'currency', 'status', 'paid_at', 'notes'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_payment')
            ->withPivot('amount_applied')
            ->withTimestamps();
    }
}
