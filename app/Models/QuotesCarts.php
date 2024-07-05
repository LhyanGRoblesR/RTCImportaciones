<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotesCarts extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 't_quotes_carts';
    protected $primaryKey = 'id_quotes_carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_users', 'id_products', 'quantity'
    ];
}
