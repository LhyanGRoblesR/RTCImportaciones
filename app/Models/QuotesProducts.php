<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotesProducts extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 't_quotes_products';
    protected $primaryKey = 'id_quotes_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_quotes', 'id_products', 'quantity','total_price','id_users_created','id_users_modified','timestamp_created','timestamp_modified'
    ];
}
