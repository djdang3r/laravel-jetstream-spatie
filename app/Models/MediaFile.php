<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MediaFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'media_file_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'message_id',
        'media_type',
        'file_name',
        'mime_type',
        'sha256',
        'url',
        'media_id',
        'file_size',
        'animated',
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

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id');
    }
}
