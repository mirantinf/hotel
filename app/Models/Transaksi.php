<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'transaksi';
    protected $fillable = [
        'no_transaksi',
        'id_menu',
        'qty',
        'no_kamar',
        'nama_customer',
        'total_harga',
        'status'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class, 'id_menu', 'id');
    }
}
