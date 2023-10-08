<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ImageStudio;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudioController extends Controller
{
    public function index()
    {

        $studios = Studio::all();
        $images = ImageStudio::all();
        return view("Backend.pages.studio", compact('studios', 'images'));
    }
    public function indexFront()
    {

        $studios = Studio::all();
        $images = ImageStudio::all();
        return view("frontend.pages.reservationStudioFront", compact('studios', 'images'));
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'images.*' => 'required|image|mimes:png,jpg,svg,jpeg,jfif|min:0'
        ]);
        $srcimages = $request->file("images");
        if ($srcimages) {
            $dataClass = [
                'name' => $request->name,
                'disponible' => true,
                'nombre_utilisation' => 0,
            ];
            $studio = Studio::create($dataClass);

            foreach ($srcimages as $image) {
                $imageName = 'studio_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('img/studio/', $imageName, 'public');

                $dataImg = [
                    "studio_id" => $studio->id,
                    'images' => $imageName,
                ];

                ImageStudio::create($dataImg);
            }
        }

        return redirect()->back();
    }
    public function addImages(Request $request, Studio $studio)
    {
        request()->validate([
            'images.*' => 'required|image|mimes:png,jpg,svg,jpeg,jfif|min:0'
        ]);
        $srcimages = $request->file("images");

        if ($srcimages) {
            if ($srcimages) {
                foreach ($srcimages as $image) {
                    $imageName = 'studio_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('img/studio', $imageName, 'public');

                    $dataImg = [
                        'studio_id' => $studio->id,
                        'images' => $imageName,
                    ];

                    ImageStudio::create($dataImg);
                }
            }
        }

        return redirect()->back();
    }
    public function update(Request $request, Studio $studio)
    {
        request()->validate([
            "name" => ["required"],
        ]);
        $dataClass = [
            "name" => $request->name,
            "disponible" => $request->disponible
        ];
        $studio->update($dataClass);

        return redirect()->route("studios.index");
    }
    public function updateImages(Request $request, Studio $studio, ImageStudio $image)
    {
        request()->validate([
            'images' => 'image|mimes:png,jpg,svg,jpeg,jfif|min:0'
        ]);

        Storage::disk("public")->delete('img/studio/' . $image->images);

        $srcimage = $request->file("images");

        if ($srcimage) {
            $imageName = 'studio_' . uniqid() . '.' . $srcimage->getClientOriginalExtension();
            $srcimage->storeAs('img/studio', $imageName, 'public');
            $dataImg = [
                'images' => $imageName,
            ];
            $image->update($dataImg);
        }
        return redirect()->back();
    }
    public function deleteImage(ImageStudio $image)
    {
        Storage::disk("public")->delete('img/studio/' . $image->images);
        $image->delete();
        return redirect()->back();
    }
    public function delete(Studio $studio)
    {
        $allImages = ImageStudio::where("studio_id", $studio->id)->get();
        foreach ($allImages as $image) {
            $image->delete();
            Storage::disk("public")->delete('img/studio/' . $image->images);
        }

        $studio->delete();
        return redirect()->back();
    }
}
