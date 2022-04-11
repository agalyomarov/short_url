<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'urls';
    protected $primaryKey = 'hash';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
