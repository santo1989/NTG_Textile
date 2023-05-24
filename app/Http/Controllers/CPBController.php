<?php

namespace App\Http\Controllers;

use App\Models\CPB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use UConverter;

class CPBController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', CPB::class); // Check if the user can view any CPBs
        $cpbs = CPB::all();
        return view('backend.library.cpbs.index', compact('cpbs'));
    }


    public function create()
    {
        $this->authorize('create', CPB::class); // Check if the user can create a CPB
        $cpbs = CPB::all();
        return view('backend.library.cpbs.create', compact('cpbs'));
    }


    public function store(Request $request)
    {
        $this->authorize('create', CPB::class); // Check if the user can create a CPB
        $request->validate([
            'date' => 'required',
            'mc_no' => 'required',
            'target_kg' => 'required',
            'actual_production_kg' => 'required',
        ]);

        $cpbs = CPB::all();
        // Data insert
        $cpbs = new CPB;
        $cpbs->date = $request->date;
        // convert to uppercase all letters
        $cpbs->mc_no = strtoupper($request->mc_no);
        $cpbs->target_kg = $request->target_kg;
        $cpbs->actual_production_kg = $request->actual_production_kg;
        $cpbs->acheivement = round($request->actual_production_kg / $request->target_kg * 100, 2);
        $cpbs->remarks = $request->remarks;
        $cpbs->save();

        // Redirect
        return redirect()->route('cpbs.index');
    }


    public function show($id)
    {
        $cpbs = CPB::findOrFail($id);
        $this->authorize('viewAny', $cpbs); // Check if the user can view the specific CPB
        return view('backend.library.cpbs.show', compact('cpbs'));
    }


    public function edit($id)
    {
        $cpbs = CPB::findOrFail($id);
        $this->authorize('update', $cpbs); // Check if the user can update the specific CPB
        return view('backend.library.cpbs.edit', compact('cpbs'));
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
        $cpbs = CPB::findOrFail($id);
        $this->authorize('update', $cpbs); // Check if the user can update the specific CPB
        $cpbs->date = $request->date;
        // convert to uppercase all letters
        $cpbs->mc_no = strtoupper($request->mc_no);
        $cpbs->target_kg = $request->target_kg;
        $cpbs->actual_production_kg = $request->actual_production_kg;
        $cpbs->acheivement = round($request->actual_production_kg / $request->target_kg * 100, 2);
        $cpbs->remarks = $request->remarks;
        $cpbs->save();

        // Redirect
        return redirect()->route('cpbs.index');
    }


    public function destroy($id)
    {
        $cpbs = CPB::findOrFail($id);
        $this->authorize('delete', $cpbs); // Check if the user can delete the specific CPB

        $cpbs->delete();

        return redirect()->route('cpbs.index')->withMessage('CPB and related data  are deleted successfully!');
    }

    public function dashboard()
    {
        $cpbs = CPB::whereDate('date', Carbon::today())->get();

        $total_target_kg = $cpbs->sum('target_kg');
        $total_actual_production_kg = $cpbs->sum('actual_production_kg');
        $total_achievement = ($total_actual_production_kg > 0) ?  round(( $total_actual_production_kg / $total_target_kg) * 100,2) : 0;

        return view('frontend.cpb_Dashboard', compact('cpbs', 'total_target_kg', 'total_actual_production_kg', 'total_achievement'));
    }

    public function getCPBs(Request $request)
    {
        $today = $request->input('today');
        $cpbs = CPB::whereDate('date', $today)->get();

        foreach ($cpbs as $cpb) {
            $cpb->variance = $cpb->target_kg - $cpb->actual_production_kg;
            if($cpb->variance < 0){
                $cpb->variance = -1 * $cpb->variance;
            }
            if ($cpb->actual_production_kg ==  $cpb->target_kg) {
                $cpb->style = 'background:#384268; border: 1px solid #ffffff;';
                $cpb->arrow_icon = 'color:#ffffff';
                
            } 
            if ($cpb->actual_production_kg >  $cpb->target_kg) {
                $cpb->style = 'background:#395d31; border: 1px solid #ffffff;';
                $cpb->arrow_icon = ' color:#FFFF00';
            }
            if ($cpb->actual_production_kg <  $cpb->target_kg) {
                $cpb->style = 'background:#ff0000; border: 1px solid #ffffff;';
                $cpb->arrow_icon = 'color:#ff0000';
            }
            
        }

        return response()->json($cpbs);

        
        
    }

    public function getCPBs_total(Request $request)
    {
        $today = $request->input('today');
        $cpbs = CPB::whereDate('date', $today)->get();
        $total_target_kg = $cpbs->sum('target_kg');
        $total_actual_production_kg = $cpbs->sum('actual_production_kg');
        $total_achievement = ($total_actual_production_kg > 0) ?  round(( $total_actual_production_kg / $total_target_kg) * 100,2) : 0;
        $cpbs = array(
            'total_target_kg' => $total_target_kg,
            'total_actual_production_kg' => $total_actual_production_kg,
            'total_achievement' => $total_achievement,
        );
        return response()->json($cpbs);
    }
}

