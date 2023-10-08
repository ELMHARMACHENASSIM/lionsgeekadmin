<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\EquipeUser;
use App\Models\Material;
use App\Models\ReservationStudio;
use App\Models\ReservationStudioMaterial;
use App\Models\Studio;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationStudioController extends Controller
{
    public function index()
    {
        $studios = Studio::all();
        return view("Backend.pages.reservationStudio", compact("studios"));
    }

    public function indexfront()
    {
        $studios = Studio::all();
        return view("frontend.pages.reservationstudio", compact("studios"));
    }


    public function studioInfo(Studio $studio)
    {
        $allStudios = Studio::all();
        $chosenStudio = Studio::find($studio->id);
        $reservationStudios = ReservationStudio::all();

        // Create an Empty Array
        $events = array();

        foreach ($reservationStudios as $reservation) {
            // if the reservation is not canceled
            if ($reservation->cancel == 0) {
                if ($reservation->studio_id === $chosenStudio->id) {
                    $color = ($reservation->user->userType->id === 2) ? "#FFEBB7" : "#D6C8FF";
                    $borderColor = ($reservation->user->userType->id === 2) ? "#E7C160" : "#A384FF";
                    // Fill the array with needed informations
                    $events[] = [
                        "id" => $reservation->id,
                        "title" => $reservation->title,
                        "start" => $reservation->start_time,
                        "end" => $reservation->finish_time,
                        "backgroundColor" => $color,
                        "borderColor" => $borderColor,
                    ];
                }
            }
        }
        return view("Backend.partials.reservationStudio.reservaionStudioInfo", compact("allStudios", "chosenStudio", "reservationStudios", "events"));
    }

    public function studioInfoFront(Studio $studio)
    {
        $allStudios = Studio::all();
        $chosenStudio = Studio::find($studio->id);
        $reservationStudios = ReservationStudio::all();

        // Create an Empty Array
        $events = array();

        foreach ($reservationStudios as $reservation) {
            // if the reservation is not canceled
            if ($reservation->cancel == 0) {
                if ($reservation->studio_id === $chosenStudio->id) {
                    $color = ($reservation->user->userType->id === 2) ? "#FFEBB7" : "#D6C8FF";
                    $borderColor = ($reservation->user->userType->id === 2) ? "#E7C160" : "#A384FF";
                    // Fill the array with needed informations
                    $events[] = [
                        "id" => $reservation->id,
                        "title" => $reservation->title,
                        "start" => $reservation->start_time,
                        "end" => $reservation->finish_time,
                        "backgroundColor" => $color,
                        "borderColor" => $borderColor,
                    ];
                }
            }
        }
        return view("frontend.pages.reservaionStudioInfoFront", compact("allStudios", "chosenStudio", "reservationStudios", "events"));
    }


    public function createStudioReservation(Studio $studio)
    {
        $allStudios = Studio::all();
        $chosenStudio = Studio::find($studio->id);
        $materials = Material::all();
        $allReservations = ReservationStudio::all();

        return view("Backend.partials.reservationStudio.reservationStudioCreate", compact("chosenStudio", "allStudios", "materials"));
    }
    public function createStudioReservationfront(Studio $studio)
    {
        $allStudios = Studio::all();
        $chosenStudio = Studio::find($studio->id);
        $materials = Material::all();
        return view("frontend.partials.reservationSudio.createstudioreservation", compact("chosenStudio", "allStudios", "materials"));
    }


    public function reservationStudioEvent($id)
    {
        $chosenReservation = ReservationStudio::find($id);
        return view("Backend.partials.reservationStudio.ReservationStudioEvent", compact("chosenReservation"));
    }


    public function store(Request $request, Studio $studio)
    {
        request()->validate([
            "title" => ["required"],
            "description" => ["required"],
            "day" => ["required"],
            "start_hour" => ["required"],
            "finish_hour" => ["required"],
            "materials" => "array",
        ]);


        $start_time = $request->day . "T" . $request->start_hour;
        $finish_time = $request->day . "T" . $request->finish_hour;


        // Get all The reservation from the Database
        $allReservations = ReservationStudio::all();

        // Convert starting and finishing time to the same format
        $userStartTime = new DateTime($start_time);
        $userEndTime = new DateTime($finish_time);


        //** Time Verifications */
        if ($userEndTime <= $userStartTime) {
            return redirect()->back()->with("error", "the ending time was before or equal to the starting time");
        }
        foreach ($allReservations as $reservation) {
            //* Only Make condition when reserving the same class 
            // the (int) is to convert the request value to an integer
            if ($reservation->cancel == 0) {
                if ($reservation->studio_id == $studio->id) {
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





        // Get the selected user IDs from the request
        $selectedUserIds = $request->selected_users;

        if ($selectedUserIds) {
            $userIds = User::whereIn('name', $selectedUserIds)->pluck('id')->all();

            $newTeam = Equipe::create();


            // Associate selected users with the new team in the EquipeUser pivot table

            foreach ($userIds as $userId) {
                EquipeUser::create([
                    'user_id' => $userId,
                    'equipe_id' => $newTeam->id,
                ]);
            }
        }
        $newRes = ReservationStudio::create([
            "user_id" => Auth::user()->id,
            "title" => $request->title,
            "description" => $request->description,
            "studio_id" => $studio->id,
            "start_time" => $start_time,
            "finish_time" => $finish_time,
            "equipe_id" => $selectedUserIds ? $newTeam->id : null,
            "cancel" => false,
        ]);



        ///*************************************************** */
        $selectedMaterials = $request->materials;

        if ($selectedMaterials) {
            $chosenMaterials = Material::whereIn("id", $selectedMaterials)->get();

            foreach ($chosenMaterials as $chosenMaterial) {

                $isReserved = Material::where('id', $chosenMaterial->id)
                    ->whereHas('reservationStudios', function ($query) use ($start_time, $finish_time) {
                        $query->where('start_time', '<', $finish_time)
                            ->where('finish_time', '>', $start_time);
                    })
                    ->get();

                if ($isReserved->count() > 0) {

                    return redirect()->back()->with("error", "Material Already Reserved for That Time Period");
                } else {
                    // Material is available, proceed with your logic
                    if ($chosenMaterial->quantite) {
                        $chosenMaterial->nombre_utilisation += 1;
                        $chosenMaterial->save();
                        ReservationStudioMaterial::create([
                            "reservation_studio_id" => $newRes->id,
                            "material_id" => $chosenMaterial->id,
                        ]);
                    }
                }
            }
        }

        $studio->nombre_utilisation += 1;
        $studio->save();
        $newRes->save();

        return redirect()->route("reservationStudio.info", [$studio])->with("success", "Reservation made successfully!!");
    }

    public function cancel($id)
    {
        $chosenReservation = ReservationStudio::find($id);
        $chosenReservation->update(
            [
                "cancel" => true,
            ]
        );
        return redirect()->route("reservationStudio.info", [$chosenReservation]);
    }

    public function update($id, Request $request)
    {
        $reservation = ReservationStudio::find($id);

        $validatedData = request()->validate([
            "title" => "required",
            "description" => "required",
        ]);

        $reservation->update($validatedData);

        return redirect()->back();
    }


    public function downloadTxtAjax()
    {
        // it's just a CSV file hhh
        $data = "User,Type,Title,Description,Material,Start Time,Finish Time,Canceled\n";
        $materials = "";

        $startDay = Carbon::now()->startOfDay();
        $endDay = Carbon::now()->endOfDay();

        $todayReservations = ReservationStudio::whereBetween("start_time", [$startDay, $endDay])
            ->whereBetween("finish_time", [$startDay, $endDay])
            ->get();

        foreach ($todayReservations as $res) {
            // take all material type and separate them by a space
            $materials = $res->materials->pluck('type')->implode(' ');

            $userName = $res->user->name;
            $userType = $res->user->userType->user_type;
            $canceled = $res->cancel ? 'Canceled' : 'Not Canceled';
            $data .= "\"$userName\",\"$userType\",\"$res->title\",\"$res->description\", $materials,\"$res->start_time\",\"$res->finish_time\",\"$canceled\"\n";
        }


        return response()->json(['data' => $data]);
    }
}
