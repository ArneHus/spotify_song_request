<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zaak extends Model
{
    use HasFactory;
    protected $table = 'zaken';
    public $timestamps = false;
}
