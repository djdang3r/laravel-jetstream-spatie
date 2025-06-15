<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'price_monthly', 'price_yearly', 'max_accounts', 'max_numbers',
        'max_bots', 'max_flows_per_bot', 'max_messages_included', 'additional_message_price',
        'allow_massive_sending', 'allow_api_integrations', 'support_level'
    ];

    public function features()
    {
        return $this->hasMany(PlanFeature::class);
    }
}
