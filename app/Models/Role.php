<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    
    public const SUPERADMIN = 1;
    public const STAFFHR = 2;
    public const KARYAWAN = 3;
}
