<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;
    protected $fillable = [
        'kapal',
        'etd',
        'eta',
        'shipper',
        'penerima',
        'no_container',
        'ukuran',
        'lokasi_bongkar',
        'tgl_muat',
        'tgl_bongkar'
    ];
}
