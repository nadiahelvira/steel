<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VbrgDetail extends Model
{
    use HasFactory;

    protected $table = 'vbrgdx';
    protected $primaryKey = 'NO_ID';
    public $timestamps = false;

    protected $fillable =
    [
        "ID", "KD_BRG", "RING", "HARGA", "HARGA2", "HARGA3", "HARGA4", "HARGA5", "REC", "HARGA6", "HARGA7"
    ];
}
