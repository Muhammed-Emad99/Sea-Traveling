<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'trips_count', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contract) {
            $latestContract = Contract::latest()->first();
            $contract->contract_number = $latestContract ? ++$latestContract->contract_number : 1;
        });
    }
}
