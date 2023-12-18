<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function unites(){
        return $this->belongsToMany(Unite::class,'categories_unites')
        ->withPivot('etat','conversion');
    }

    public static function booted(){
        static::created(function(Categorie $categorie){
            $unite = Unite::byLibelle(request()->unite)->first();
            if(!$unite){
                $unite= Unite::create([
                    "libelle"=>request()->unite
                ]);
            }
            $categorie->unites()->attach([
                $unite->id=>[
                    "etat"=>1,
                    "conversion"=>1
                ]
            ]);
        });
    }
}
