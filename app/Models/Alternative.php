<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function matrix()
    {
        return $this->belongsTo(Matrix::class);
    }

    public function decision()
    {
        return $this->belongsTo(Decision::class);
    }
}
