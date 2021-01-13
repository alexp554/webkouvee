<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiLayanan extends Model
{
    protected $table = 'transaksi_layanan';
    
    protected $fillable = ['id_transaksi_layanan','kode_transaksi_layanan','id_hewan','total_transaksi_layanan','status_transaksi_layanan','tanggal_transaksi_layanan','tanggal_tambah_transaksi_log','tanggal_ubah_transaksi_log','tanggal_hapus_transaksi_log','user_transaksi_add','user_transaksi_edit','user_transaksi_delete'];
    
    protected $primaryKey = 'id_transaksi_layanan';
    const CREATED_AT = 'tanggal_tambah_transaksi_log';
    const UPDATED_AT = 'tanggal_ubah_transaksi_log';
    use SoftDeletes;
    const DELETED_AT = 'tanggal_hapus_transaksi_log';
    
    public function detail_transaksi_layanan()
    {
        return $this->hasMany(DetailTransaksiLayanan::class);
    }

    public function hewan()
    {
        return $this->belongsTo(Hewan::class, 'id_hewan');
    }
}
