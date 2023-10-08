<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller

{
    // **show
    public function index()
    {
        $materials = Material::all();
        $materialcount =Material::count();
        $types = ["camera", "light", "casque", "micro", "autres"];
        return view("Backend.pages.material", compact("materials", "types","materialcount"));
    }
    // **create
    public function store(Request $request)
    {
        request()->validate([
            "name" => ["required"],
            "quantite" => ["required"],
            "type" => ["required"],
            "image" => "required|image|mimes:png,jpg,jpeg,gif|max:2048",
            // "nombre_utilisation" => ["required"],
            "disponible" => ["required"],
        ]);

        $request->file("image")->storePublicly('img/material', 'public');

        $data = [
            "name" => $request->name,
            "reference"  => $request->reference,
            "type" => $request->type,
            "quantite"  => $request->quantite,
            "image" => $request->file("image")->hashName(),
            "nombre_utilisation" => 0,
            "disponible" => $request->disponible,
        ];

        Material::create($data);
        return redirect()->back()->with("success", "ton Material a été créer");
    }
    // **update

    public function update(Request $request, Material $material)
    {
        request()->validate([
            "name" => ["required"],
            "quantite" => ["required"],
            "type" => ["required"],
            "image" => "image|mimes:png,jpg,jpeg,gif|max:2048",
            // "nombre_utilisation" => ["required"],
            "disponible" => ["required"],
        ]);

        $data = [
            "name" => $request->name,
            "reference"  => $request->reference,
            "type" => $request->type,
            "quantite"  => $request->quantite,
            // "nombre_utilisation" => $request->nombre_utilisation,
            "disponible" => $request->disponible,
        ];

        //^Check if quantite is 0, and set "disponible" to 'non disponible'
        if ($request->quantite == 0) {
            $data['disponible'] = false;
        }

        if ($request->file('image') != null) {
            //!Delete the old image from storage
            Storage::disk("public")->delete('img/' . $material->image);
            //!Update the image
            $request->file("image")->storePublicly('img/material/', 'public');
            $data['image'] = $request->file("image")->hashName();
        }

        $material->update($data);

        return redirect()->back()->with("success", "Ton Material a été modifié");
    }

    // ** delete

    public function destroy(Material $material)
    {
        Storage::disk("public")->delete('img/material/' . $material->image);
        $material->delete();
        return redirect()->back()->with("warning", "Vous avez supprimé un material");
    }
}
