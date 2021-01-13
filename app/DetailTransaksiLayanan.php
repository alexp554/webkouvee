<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksiLayanan extends Model
{
    protected $table = 'detail_transaksi_layanan';
    protected $fillable = ['id_detail_layanan','id_transaksi_layanan','id_layanan','status_layanan','jumlah_detail_layanan','subtotal_detail_layanan'];
    protected $primaryKey = 'id_detail_layanan';
    const CREATED_AT = 'tanggal_tambah_detail_transaksi_layanan_log';
    const UPDATED_AT = 'tanggal_ubah_detail_transaksi_layanan_log';
    public function transaksi_layanan()
    {
        return $this->belongsTo(TransaksiLayanan::class, 'id_transaksi_layanan');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }
}
