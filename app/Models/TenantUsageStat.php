<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantUsageStat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id', 'whatsapp_accounts_used', 'phone_numbers_used', 'bots_created',
        'flows_created', 'messages_sent_month', 'api_requests_this_month', 'last_updated'
    ];

    protected $casts = [
        'last_updated' => 'datetime',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
