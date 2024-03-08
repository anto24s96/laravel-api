<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Models\Lead;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        //RECUPERO I DATI
        $data = $request->all();

        //CREO LA VALIDAZIONE
        $validator = Validator::make($data, [
            'name'    => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email'   => 'required|email|unique:leads',
            'phone'   => 'nullable|string|max:20',
            'content' => 'nullable|string',
        ]);

        //VERIFICO SE LA VALIDAZIONE FALLISCE
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ]);
        }

        //SE LA VALIDAZIONE VA A BUON FINE; DEVO CREARE UN NUOVO RECORD NELLA TABELLA LEADS
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        //INVIO LA MAIL
        Mail::to('info@boolpress.com')->send(new NewContact($new_lead));

        return response()->json([
            'success' => true
        ]);
    }
}
