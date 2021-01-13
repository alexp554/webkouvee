<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $fillable = ['id_role','nama_role'];
    protected $primaryKey = 'id_role';
    protected function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
