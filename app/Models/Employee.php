<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'off_work_total',
        'user_id',
    ];



    /**
     * Get all of the offWork for the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offWork()
    {
        return $this->hasMany(OffWork::class);
    }


    /**
     * Get the user that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
