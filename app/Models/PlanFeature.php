<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanFeature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['plan_id', 'key', 'value'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
