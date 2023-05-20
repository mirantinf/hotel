<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'menu';
    protected $fillable = [
        'nama_menu',
        'harga_menu',
        'gambar_menu',
        'stok',
        'kategori',
        'deskripsi'
    ];

    public function transaksi(){
        return $this->hasMany(Transaksi::class, 'id_menu', 'id');
    }
}
