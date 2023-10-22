<?php

namespace App\Http\Controllers;

use App\Models\GreyDashboard;
use Illuminate\Http\Request;

class GreyDashboardController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', GreyDashboard::class); // Check if the user can view any GreyDashboard
        $grey_fabrics = GreyDashboard::all();
        return view('backend.library.grey_fabrics.index', compact('grey_fabrics'));
    }


    public function create()
    {

        $this->authorize('create', GreyDashboard::class); // Check if the user can create a GreyDashboard
        $grey_fabric = GreyDashboard::all();
        return view('backend.library.grey_fabrics.create', compact('grey_fabric'));
    }


    public function store(Request $request)
    {
        $this->authorize('create', GreyDashboard::class); // Check if the user can create a GreyDashboard
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
        $last_record = GreyDashboard::latest()->first();
        // Data insert
        $grey_fabrics = new GreyDashboard;
        $last_record_id = $last_record->id ?? null;
        if ($last_record_id == !null) {
            $grey_fabrics->opening_qty = $last_record->stock_in_hand;
            $grey_fabrics->received_qumilative_qty = $request->received_qumilative_qty;
            $grey_fabrics->issue_qumilative_qty = $request->issue_qumilative_qty;
            $grey_fabrics->stock_in_hand = $request->stock_in_hand;
        } else {
            $grey_fabrics->opening_qty = $request->opening_qty;
            $grey_fabrics->received_qumilative_qty = $request->received_qumilative_qty;
            $grey_fabrics->issue_qumilative_qty = $request->issue_qumilative_qty;
            $grey_fabrics->stock_in_hand = $request->stock_in_hand;
        }

        $grey_fabrics->company_id = auth()->user()->company_id;
        $grey_fabrics->division_id =  auth()->user()->division_id;
        $grey_fabrics->department_id = auth()->user()->department_id;
        $grey_fabrics->date = $request->date;
        $grey_fabrics->received_qty = $request->received_qty;
        $grey_fabrics->issue_qty = $request->issue_qty; 

        $grey_fabrics->created_by = auth()->user()->id;
        $grey_fabrics->created_date = date('Y-m-d H:i:s');
        $grey_fabrics->remarks = $request->remarks;

        $grey_fabrics->save();

        // Redirect
        return redirect()->route('grey_fabrics.index')->withMessage('GreyDashboard and related data added successfully!');
    }


    public function show($id)
    {

        $grey_fabrics = GreyDashboard::findOrFail($id);
        $this->authorize('viewAny', $grey_fabrics); // Check if the user can view the specific GreyDashboard
        return view('backend.library.grey_fabrics.show', compact('grey_fabrics'));
    }


    public function edit($id)
    {

        $grey_fabric = GreyDashboard::findOrFail($id);
        $this->authorize('update', $grey_fabric); // Check if the user can update the specific grey_fabrics
        return view('backend.library.grey_fabrics.edit', compact('grey_fabric'));
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
        $grey_fabric = GreyDashboard::findOrFail($id);
        $last_record = $grey_fabric::latest()->first();
        $this->authorize('update', $grey_fabric); // Check if the user can update the specific grey_fabrics

        $grey_fabric->company_id = auth()->user()->company_id;
        $grey_fabric->division_id =  auth()->user()->division_id;
        $grey_fabric->department_id = auth()->user()->department_id;
        $grey_fabric->date = $request->date;

        $grey_fabric->opening_qty = $last_record->stock_in_hand;
        $grey_fabric->received_qumilative_qty = $request->received_qumilative_qty;
        $grey_fabric->issue_qumilative_qty = $request->issue_qumilative_qty;
        $grey_fabric->stock_in_hand = $request->stock_in_hand; 
        $grey_fabric->received_qty = $request->received_qty;
        $grey_fabric->issue_qty = $request->issue_qty; 

        $grey_fabric->updated_by = auth()->user()->id;
        $grey_fabric->updated_date = date('Y-m-d H:i:s');
        $grey_fabric->remarks = $request->remarks;

        $grey_fabric->save();

        // Redirect
        return redirect()->route('grey_fabrics.index')->withMessage('GreyDashboard and related data updated successfully!');
    }


    public function destroy($id)
    {

        $grey_fabric = GreyDashboard::findOrFail($id);
        $this->authorize('delete', $grey_fabric); // Check if the user can delete the specific grey_fabrics

        //calculate the change in all the records after the deleted record
        $grey_fabrics = GreyDashboard::where('id', '>', $id)->get();
        foreach ($grey_fabrics as $grey_fabric) {
            $grey_fabric->opening_qty = $grey_fabric->opening_qty - $grey_fabric->received_qty + $grey_fabric->issue_qty;
            $grey_fabric->received_qumilative_qty = $grey_fabric->received_qumilative_qty - $grey_fabric->received_qty;
            $grey_fabric->issue_qumilative_qty = $grey_fabric->issue_qumilative_qty - $grey_fabric->issue_qty;
            $grey_fabric->stock_in_hand = $grey_fabric->opening_qty + $grey_fabric->received_qty - $grey_fabric->issue_qty;
            $grey_fabric->save();
        }
        $grey_fabric->delete();

        return redirect()->route('grey_fabrics.index')->withMessage('GreyDashboard and related data  are deleted successfully!');
    }

    public function dashboard()
    {
         //current month
        $grey_fabrics = GreyDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        return view('backend.dashboard.grey', compact('grey_fabrics'));
    }

    public function getGreyDashboard()
    { 
        //current month
        $grey_fabrics = GreyDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        return response()->json($grey_fabrics);
    }
}
