<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
    
    protected $table = 'layanan';
    
    protected $fillable = ['id_layanan','nama_layanan','harga_layanan','tanggal_tambah_layanan','tanggal_ubah_layanan','user_layanan_log'];
    protected $primaryKey = 'id_layanan';
    const CREATED_AT = 'tanggal_tambah_layanan_log';
    const UPDATED_AT = 'tanggal_ubah_layanan_log';
    use SoftDeletes;
    const DELETED_AT = 'tanggal_hapus_layanan_log';
}
