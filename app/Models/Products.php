<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 't_products';
    protected $primaryKey = 'id_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product', 'description', 'photo_url','price','id_categories',
        'active','id_users_created','id_users_modified','timestamp_created','timestamp_modified'
    ];

}
