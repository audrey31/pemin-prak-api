<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'nama'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var string[]
   */
  protected $hidden = [];

  protected $table = 'matakuliahs';

  public function Mahasiswa() {
    return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah', 'mhsNim', 'mkId');
  }
}