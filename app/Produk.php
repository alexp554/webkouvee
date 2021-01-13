<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    protected $table = 'produk';
    
    protected $fillable = ['id_produk','nama_produk','satuan_produk','stok_produk','stok_min_produk','harga_produk','image_path','tanggal_tambah_produk','tanggal_ubah_produk','user_produk_log'];
    protected $primaryKey = 'id_produk';
    const CREATED_AT = 'tanggal_tambah_produk_log';
    const UPDATED_AT = 'tanggal_ubah_produk_log';
    use SoftDeletes;
    const DELETED_AT = 'tanggal_hapus_produk_log';

    protected function detail_pengadaan()
    {
        return $this->hasMany(DetailPengadaan::class);
    }
    
    protected function detail_transaksi_produk()
    {
        return $this->hasMany(DetailTransaksiProduk::class);
    }
}
