<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengadaan extends Model
{
    protected $table = 'pengadaan';
    protected $fillable = ['id_pengadaan','id_supplier','kode_pengadaan','tanggal_pengadaan','status_pengadaan','total_pengadaan','tanggal_tambah_pengadaan_log','tanggal_ubah_pengadaan_log','user_pengadaan_log'];
    protected $primaryKey = 'id_pengadaan';
    const CREATED_AT = 'tanggal_tambah_pengadaan_log';
    const UPDATED_AT = 'tanggal_ubah_pengadaan_log';
    use SoftDeletes;
    const DELETED_AT = 'tanggal_hapus_pengadaan_log';

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    protected function detail_pengadaan()
    {
        return $this->hasMany(DetailPengadaan::class);
    }
}
