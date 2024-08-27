<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Database\Eloquent\Model;

class CustomPermission extends SpatiePermission
{
    use HasFactory;

    protected $fillable = ['name', 'modules_id', 'guard_name'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
