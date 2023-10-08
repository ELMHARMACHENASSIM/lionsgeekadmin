<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Material;
use App\Models\ReservationClasse;
use App\Models\ReservationStudio;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function home()
    {
        return view("frontend.pages.home");
    }
    public function classes()
    {
        $classes = Classe::all();
        return view("frontend.pages.classes", compact("classes"));
    }

    public function classShow(Classe $classe)
    {
        return view("frontend.partials.classes.classesShow", compact("classe"));
    }

    public function studios()
    {
        $studios = Studio::all();
        return view("frontend.pages.studios", compact("studios"));
    }

    public function studioShow(Studio $studio)
    {
        return view("frontend.partials.studios.studiosShow", compact("studio"));
    }

    public function materials()
    {
        $materials = Material::all();
        return view("frontend.pages.material", compact("materials"));
    }
    public function reservation()
    {
        $classReservation = ReservationClasse::all();
        $studioReservation = ReservationStudio::all();
        $combinedReservations = $classReservation->concat($studioReservation);
        $combinedReservations = $combinedReservations->sortBy('start_time');
        $onlineUser = Auth::user();
        $userReservations = $combinedReservations->filter(function ($reservation) {
            return $reservation->user_id === Auth::user()->id;
        });

        return view("frontend.pages.reservation", compact("userReservations" , "onlineUser"));
    }
    // $userReservation 
    public function settings()
    {
        return view("frontend.pages.settings");
    }
}
