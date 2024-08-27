<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomPermission;

class Module extends Model
{
    // Opcional: si el nombre de la tabla es diferente a 'modules', debes definirlo
    protected $table = 'modules';

    // Relación uno a muchos
    public function permissions()
    {
        return $this->hasMany(CustomPermission::class, 'module_id');
    }
}