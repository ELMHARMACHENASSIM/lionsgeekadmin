<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ReservationClasse;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::all();
        return view("Backend.pages.reservationClasse", compact("classes"));
    }

    public function indexfront()
    {
        $classes = Classe::all();
        return view("frontend.pages.reservationclass_Front", compact("classes"));
    }

    public function indexshow()
    {
        $classes = Classe::all();
        return view("Backend.pages.reservationClasse", compact("classes"));
    }

    public function infoIndex(Classe $classe)
    {
        $allClasses = Classe::all();
        $chosenClasse = Classe::find($classe->id);
        $reservationClasses = ReservationClasse::all();

        // Create an Empty Array
        $events = array();

        foreach ($reservationClasses as $reservation) {
            // if the reservation is not canceled
            if ($reservation->cancel == 0) {
                if ($reservation->classe_id === $chosenClasse->id) {
                    $color = ($reservation->user->userType->id === 1) ? "#FFEBB7" : "#D6C8FF";
                    $borderColor = ($reservation->user->userType->id === 1) ? "#E7C160" : "#A384FF";
                    // Fill the array with needed informations
                    $events[] = [
                        "id" => $reservation->id,
                        "title" => $reservation->title,
                        "start" => $reservation->start_time,
                        "end" => $reservation->finish_time,
                        "backgroundColor" => $color,
                        "borderColor" => $borderColor,
                        // "eventTextColor" => "red",
                        // "textColor" => "white",
                    ];
                }
            }
        }
        return view("Backend.partials.reservationClasse.reservationClasseInfo", compact("allClasses", "chosenClasse", "events", "reservationClasses"));
    }

    public function infoIndexfront(Classe $classe)
    {
        $allClasses = Classe::all();
        $chosenClasse = Classe::find($classe->id);
        $reservationClasses = ReservationClasse::all();

        // Create an Empty Array
        $events = array();

        foreach ($reservationClasses as $reservation) {
            // if the reservation is not canceled
            if ($reservation->cancel == 0) {
                if ($reservation->classe_id === $chosenClasse->id) {
                    $color = ($reservation->user->userType->id === 1) ? "#FFEBB7" : "#D6C8FF";
                    $borderColor = ($reservation->user->userType->id === 1) ? "#E7C160" : "#A384FF";
                    // Fill the array with needed informations
                    $events[] = [
                        "id" => $reservation->id,
                        "title" => $reservation->title,
                        "start" => $reservation->start_time,
                        "end" => $reservation->finish_time,
                        "backgroundColor" => $color,
                        "borderColor" => $borderColor,
                        // "eventTextColor" => "red",
                        // "textColor" => "white",
                    ];
                }
            }
        }
        return view("frontend.pages.reservationClasseInfofront", compact("allClasses", "chosenClasse", "events", "reservationClasses"));
    }

    public function store(Request $request, Classe $classe)
    {
        request()->validate([
            "title" => ["required"],
            "description" => ["required"],
            "day" => ["required"],
            "start_hour" => ["required"],
            "finish_hour" => ["required"],
        ]);

        $start_time = $request->day . "T" . $request->start_hour;
        $finish_time = $request->day . "T" . $request->finish_hour;


        // Get all my The reservation from the DB
        $allReservations = ReservationClasse::all();

        // Convert starting and finishing time to the same format
        $userStartTime = new DateTime($start_time);
        $userEndTime = new DateTime($finish_time);


        // Check if the ending time is not before the starting time
        if ($userEndTime <= $userStartTime) {
            return redirect()->back()->with("error", "the ending time was before or equal to the starting time");
        }

        foreach ($allReservations as $reservation) {
            //* Only Make condition when reserving the same class 
            // the (int) is to convert the request value to an integer
            if ($reservation->cancel === 0) {
                if ($reservation->classe_id === $classe->id) {
                    // dd([$userStartTime, $userEndTime]);

                    $baseStartTime = new DateTime($reservation->start_time);
                    $baseEndTime = new DateTime($reservation->finish_time);

                    // Check if the user's time period overlaps with any reservation
                    if ($userStartTime >= $baseStartTime && $userEndTime <= $baseEndTime) {
                        return redirect()->back()->with("error", "There's already a reservation in this time.");
                    }

                    // Check if the user's time period contains a reservation
                    if ($userStartTime <= $baseStartTime && $userEndTime >= $baseEndTime) {
                        return redirect()->back()->with("error", "This time coincides with a reservation.");
                    }

                    // Check if the user's starting or ending time is during a reservation
                    if (($userStartTime >= $baseStartTime && $userStartTime < $baseEndTime) ||
                        ($userEndTime > $baseStartTime && $userEndTime <= $baseEndTime)
                    ) {
                        return redirect()->back()->with("error", "Starting or ending time is during a reservation.");
                    }
                }
            }
        }

        ReservationClasse::create([
            "user_id" => Auth::user()->id,
            "title" => $request->title,
            "description" => $request->description,
            "classe_id" => $classe->id,
            "start_time" => $start_time,
            "finish_time" => $finish_time,
            "cancel" => false,
        ]);
        $classe->nombre_utilisation += 1;
        $classe->save();

        return redirect()->back()->with("success", "Reservation made successfully!!");
    }

    public function cancel($id)
    {
        $reservation = ReservationClasse::find($id);
        $reservation->update(
            [
                "cancel" => true,
            ]
        );
        return $id;
    }

    public function update($id, Request $request)
    {
        $reservation = ReservationClasse::find($id);

        $validatedData = request()->validate([
            "title" => "required",
            "description" => "required",
            // "user_id" => "required",
            // "start_time" => "required",
            // "finish_time" => "required",
            // "classe_id" => "required",
            // "cancel" => false,
        ]);

        $reservation->update($validatedData);

        return $reservation;
    }

    public function downloadTxtAjax()
    {
        // it's just a CSV file hhh
        $data = "User,Type,Title,Description,Start Time,Finish Time,Canceled\n";

        $startDay = Carbon::now()->startOfDay();
        $endDay = Carbon::now()->endOfDay();

        $todayReservations = ReservationClasse::whereBetween("start_time", [$startDay, $endDay])
            ->whereBetween("finish_time", [$startDay, $endDay])
            ->get();

        foreach ($todayReservations as $res) {
            $userName = $res->user->name;
            $userType = $res->user->userType->user_type;
            $canceled = $res->cancel ? 'Canceled' : 'Not Canceled';
            $data .= "\"$userName\",\"$userType\",\"$res->title\",\"$res->description\",\"$res->start_time\",\"$res->finish_time\",\"$canceled\"\n";
        }


        return response()->json(['data' => $data]);
    }
}
