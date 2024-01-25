<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_reg',
        'email',
        'nama',
        'dokumen',
        'original_filename',
        'average_score_i',
        'average_score_e',
        'average_score_s',
        'average_score_n',
        'average_score_t',
        'average_score_f',
        'average_score_j',
        'average_score_p',
        'result_1',
        'result_2',
        'result_3',
        'result_4'
    ];
    protected $table = 'nilai';
    public $timestamps = false;
}
