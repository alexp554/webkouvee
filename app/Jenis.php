<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenis extends Model
{
    
    protected $table = 'jenis';
    
    protected $fillable = ['id_jenis','nama_jenis','tanggal_tambah_jenis','tanggal_ubah_jenis','user_jenis_log'];

    protected function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }
    protected $primaryKey = 'id_jenis';
    const CREATED_AT = 'tanggal_tambah_jenis_log';
    const UPDATED_AT = 'tanggal_ubah_jenis_log';
    use SoftDeletes;
    const DELETED_AT = 'tanggal_hapus_jenis_log';
}
