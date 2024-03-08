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

        //CREO LE REGOLE
        $rules = [
            'name'    => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email'   => 'required|email|unique:leads',
            'phone'   => 'nullable|string|max:20',
            'content' => 'nullable|string',
        ];

        //CREO I MESSAGGI PERSONALIZZATI
        $customMessages = [
            'required' => 'Il campo :attribute è obbligatorio.',
            'string'   => 'Il campo :attribute deve essere una stringa.',
            'max'      => 'Il campo :attribute non può superare :max caratteri.',
            'email'    => 'Inserisci un indirizzo email valido.',
            'unique'   => 'Questo :attribute è già stato utilizzato.',

        ];

        //CREO LA VALIDAZIONE
        $validator = Validator::make($data, $rules, $customMessages);

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
