<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{


    public function search(Request $request)
    {

        if ($request->ajax()) {

            $data = User::where('id', 'like', '%' . $request->search . '%')
                ->orwhere('name', 'like', '%' . $request->search . '%')
                ->orwhere('email', 'like', '%' . $request->search . '%')->get();

            $output = '';
            if (count($data) > 0) {
                $output = '
                    <table class="table ">
                    <thead> 
                    
                    </thead>
                    <tbody>';
                foreach ($data as $row) {
                    $output .= '
                            <tr>
                            <th scope="row" class="opacity-75 w-0 " >  <input class="ms-2 " type="checkbox" name="selected_users[]" value="' . $row->name . '"></th>
                            <td class="opacity-75 " >' . $row->name . '</td>
                            </tr>
                            ';
                }
                $output .= '
                    </tbody>
                    </table>';
            } else {
                $output .= 'No results';
            }
            return $output;
        }
    }
}
