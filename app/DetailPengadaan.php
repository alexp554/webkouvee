<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPengadaan extends Model
{
    protected $table = 'detail_pengadaan';
    protected $fillable = ['id_detail_pengadaan','id_pengadaan','id_produk','jumlah_detail_pengadaan','subtotal_detail_pengadaan'];
    protected $primaryKey = 'id_detail_pengadaan';
    const CREATED_AT = 'tanggal_tambah_detail_pengadaan_log';
    const UPDATED_AT = 'tanggal_ubah_detail_pengadaan_log';
    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'id_pengadaan');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
