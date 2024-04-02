<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|numeric|min:1',
            'name' => 'required|min:3',
            'response' => 'required|min:5|max:50',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $response = new Response();
        $response->user_id = $request->employee_id;
        $response->name = $request->name;
        $response->text = $request->response;
        $response->rating = $request->rating;
        $response->save();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Response was successfully added!',
        ]);
    }
}
