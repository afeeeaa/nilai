<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    use HasFactory;
    protected $fillable =['no_reg', 'email', 'nama', 'dokumen', 'original_filename'];
    protected $table = 'nilai';
    public $timestamps = false;
}
