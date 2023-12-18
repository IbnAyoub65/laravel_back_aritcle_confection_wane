<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unite extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopebyLibelle($query,string $libelle){

        return $query->whereRaw('LOWER(TRIM(libelle))= ?',[Str::lower(trim($libelle))]);
    }
}
