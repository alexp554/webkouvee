<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $fillable = ['nama_pegawai','id_role','alamat_pegawai','tanggal_lahir_pegawai','nomor_telepon_pegawai'];
    protected $primaryKey = 'id_pegawai';
    const CREATED_AT = 'tanggal_tambah_pegawai_log';
    const UPDATED_AT = 'tanggal_ubah_pegawai_log';
    use SoftDeletes;
    const DELETED_AT = 'tanggal_hapus_pegawai_log';
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }
}
