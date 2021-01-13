<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiProduk extends Model
{
    protected $table = 'transaksi_produk';
    
    protected $fillable = ['id_transaksi_produk','kode_transaksi_produk','id_customer','total_transaksi_produk','status_transaksi_produk','tanggal_transaksi_produk','tanggal_tambah_transaksi_log','tanggal_ubah_transaksi_log','tanggal_hapus_transaksi_log','user_transaksi_produk_log'];
    
    protected $primaryKey = 'id_transaksi_produk';
    const CREATED_AT = 'tanggal_tambah_transaksi_log';
    const UPDATED_AT = 'tanggal_ubah_transaksi_log';
    use SoftDeletes;
    const DELETED_AT = 'tanggal_hapus_transaksi_log';
    
    public function detail_transaksi_produk()
    {
        return $this->hasMany(DetailTransaksiProduk::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
