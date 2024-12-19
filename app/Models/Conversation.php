<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Conversation extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'conversation_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'wa_conversation_id',
        'expiration_timestamp',
        'origin',
        'pricing_model',
        'billable',
        'category',
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
        return $this->hasMany(Message::class, 'conversation_id');
    }
}
