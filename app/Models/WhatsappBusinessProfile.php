<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WhatsappBusinessProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'whatsapp_business_profile_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'profile_picture_url',
        'about',
        'address',
        'description',
        'email',
        'vertical',
        'messaging_product',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
                // $model->{$model->getKeyName()} = 'prof_' . Str::uuid()->toString();
            }
        });
    }

    public function websites()
    {
        return $this->hasMany(Website::class, 'whatsapp_business_profile_id');
    }

    public function phoneNumber()
    {
        return $this->hasOne(WhatsappPhoneNumber::class, 'whatsapp_business_profile_id');
    }
}
