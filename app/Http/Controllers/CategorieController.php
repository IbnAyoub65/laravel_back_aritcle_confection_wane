<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoieRequestStore;
use App\Http\Resources\CategorieCollection;
use App\Http\Resources\CategorieResource;
use App\Models\Unite;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use Symfony\Component\HttpFoundation\Response;

class CategorieController extends Controller
{
    //index ==> all categoie + pagination
    public function all(Request $request){
        $query= $request->input('limit')??3;
        return new CategorieCollection(Categorie::paginate($query));

    }
    //add ==> add cateorie + unite
    public function store(CategoieRequestStore $request){
        $validated= $request->validated();
        return DB::transaction(function() use($validated) {
        $categorie = Categorie::create([
         "libelle"=>$validated["libelle"]
        ]);
        return response()->json([
             "data"=>CategorieResource::make($categorie),
             "succes"=>true,
             "message"=>"categorie a été ajouté avec succes",

         ]);

     });

     }
    //delete ==> supprimer categorie
    public function delete(Categorie $categorie){
       // Categorie::whereIn("id",$request->categories->delete($id));
       $categorie->delete();
       return response()->json([
        "status_code"=>"suppression reuissie"
       ]);
    }
    //update ==> add categorie + unite


    public function update( Request $request,Categorie $categorie){

       return DB::transaction(function() use($categorie,$request){
            $categorie->update([
                "libelle"=>$request->libelle
            ]);

            $unite= Unite::byLibelle(request()->unite)->first();
            if(!$unite){
                $unite=Unite::create([
                    "libelle"=>request()->unite
                ]);
            }
            $categorie->unites()->sync([
                $unite->id=>[
                    "etat"=>1,
                    "conversion"=>1
                ]
            ]);
            return response()->json([
                "data"=>CategorieResource::make($categorie),
                "succes"=>true,
                "message"=>"categorie modifié avec succes"
            ]);

        });

    }

    public function byLibelle(){

    }
}
