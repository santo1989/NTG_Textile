<?php

namespace App\Http\Controllers;

use App\Models\QC;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QCController extends Controller
{

    public function index()
    {
        $qcs = QC::all();
        return view('backend.library.qcs.index', compact('qcs'));
    }


    public function create()
    {
        $qcs = QC::all();
        return view('backend.library.qcs.create', compact('qcs'));
    }


    public function store(Request $request)
    {
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
        return view('backend.library.qcs.show', compact('qcs'));
    }


    public function edit($id)
    {
        $qcs = QC::findOrFail($id);
        return view('backend.library.qcs.edit', compact('qcs'));
    }


    public function update(Request $request, $id)
    {
        $request->validate(['date' => 'required',
            'shift' => 'required',
            'grade_a' => 'required',
            'grade_b' => 'required',
            'grade_c' => 'required',
            'rejection' => 'required',
        ]);


        // Data update
        $qcs = QC::findOrFail($id);
        // Data insert
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

        $qcs->delete();

        return redirect()->route('qcs.index')->withMessage('QC and related data  are deleted successfully!');
    }

    public function dashboard()
    {
        $qcs = QC::whereDate('date', Carbon::today())->get();
        $total_grade_a = $qcs->sum('grade_a');
        $total_grade_b = $qcs->sum('grade_b');
        $total_grade_c = $qcs->sum('grade_c');
        $total_rejection = $qcs->sum('rejection');
        $total_check = $qcs->sum('total_check');
        $total_qc_pass_qty = $qcs->sum('qc_pass_qty');
        $total_precentage_rejection = round($total_rejection / $total_check * 100, 2);




       
        return view('frontend.qcs_Dashboard', compact('qcs', 'total_grade_a', 'total_grade_b', 'total_grade_c', 'total_rejection', 'total_check', 'total_qc_pass_qty', 'total_precentage_rejection'));
    }

    public function getQCs(Request $request)
    {
        $today = $request->input('today');
        $qcs = QC::whereDate('date', $today)->get();
      
        return response()->json($qcs);
    }

    public function getQCs_total(Request $request)
    {
        $today = $request->input('today');
        $qcs = QC::whereDate('date', $today)->get();
        $total_grade_a = $qcs->sum('grade_a');
        $total_grade_b = $qcs->sum('grade_b');
        $total_grade_c = $qcs->sum('grade_c');
        $total_rejection = $qcs->sum('rejection');
        $total_check = $qcs->sum('total_check');
        $total_qc_pass_qty = $qcs->sum('qc_pass_qty');
        $total_precentage_rejection = round($total_rejection / $total_check * 100, 2);
       
        $qcs = array(
            'total_grade_a' => $total_grade_a,
            'total_grade_b' => $total_grade_b,
            'total_grade_c' => $total_grade_c,
            'total_rejection' => $total_rejection,
            'total_check' => $total_check,
            'total_qc_pass_qty' => $total_qc_pass_qty,
            'total_precentage_rejection' => $total_precentage_rejection,
            
        );
        return response()->json($qcs);
    }
}