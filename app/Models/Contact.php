<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'contact_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'wa_id',
        'country_code',
        'phone_number',
        'contact_name',
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'prefix',
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

    public function messages()
    {
        return $this->hasMany(Message::class, 'contact_id');
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class, 'contact_id')->orderBy('created_at', 'desc');
    }

    public function unreadMessagesCountByContact()
    {
        return $this->messages()->whereNull('readed_at')->where('message_method', 'INPUT')->count();
    }
}
