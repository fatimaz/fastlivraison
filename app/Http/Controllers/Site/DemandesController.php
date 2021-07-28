<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;
use App\Http\Requests\DemandeRequest;
use App\Models\Demande;

class DemandesController extends Controller
{
  
 public function store(DemandeRequest $request)
    {
       try {
        $demande = Demande::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'phone' => $request -> phone,
            'message' => $request -> message,
        ]);

        $demande->save();
  
        return redirect()->back()->with(['success' => 'message sent successfully']);
       } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'There is an error please try again']);
        }


    }
}