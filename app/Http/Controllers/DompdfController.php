<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use App\Models\Toilet;
use App\Models\Food;
use App\Models\Speech;
use App\Models\Person;
use Illuminate\Http\Request;
use PDF;


class DompdfController extends Controller
{
   public function generatePDF($people_id)
    {
        $person = Person::findOrFail($people_id);
        $temperatures = Temperature::where('people_id', $people_id)->get();
        $toilets = Toilet::where('people_id', $people_id)->get();
        $foods = Food::where('people_id', $people_id)->get();
        $speeches = Speech::where('people_id', $people_id)->get();

        $pdf = PDF::loadView('recordedit', compact('person', 'temperatures', 'toilets', 'foods', 'speeches'));
       
        // return redirect()->route('outputPDF.edit', compact('person', 'temperatures', 'toilets', 'foods', 'speeches'));
    }

     
};

