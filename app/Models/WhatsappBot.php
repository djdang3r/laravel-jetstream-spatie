<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WhatsappBot extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'whatsapp_bot_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'bot_name',
        'port',
        'url',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function phoneNumbers()
    {
        return $this->hasMany(WhatsappPhoneNumber::class, 'whatsapp_bot_id', 'whatsapp_bot_id');
    }

    public static function getBotsConfig()
    {
        return self::with('phoneNumbers.businessAccount')->get()->map(function ($bot) {
            return [
                'flows' => ['dxFlow', 'welcomeFlow', 'registerFlow', 'fullSamplesFlow'],
                'jwtToken' => $bot->phoneNumbers->first()->businessAccount->api_token,
                'numberId' => $bot->phoneNumbers->first()->phone_number_id,
                'verifyToken' => env('WHATSAPP_VERIFY_TOKEN'),
                'version' => env('WHATSAPP_API_VERSION'),
                'dbHost' => env('DB_HOST'),
                'dbUser' => env('DB_USERNAME'),
                'dbName' => env('DB_DATABASE'),
                'dbPassword' => env('DB_PASSWORD'),
                'port' => $bot->port,
            ];
        })->toArray();
    }
}
