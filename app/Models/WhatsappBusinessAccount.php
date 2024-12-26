<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhatsappBusinessAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'whatsapp_business_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'whatsapp_business_id',
        'api_token',
        'webhook_token',
    ];

    public function phoneNumbers()
    {
        return $this->hasMany(WhatsappPhoneNumber::class, 'whatsapp_business_accounts_id');
    }

    public function templates()
    {
        return $this->hasMany(Template::class, 'whatsapp_business_id');
    }
}
