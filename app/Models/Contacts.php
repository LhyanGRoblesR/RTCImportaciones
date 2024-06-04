<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 't_contacts';
    protected $primaryKey = 'id_contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_users', 'messages', 'timestamp_created','timestamp_modified'
    ];
}
