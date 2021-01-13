<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    protected $table = 'supplier';
    
    protected $fillable = ['nama_supplier','alamat_supplier','telepon_supplier','tanggal_tambah_supplier','tanggal_ubah_supplier','user_supplier_log'];
    protected $primaryKey = 'id_supplier';
    const CREATED_AT = 'tanggal_tambah_supplier_log';
    const UPDATED_AT = 'tanggal_ubah_supplier_log';
    use SoftDeletes;
    const DELETED_AT = 'tanggal_hapus_supplier_log';

    protected function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class);
    }
}
