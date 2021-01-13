<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hewan extends Model
{
    
    protected $table = 'hewan';
    
    protected $fillable = ['id_hewan','id_jenis','id_ukuran','id_customer','nama_hewan','tanggal_lahir_hewan','tanggal_tambah_hewan','tanggal_ubah_hewan','user_hewan_log'];
    
    protected $primaryKey = 'id_hewan';
    const CREATED_AT = 'tanggal_tambah_hewan_log';
    const UPDATED_AT = 'tanggal_ubah_hewan_log';
    use SoftDeletes;
    const DELETED_AT = 'tanggal_hapus_hewan_log';
    
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }

    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class, 'id_ukuran');
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function transaksi_layanan()
    {
        return $this->belongsTo(TransaksiLayanan::class, 'id_hewan');
    }
}
