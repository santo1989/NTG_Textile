<?php

namespace App\Http\Controllers;

use App\Models\GreyDashboard;
use App\Models\YarnDashboard;
use Illuminate\Http\Request;

class YarnDashboardController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', YarnDashboard::class); // Check if the user can view any YarnDashboard
        $yarns = YarnDashboard::all();
        return view('backend.library.yarns.index', compact('yarns'));
    }


    public function create()
    {

        $this->authorize('create', YarnDashboard::class); // Check if the user can create a YarnDashboard
        $yarn = YarnDashboard::all();
        return view('backend.library.yarns.create', compact('yarn'));
    }


    public function store(Request $request)
    {
        $this->authorize('create', YarnDashboard::class); // Check if the user can create a YarnDashboard
        // dd($request->all()); 

        $request->validate([
            // 'company_id' => 'required',
            // 'division_id' => 'required',
            // 'department_id' => 'required',
            'date' => 'required',
            // 'opening_qty' => 'required',
            'received_qty' => 'required',
            // 'received_qumilative_qty' => 'required',
            'issue_qty' => 'required',
            // 'issue_qumilative_qty' => 'required',
            // 'stock_in_hand' => 'required',
        ]);


        //last record
        $last_record = YarnDashboard::latest()->first();
        // Data insert
        $yarns = new YarnDashboard;
        $last_record_id = $last_record->id ?? null;
        if ($last_record_id == !null) {
            $yarns->opening_qty = $last_record->stock_in_hand;
            $yarns->received_qumilative_qty = $request->received_qumilative_qty;
            $yarns->issue_qumilative_qty = $request->issue_qumilative_qty;
            $yarns->stock_in_hand = $request->stock_in_hand;
        } else {
            $yarns->opening_qty = $request->opening_qty;
            $yarns->received_qumilative_qty = $request->received_qumilative_qty;
            $yarns->issue_qumilative_qty = $request->issue_qumilative_qty;
            $yarns->stock_in_hand = $request->stock_in_hand;
        }

        $yarns->company_id = auth()->user()->company_id;
        $yarns->division_id =  auth()->user()->division_id;
        $yarns->department_id = auth()->user()->department_id;
        $yarns->date = $request->date;
        $yarns->received_qty = $request->received_qty;
        $yarns->issue_qty = $request->issue_qty;

        $yarns->created_by = auth()->user()->id;
        $yarns->created_date = date('Y-m-d H:i:s');
        $yarns->remarks = $request->remarks;

        $yarns->save();

        // Redirect
        return redirect()->route('yarns.index')->withMessage('YarnDashboard and related data added successfully!');
    }


    public function show($id)
    {

        $yarns = YarnDashboard::findOrFail($id);
        $this->authorize('viewAny', $yarns); // Check if the user can view the specific YarnDashboard
        return view('backend.library.yarns.show', compact('yarns'));
    }


    public function edit($id)
    {

        $yarn = YarnDashboard::findOrFail($id);
        $this->authorize('update', $yarn); // Check if the user can update the specific yarns
        return view('backend.library.yarns.edit', compact('yarn'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            // 'company_id' => 'required',
            // 'division_id' => 'required',
            // 'department_id' => 'required',
            'date' => 'required',
            // 'opening_qty' => 'required',
            'received_qty' => 'required',
            // 'received_qumilative_qty' => 'required',
            'issue_qty' => 'required',
            // 'issue_qumilative_qty' => 'required',
            // 'stock_in_hand' => 'required',
        ]);


        // Data update
        $yarn = YarnDashboard::findOrFail($id);
        $last_record = $yarn::latest()->first();
        $this->authorize('update', $yarn); // Check if the user can update the specific yarns

        $yarn->company_id = auth()->user()->company_id;
        $yarn->division_id =  auth()->user()->division_id;
        $yarn->department_id = auth()->user()->department_id;
        $yarn->date = $request->date;

        $yarn->opening_qty = $last_record->stock_in_hand;
        $yarn->received_qumilative_qty = $request->received_qumilative_qty;
        $yarn->issue_qumilative_qty = $request->issue_qumilative_qty;
        $yarn->stock_in_hand = $request->stock_in_hand;
        $yarn->received_qty = $request->received_qty;
        $yarn->issue_qty = $request->issue_qty;

        $yarn->updated_by = auth()->user()->id;
        $yarn->updated_date = date('Y-m-d H:i:s');
        $yarn->remarks = $request->remarks;

        $yarn->save();

        // Redirect
        return redirect()->route('yarns.index')->withMessage('YarnDashboard and related data updated successfully!');
    }


    public function destroy($id)
    {

        $yarn = YarnDashboard::findOrFail($id);
        $this->authorize('delete', $yarn); // Check if the user can delete the specific yarns

         //calculate the change in all the records after the deleted record
        $yarns = YarnDashboard::where('id', '>', $id)->get();
        foreach ($yarns as $yarn) {
            $yarn->opening_qty = $yarn->opening_qty - $yarn->received_qty + $yarn->issue_qty;
            $yarn->received_qumilative_qty = $yarn->received_qumilative_qty - $yarn->received_qty;
            $yarn->issue_qumilative_qty = $yarn->issue_qumilative_qty - $yarn->issue_qty;
            $yarn->stock_in_hand = $yarn->stock_in_hand - $yarn->received_qty + $yarn->issue_qty;
            $yarn->save();
        }

        $yarn->delete();

        return redirect()->route('yarns.index')->withMessage('YarnDashboard and related data  are deleted successfully!');
    }

    public function dashboard()
    {
        //current month
        $yarns = YarnDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        return view('backend.dashboard.yarn', compact('yarns'));
    }

    public function getYarnDashboard()
    {
        //current month
        $yarns = YarnDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        return response()->json($yarns);
    }

    public function commonDashboard(){
        $yarns = YarnDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        $grey_fabrics = GreyDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        return view('backend.dashboard.common', compact('yarns','grey_fabrics'));
    }

    public function getcommonDashboard()
    {
        $yarns = YarnDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        $grey_fabrics = GreyDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        return response()->json(['yarns' => $yarns, 'grey_fabrics' => $grey_fabrics]);
    }


    
}  
