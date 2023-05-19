<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingList extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tipeKamars()
    {
        return $this->belongsTo(TipeKamar::class, 'tipe_kamar_id');
    }

    public function barangKamars()
    {
        return $this->belongsToMany(BarangKamar::class, 'tipe_kamars_barang_kamars', 'tipe_kamar_id', 'barang_kamar_id');
    }
}
