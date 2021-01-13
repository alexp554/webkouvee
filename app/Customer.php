<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = ['id_customer','nama_customer','alamat_customer','tgl_lahir_customer','telepon_customer','tanggal_tambah_customer_log','tanggal_ubah_customer_log','user_customer_log'];
    protected $primaryKey = 'id_customer';
    const CREATED_AT = 'tanggal_tambah_customer_log';
    const UPDATED_AT = 'tanggal_ubah_customer_log';
    use SoftDeletes;
    const DELETED_AT = 'tanggal_hapus_customer_log';
    protected function hewan()
    {
        return $this->hasMany(Hewan::class);
    }
    protected function transaksi_produk()
    {
        return $this->hasMany(TransaksiProduk::class);
    }
}
