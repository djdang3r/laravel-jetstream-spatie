<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Website extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'website_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'whatsapp_business_profile_id',
        'website',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
                // $model->{$model->getKeyName()} = 'web_' . Str::uuid()->toString();
            }
        });
    }

    public function businessProfile()
    {
        return $this->belongsTo(WhatsappBusinessProfile::class, 'whatsapp_business_profile_id');
    }
}
