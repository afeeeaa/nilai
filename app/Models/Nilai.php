<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    use HasFactory;
    protected $fillable =['no_reg', 'email', 'nama', 'dokumen', 'original_filename', 'resultI', 'resultE','resultS', 'resultN','resultT','resultF', 'resultJ', 'resultP', 'result1', 'result2', 'result3', 'result4'];
    protected $table = 'nilai';
    public $timestamps = false;
}
