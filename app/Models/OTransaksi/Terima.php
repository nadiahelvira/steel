<?php

namespace App\Models\OTransaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//ganti 1
class Terima extends Model
{
    use HasFactory;

// ganti 2
    protected $table = 'terima';
    protected $primaryKey = 'NO_ID';
    public $timestamps = false;

//ganti 3
    protected $fillable = 
    [
        "NO_BUKTI","TGL", "NO_BELI", "FLAG", "GOL", "PER","KODES", "NAMAS", "TOTAL_QTY", "TOTAL", "NOTES",
		"USRNM", "TG_SMP", "ALAMAT", "KOTA", "KD_BRG", "NA_BRG", "NO_PO", "QTY_BELI", "GOL", "PKP", "CBG",
        "NO_MUAT", "NO_CONT", "SOPIR", "NOPOL", "SEAL", "QTY_MUAT", "TOTAL_QTYA", "TOTAL_BENDELA", "TOTAL_IKATA",
        "TOTAL_QTYB", "TOTAL_BENDELB", "TOTAL_IKATB", "S01", "S02", "S03", "S04", "S05",
        "S06", "S07". "S08", "S09", "S10"
    ];
}
