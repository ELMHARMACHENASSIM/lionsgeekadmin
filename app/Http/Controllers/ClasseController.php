<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ImageClass;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClasseController extends Controller
{

    public function index()
    {
        $classes = Classe::all();
        $studios = Studio::all();
        $images = ImageClass::all();
        return view("Backend.pages.classshow", compact('classes', 'studios', 'images'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'images.*' => 'required|image|mimes:png,jpg,svg,jpeg,jfif|min:0'
        ]);
        $srcimages = $request->file("images");
        $dataClass = [
            'name' => $request->name,
            'disponible' => true,
            'nombre_utilisation' => 0,
        ];
        $classe = Classe::create($dataClass);
        // dd("fuuuuuuk");

        foreach ($srcimages as $image) {
            $imageName = 'class_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('img/classe/', $imageName, 'public');

            $dataImg = [
                "classe_id" => $classe->id,
                'images' => $imageName,
            ];

            ImageClass::create($dataImg);
        }

        return redirect()->back();
    }

    public function addImages(Request $request, Classe $classe)
    {
        request()->validate([
            'images.*' => 'required|image|mimes:png,jpg,svg,jpeg,jfif|min:0'
        ]);
        $srcimages = $request->file("images");

        // dd("ghj");
        if($srcimages){

            foreach ($srcimages as $image) {
                $imageName = 'class_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('img/classe/', $imageName, 'public');
    
                $dataImg = [
                    'classe_id' => $classe->id,
                    'images' => $imageName,
                ];
    
                ImageClass::create($dataImg);
            }
        }

        return redirect()->route("class.index")->with('success', 'images added successfully');
    }
    public function update(Request $request, Classe $classe)
    {
        $request->validate([
            "name" => ["required"],
            "disponible" => ["required"] // Add a validation rule for "disponible"
        ]);

        $dataClass = [
            "name" => $request->name,
            "disponible" => $request->disponible
        ];

        $classe->update($dataClass);

        // *Redirect with a success message or do any other necessary actions
        return redirect()->route("class.index")->with('success', 'Classe updated successfully');
    }


    public function updateImages(Request $request, Classe $class, ImageClass $image)
    {
        request()->validate([
            'images' => 'image|mimes:png,jpg,svg,jpeg,jfif|min:0'
        ]);


        $srcimages = $request->file("images");

            Storage::disk("public")->delete('img/' . $image->images);
            $imageName = 'class_' . uniqid() . '.' . $srcimages->getClientOriginalExtension();
            $srcimages->storeAs('img/classe/', $imageName, 'public');
            $dataImg = [
                'images' => $imageName,
            ];
            $image->update($dataImg);
            return redirect()->route("class.index")->with('success', 'Classe updated successfully');
        }

    public function deleteImage(ImageClass $image)
    {
        Storage::disk("public")->delete('img/classe/' . $image->images);
        $image->delete();
        return redirect()->back();
    }

    public function delete(Classe $classe)
    {
        $allImages = ImageClass::where("classe_id", $classe->id)->get();
        foreach ($allImages as $image) {
            $image->delete();
            Storage::disk("public")->delete('img/classe/' . $image->images);
        }

        $classe->delete();
        return redirect()->back()->with('success', 'image deleted successfully');
    }
}
