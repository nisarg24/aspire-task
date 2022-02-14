<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'code',
        'amount',
        'term',
        'is_month',
        'is_approved',
        'is_emi_completed',
        'start_date',
        'end_date'
    ];

    public function emis()
    {
        return $this->hasMany(\App\Models\Emi::class, 'loan_id');
    }
}
