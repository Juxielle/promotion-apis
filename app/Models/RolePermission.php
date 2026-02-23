<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = [
        EntityField::PROPORTION,
        EntityField::ROLE_ID,
        EntityField::PERMISSION_ID,
    ];
}
