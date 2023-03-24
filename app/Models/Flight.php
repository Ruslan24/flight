<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transporter_id',
        'flight_number',
        'departure_airport',
        'arrival_airport',
        'departure_date_time',
        'arrival_date_time',
        'duration',
    ];

    /**
     * Get transporter for the variable.
     *
     * @return BelongsTo
     */
    public function transporter(): BelongsTo
    {
        return $this->belongsTo(Transporter::class);
    }
}
