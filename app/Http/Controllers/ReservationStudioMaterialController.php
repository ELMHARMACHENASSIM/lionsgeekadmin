<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\ReservationStudio;
use App\Models\ReservationStudioMaterial;
use Illuminate\Http\Request;

class ReservationStudioMaterialController extends Controller
{
    public function destroy(ReservationStudio $chosenReservation, Material $material)
    {
        $target = ReservationStudioMaterial::where("reservation_studio_id", $chosenReservation->id)->where("material_id", $material->id)->first();
        $target->delete();
        return redirect()->back();
    }
}
