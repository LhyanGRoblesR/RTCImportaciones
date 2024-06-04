<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 't_blog';
    protected $primaryKey = 'id_blog';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'blog', 'description', 'photo_url', 'id_users_created', 'id_users_modified','timestamp_created','timestamp_modified'
    ];
}
