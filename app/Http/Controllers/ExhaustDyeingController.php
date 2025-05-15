<?php

namespace App\Http\Controllers;

use App\Models\CPB;
use App\Models\ExhaustDyeing;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExhaustDyeingController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', ExhaustDyeing::class); // Check if the user can view any CPBs
        $exhaust_dyeings = ExhaustDyeing::latest()->get();
        return view('backend.library.exhaust_dyeings.index', compact('exhaust_dyeings'));
    }


    public function create()
    {
        $this->authorize('create', ExhaustDyeing::class); // Check if the user can create a ExhaustDyeing
        $exhaust_dyeings = ExhaustDyeing::all();
        return view('backend.library.exhaust_dyeings.create', compact('exhaust_dyeings'));
    }


    public function store(Request $request)
    {
        $this->authorize('create', ExhaustDyeing::class); // Check if the user can create a ExhaustDyeing
        $request->validate([
            'date' => 'required',
            'mc_no' => 'required',
            'target_kg' => 'required',
            'actual_production_kg' => 'required',
        ]);

        $exhaust_dyeings = ExhaustDyeing::all();
        // Data insert
        $exhaust_dyeings = new ExhaustDyeing;
        $exhaust_dyeings->date = $request->date;
        // convert to uppercase all letters
        $exhaust_dyeings->mc_no = strtoupper($request->mc_no);
        $exhaust_dyeings->target_kg = $request->target_kg;
        $exhaust_dyeings->actual_production_kg = $request->actual_production_kg;
        $exhaust_dyeings->acheivement = round($request->actual_production_kg / $request->target_kg * 100, 2);
        $exhaust_dyeings->remarks = $request->remarks;
        $exhaust_dyeings->save();

        // Redirect
        return redirect()->route('exhaust_dyeings.index');
    }


    public function show($id)
    {
        $exhaust_dyeings = ExhaustDyeing::findOrFail($id);
        $this->authorize('viewAny', $exhaust_dyeings); // Check if the user can view the specific ExhaustDyeing
        return view('backend.library.exhaust_dyeings.show', compact('exhaust_dyeings'));
    }


    public function edit($id)
    {
        $exhaust_dyeings = ExhaustDyeing::findOrFail($id);
        $this->authorize('update', $exhaust_dyeings); // Check if the user can update the specific ExhaustDyeing
        return view('backend.library.exhaust_dyeings.edit', compact('exhaust_dyeings'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'mc_no' => 'required',
            'target_kg' => 'required',
            'actual_production_kg' => 'required',
        ]);


        // Data update
        $exhaust_dyeings = ExhaustDyeing::findOrFail($id);
        $this->authorize('update', $exhaust_dyeings); // Check if the user can update the specific ExhaustDyeing
        $exhaust_dyeings->date = $request->date;
        // convert to uppercase all letters
        $exhaust_dyeings->mc_no = strtoupper($request->mc_no);
        $exhaust_dyeings->target_kg = $request->target_kg;
        $exhaust_dyeings->actual_production_kg = $request->actual_production_kg;
        $exhaust_dyeings->acheivement = round($request->actual_production_kg / $request->target_kg * 100, 2);
        $exhaust_dyeings->remarks = $request->remarks;
        $exhaust_dyeings->save();

        // Redirect
        return redirect()->route('exhaust_dyeings.index');
    }


    public function destroy($id)
    {
        $exhaust_dyeings = ExhaustDyeing::findOrFail($id);
        $this->authorize('delete', $exhaust_dyeings); // Check if the user can delete the specific ExhaustDyeing

        $exhaust_dyeings->delete();

        return redirect()->route('exhaust_dyeings.index')->withMessage('ExhaustDyeing and related data  are deleted successfully!');
    }

    public function dashboard()
    {
        $yesterday = Carbon::now()->subDay();
        $exhaust_dyeings = ExhaustDyeing::whereDate('date', $yesterday)->get();

        // dd($exhaust_dyeings);

        $total_target_kg = $exhaust_dyeings->sum('target_kg');
        $total_actual_production_kg = $exhaust_dyeings->sum('actual_production_kg');
        $total_achievement = ($total_actual_production_kg > 0) ? round(($total_actual_production_kg / $total_target_kg) * 100, 2) : 0;

        return view('frontend.ed_Dashboard', compact('exhaust_dyeings', 'total_target_kg', 'total_actual_production_kg', 'total_achievement'));
    }


    public function get_exhaust_dyeings(Request $request)
    {
        $today = $request->input('today');
        $exhaust_dyeings = ExhaustDyeing::whereDate('date', $today)->get();

        foreach ($exhaust_dyeings as $exhaust_dyeing) {
            $exhaust_dyeing->variance = $exhaust_dyeing->target_kg - $exhaust_dyeing->actual_production_kg;
            if ($exhaust_dyeing->variance < 0) {
                $exhaust_dyeing->variance = -1 * $exhaust_dyeing->variance;
            }
            if ($exhaust_dyeing->actual_production_kg ==  $exhaust_dyeing->target_kg) {
                $exhaust_dyeing->style = 'background:#384268; border: 1px solid #ffffff;';
                $exhaust_dyeing->arrow_icon = 'color:#ffffff';
            }
            if ($exhaust_dyeing->actual_production_kg >  $exhaust_dyeing->target_kg) {
                $exhaust_dyeing->style = 'background:#395d31; border: 1px solid #ffffff;';
                $exhaust_dyeing->arrow_icon = ' color:#FFFF00';
            }
            if ($exhaust_dyeing->actual_production_kg <  $exhaust_dyeing->target_kg) {
                $exhaust_dyeing->style = 'background:#ff0000; border: 1px solid #ffffff;';
                $exhaust_dyeing->arrow_icon = 'color:#ff0000';
            }
        }

        return response()->json($exhaust_dyeings);
    }

    public function getExhaustDyeings_total(Request $request)
    {
        $today = $request->input('today');
        $exhaust_dyeings = ExhaustDyeing::whereDate('date', $today)->get();
        $total_target_kg = $exhaust_dyeings->sum('target_kg');
        $total_actual_production_kg = $exhaust_dyeings->sum('actual_production_kg');
        $total_achievement = ($total_actual_production_kg > 0) ?  round(($total_actual_production_kg / $total_target_kg) * 100, 2) : 0;
        $exhaust_dyeings = array(
            'total_target_kg' => $total_target_kg,
            'total_actual_production_kg' => $total_actual_production_kg,
            'total_achievement' => $total_achievement,
        );
        return response()->json($exhaust_dyeings);
    }

    // cpbs_ed_dashboard
    public function cpbs_ed_dashboard()
    {
        $yesterday = Carbon::now()->subDay();

        // CPB Data
        $cpbs = CPB::whereDate('date', $yesterday)->get();
        $cpb_total_target_kg = $cpbs->sum('target_kg');
        $cpb_total_actual_production_kg = $cpbs->sum('actual_production_kg');
        $cpb_total_achievement = ($cpb_total_actual_production_kg > 0) ? round(($cpb_total_actual_production_kg / $cpb_total_target_kg) * 100, 2) : 0;

        // ED Data
        $exhaust_dyeings = ExhaustDyeing::whereDate('date', $yesterday)->get();
        $ed_total_target_kg = $exhaust_dyeings->sum('target_kg');
        $ed_total_actual_production_kg = $exhaust_dyeings->sum('actual_production_kg');
        $ed_total_achievement = ($ed_total_actual_production_kg > 0) ? round(($ed_total_actual_production_kg / $ed_total_target_kg) * 100, 2) : 0;

        return view('frontend.cpbs_ed_dashboard', compact(
            'cpb_total_target_kg',
            'cpb_total_actual_production_kg',
            'cpb_total_achievement',
            'ed_total_target_kg',
            'ed_total_actual_production_kg',
            'ed_total_achievement'
        ));
    }
}
