<?php

namespace App\Models\OTransaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerimaDetail extends Model
{
    use HasFactory;

    protected $table = 'terimad';
    protected $primaryKey = 'NO_ID';
    public $timestamps = false;

    protected $fillable =
    [
        "REC", "NO_BUKTI", "ID", "GOL", "PER", "FLAG", "QTYA", "BENDELA", "IKATA", "QTYB", "BENDELB",
        "IKATB"
    ];
}
