<?php

namespace App\Http\Controllers;

use App\Models\QC;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QCController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', QC::class); // Check if the user can view any QC
        $qcs = QC::all();
        return view('backend.library.qcs.index', compact('qcs'));
    }


    public function create()
    {

        $this->authorize('create', QC::class); // Check if the user can create a QC
        $qcs = QC::all();
        return view('backend.library.qcs.create', compact('qcs'));
    }


    public function store(Request $request)
    {
        $this->authorize('create', QC::class); // Check if the user can create a QC
        // dd($request->all());
        $request->validate([
            'date' => 'required',
            'shift' => 'required',
            'grade_a' => 'required',
            'grade_b' => 'required',
            'grade_c' => 'required',
            'rejection' => 'required',
        ]);

        $qcs = QC::all();
        // Data insert
        $qcs = new QC;
        $qcs->date = $request->date;
        $qcs->shift = $request->shift;
        $qcs->grade_a = $request->grade_a;
        $qcs->grade_b = $request->grade_b;
        $qcs->grade_c = $request->grade_c;
        $qcs->rejection = $request->rejection;
        $qcs->precentage_rejection = round($request->rejection / ($request->grade_a + $request->grade_b + $request->grade_c) * 100, 2);
        $qcs->total_check = $request->grade_a + $request->grade_b + $request->grade_c;
        $qcs->qc_pass_qty = $request->grade_a + $request->grade_b + $request->grade_c - $request->rejection;
       
        $qcs->save();

        // Redirect
        return redirect()->route('qcs.index');
    }


    public function show($id)
    {
        
        $qcs = QC::findOrFail($id);
        $this->authorize('viewAny', $qcs); // Check if the user can view the specific QC
        return view('backend.library.qcs.show', compact('qcs'));
    }


    public function edit($id)
    {
        
        $qcs = QC::findOrFail($id);
        $this->authorize('update', $qcs); // Check if the user can update the specific qcs
        return view('backend.library.qcs.edit', compact('qcs'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'date' => 'required',
            'shift' => 'required',
            'grade_a' => 'required',
            'grade_b' => 'required',
            'grade_c' => 'required',
            'rejection' => 'required',
        ]);


        // Data update
        $qcs = QC::findOrFail($id);
        $this->authorize('update', $qcs); // Check if the user can update the specific qcs
        $qcs->date = $request->date;
        $qcs->shift = $request->shift;
        $qcs->grade_a = $request->grade_a;
        $qcs->grade_b = $request->grade_b;
        $qcs->grade_c = $request->grade_c;
        $qcs->rejection = $request->rejection;
        $qcs->precentage_rejection = round($request->rejection / ($request->grade_a + $request->grade_b + $request->grade_c) * 100, 2);
        $qcs->total_check = $request->grade_a + $request->grade_b + $request->grade_c;
        $qcs->qc_pass_qty = $request->grade_a + $request->grade_b + $request->grade_c - $request->rejection;

        $qcs->save();

        // Redirect
        return redirect()->route('qcs.index');
    }


    public function destroy($id)
    {
     
        $qcs = QC::findOrFail($id);
        $this->authorize('delete', $qcs); // Check if the user can delete the specific qcs

        $qcs->delete();

        return redirect()->route('qcs.index')->withMessage('QC and related data  are deleted successfully!');
    }

    public function dashboard()
    {
        $qcs = QC::whereDate('date', Carbon::today())->get();

        $total_target_kg = $qcs->sum('target_kg');
        $total_actual_production_kg = $qcs->sum('actual_production_kg');
        $total_achievement = ($total_actual_production_kg > 0) ?  round(($total_actual_production_kg / $total_target_kg) * 100, 2) : 0;

        return view('frontend.cpb_Dashboard', compact('qcs', 'total_target_kg', 'total_actual_production_kg', 'total_achievement'));
    }

    public function getCPBs(Request $request)
    {
        $today = $request->input('today');
        $qcs = QC::whereDate('date', $today)->get();

        foreach ($qcs as $cpb) {
            $cpb->variance = $cpb->target_kg - $cpb->actual_production_kg;
            if ($cpb->variance < 0) {
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

        return response()->json($qcs);
    }

    public function getCPBs_total(Request $request)
    {
        $today = $request->input('today');
        $qcs = QC::whereDate('date', $today)->get();
        $total_target_kg = $qcs->sum('target_kg');
        $total_actual_production_kg = $qcs->sum('actual_production_kg');
        $total_achievement = ($total_actual_production_kg > 0) ?  round(($total_actual_production_kg / $total_target_kg) * 100, 2) : 0;
        $qcs = array(
            'total_target_kg' => $total_target_kg,
            'total_actual_production_kg' => $total_actual_production_kg,
            'total_achievement' => $total_achievement,
        );
        return response()->json($qcs);
    }
}