<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 't_quotes';
    protected $primaryKey = 'id_quotes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_users', 'brute_price', 'igv','total_price','custom_price','id_quotes_statuses','id_users_created','id_users_modified','timestamp_created','timestamp_modified'
    ];
}
