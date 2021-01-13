<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ukuran extends Model
{
    
    protected $table = 'ukuran';
    
    protected $fillable = ['id_ukuran','nama_ukuran','tanggal_tambah_ukuran','tanggal_ubah_ukuran','user_ukuran_log'];
    
    protected $primaryKey = 'id_ukuran';
    const CREATED_AT = 'tanggal_tambah_ukuran_log';
    const UPDATED_AT = 'tanggal_ubah_ukuran_log';
    use SoftDeletes;
    const DELETED_AT = 'tanggal_hapus_ukuran_log';
    
    protected function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }
}
