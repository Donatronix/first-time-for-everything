<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spiritix\LadaCache\Database\LadaCacheTrait;

class Address extends Model
{
    use HasFactory;
    use LadaCacheTrait;

    protected $fillable = [
        'street',
        'town',
        'state',
        'country',
        'user_id',
    ];

    protected $table = 'addresses';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
