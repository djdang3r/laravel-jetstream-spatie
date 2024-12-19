<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'template_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'whatsapp_business_id',
        'wa_template_id',
        'name',
        'language',
        'category',
        'json',
    ];

    public function businessAccount()
    {
        return $this->belongsTo(WhatsappBusinessAccount::class, 'whatsapp_business_id');
    }
}
