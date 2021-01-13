<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksiProduk extends Model
{
    protected $table = 'detail_transaksi_produk';
    protected $fillable = ['id_detail_produk','id_transaksi_produk','id_produk','jumlah_detail_produk','subtotal_detail_produk'];
    protected $primaryKey = 'id_detail_produk';
    const CREATED_AT = 'tanggal_tambah_detail_transaksi_produk_log';
    const UPDATED_AT = 'tanggal_ubah_detail_transaksi_produk_log';
    public function transaksi_produk()
    {
        return $this->belongsTo(TransaksiProduk::class, 'id_transaksi_produk');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
