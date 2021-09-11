<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffWork extends Model
{
    use HasFactory;

    
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'employee_id',
        'description',
        'date_start',
        'date_end',
        'accepted_at',
        'accepted_by',
    ];

    /**
     * Get the employe that owns the OffWork
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
