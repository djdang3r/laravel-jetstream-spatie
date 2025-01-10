<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WhatsappPhoneNumber extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'whatsapp_phone_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'whatsapp_business_accounts_id',
        'whatsapp_business_profile_id',
        'whatsapp_bot_id',
        'display_phone_number',
        'phone_number_id',
        'verified_name',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
                // $model->{$model->getKeyName()} = 'phone_' . Str::uuid()->toString();
            }
        });
    }

    public function bot()
    {
        return $this->belongsTo(WhatsappBot::class, 'whatsapp_bot_id', 'whatsapp_bot_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'whatsapp_phone_id');
    }

    public function businessAccount()
    {
        return $this->belongsTo(WhatsappBusinessAccount::class, 'whatsapp_business_accounts_id');
    }

    public function businessProfile()
    {
        return $this->belongsTo(WhatsappBusinessProfile::class, 'whatsapp_business_profile_id');
    }
}
