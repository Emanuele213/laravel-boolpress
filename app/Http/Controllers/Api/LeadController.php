<?php

namespace App\Http\Controllers\Api;

use App\Lead;
use App\Mail\NewLeadToLead;
use App\Mail\NewLeadToAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        // validare
        $validations = [
            'name'          => 'string|required|max:100',
            'email'         => 'email|required|max:100',
            'newsletter'    => 'boolean',
            'message'       => 'string|required',
        ];
        $formData = $request->all();
        $validator = Validator::make($formData, $validations);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validator->errors(),
            ]);
        }

        // salvarli nel database
        $lead = new Lead;
        $lead->name         = $formData['name'];
        $lead->email        = $formData['email'];
        $lead->newsletter   = $formData['newsletter'];
        $lead->message      = $formData['message'];
        $lead->save();

        // inviare la mail all'amministratore
        Mail::to('admin@boolpress.com')->send(new NewLeadToAdmin($formData));

        // inviare la mail all'utente
        Mail::to($formData['email'])->send(new NewLeadToLead($formData));

        // rispondere alla richiesta con un json
        return response()->json([
            'success' => true,
        ]);
    }
}
