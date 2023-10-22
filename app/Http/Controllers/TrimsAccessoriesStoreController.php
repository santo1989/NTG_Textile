<?php

namespace App\Http\Controllers;

use App\Models\TrimsAccessoriesStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrimsAccessoriesStoreController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', TrimsAccessoriesStore::class); // Check if the user can view any TrimsAccessoriesStore
        $trims = TrimsAccessoriesStore::all();
        return view('backend.library.trims.index', compact('trims'));
    }


    public function create()
    {

        $this->authorize('create', TrimsAccessoriesStore::class); // Check if the user can create a TrimsAccessoriesStore
        $trim = TrimsAccessoriesStore::all();
        return view('backend.library.trims.create', compact('trim'));
    }


    public function store(Request $request)
    {
        $this->authorize('create', TrimsAccessoriesStore::class); // Check if the user can create a TrimsAccessoriesStore
        // dd($request->all()); 

        $request->validate([
            'date' => 'required',
            'buyer_name' => 'required',
            'style_or_no' => 'required',
            'booking_qty' => 'required',
            'receive_qty' => 'required',
            'rcv_bal_qty' => 'required',
            'issue_qty' => 'required',
            'in_hand_qty' => 'required',
        ]);



        $trims = new TrimsAccessoriesStore;
        $trims->company_id = auth()->user()->company_id;
        $trims->division_id =  auth()->user()->division_id;
        $trims->department_id = auth()->user()->department_id;
        $trims->date = $request->input('date');
        //convert to uppercase 
        $trims->buyer_name = ucwords($request->input('buyer_name'));
        $trims->style_or_no = ucwords($request->input('style_or_no'));
        $trims->order_qty = $request->input('order_qty');
        $trims->item_no = $request->input('item_no');
        $trims->color_name = $request->input('color_name');
        $trims->unit = $request->input('unit');
        $trims->booking_qty = $request->input('booking_qty');
        $trims->receive_qty = $request->input('receive_qty');
        $trims->rcv_bal_qty = $request->input('rcv_bal_qty');
        $trims->issue_qty = $request->input('issue_qty');
        $trims->in_hand_qty = $request->input('in_hand_qty');
        $trims->rack_no = $request->input('rack_no');
        $trims->self_bin_no = $request->input('self_bin_no');
        $trims->remarks = $request->input('remarks');
        $trims->created_by = auth()->user()->id;
        $trims->created_date = now();

        $trims->save();

        // Redirect
        return redirect()->route('trims.index')->withMessage('TrimsAccessoriesStore and related data added successfully!');
    }


    public function show($id)
    {

        $trims = TrimsAccessoriesStore::findOrFail($id);
        $this->authorize('viewAny', $trims); // Check if the user can view the specific TrimsAccessoriesStore
        return view('backend.library.trims.show', compact('trims'));
    }


    public function edit($id)
    {

        $trim = TrimsAccessoriesStore::findOrFail($id);
        $this->authorize('update', $trim); // Check if the user can update the specific trims
        return view('backend.library.trims.edit', compact('trim'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'date' => 'required',
            'buyer_name' => 'required',
            'style_or_no' => 'required',
            'booking_qty' => 'required',
            'receive_qty' => 'required',
            'rcv_bal_qty' => 'required',
            'issue_qty' => 'required',
            'in_hand_qty' => 'required',
        ]);





        // Data update
        $trim = TrimsAccessoriesStore::findOrFail($id); 
        $this->authorize('update', $trim); // Check if the user can update the specific trims

        $trim->company_id = auth()->user()->company_id;
        $trim->division_id =  auth()->user()->division_id;
        $trim->department_id = auth()->user()->department_id;
        $trim->date = $request->date;
        //convert to uppercase 
        $trim->buyer_name = ucwords($request->input('buyer_name'));
        $trim->style_or_no = ucwords($request->input('style_or_no'));
        $trim->order_qty = $request->input('order_qty');
        $trim->item_no = $request->input('item_no');
        $trim->color_name = $request->input('color_name');
        $trim->unit = $request->input('unit');
        $trim->booking_qty = $request->input('booking_qty');
        $trim->receive_qty = $request->input('receive_qty');
        $trim->rcv_bal_qty = $request->input('rcv_bal_qty');
        $trim->issue_qty = $request->input('issue_qty');
        $trim->in_hand_qty = $request->input('in_hand_qty');
        $trim->rack_no = $request->input('rack_no');
        $trim->self_bin_no = $request->input('self_bin_no');
        $trim->remarks = $request->input('remarks');

        $trim->updated_by = auth()->user()->id;
        $trim->updated_date = date('Y-m-d H:i:s');
        $trim->remarks = $request->remarks;

        $trim->save();

        // Redirect
        return redirect()->route('trims.index')->withMessage('TrimsAccessoriesStore and related data updated successfully!');
    }


    public function destroy($id)
    {

        $trim = TrimsAccessoriesStore::findOrFail($id);
        $this->authorize('delete', $trim); // Check if the user can delete the specific trims

        $trim->delete();

        return redirect()->route('trims.index')->withMessage('TrimsAccessoriesStore and related data  are deleted successfully!');
    }

    public function dashboard()
    {
        // $trims_dashboard = TrimsAccessoriesStore::all()->groupBy(['buyer_name', 'style_or_no', 'color_name', 'item_no', 'unit']);

        $trims_dashboard = TrimsAccessoriesStore::select(
            'buyer_name',
            'style_or_no',
            'color_name',
            'item_no',
            'unit',
            DB::raw('SUM(booking_qty) as total_booking_qty'),
            DB::raw('SUM(receive_qty) as total_receive_qty'),
            DB::raw('SUM(issue_qty) as total_issue_qty'),
            DB::raw('SUM(in_hand_qty) as total_in_hand_qty'),
            DB::raw('SUM(rcv_bal_qty) as total_rcv_bal_qty'),
            DB::raw('GROUP_CONCAT( DISTINCT rack_no ORDER BY rack_no SEPARATOR ",") as rack_no'),
            DB::raw('GROUP_CONCAT( DISTINCT self_bin_no ORDER BY self_bin_no SEPARATOR ",") as self_bin_no')
        )
        ->groupBy(['buyer_name', 'style_or_no', 'color_name', 'item_no', 'unit'])
        ->get(); 
        // dd($trims_dashboard);

        return view('backend.dashboard.trims', compact('trims_dashboard'));
    }

    public function getTrimsDashboard(Request $request)
    {
        $buyer_name = $request->input('buyer_name');
        if ($buyer_name == 'all') {
            $trims_dashboard = TrimsAccessoriesStore::select(
                'buyer_name',
                'style_or_no',
                'color_name',
                'item_no',
                'unit',
                DB::raw('SUM(booking_qty) as total_booking_qty'),
                DB::raw('SUM(receive_qty) as total_receive_qty'),
                DB::raw('SUM(issue_qty) as total_issue_qty'),
                DB::raw('SUM(in_hand_qty) as total_in_hand_qty'),
                DB::raw('SUM(rcv_bal_qty) as total_rcv_bal_qty'),
                DB::raw('GROUP_CONCAT(DISTINCT rack_no ORDER BY rack_no SEPARATOR ",") as rack_no'),
                DB::raw('GROUP_CONCAT(DISTINCT self_bin_no ORDER BY self_bin_no SEPARATOR ",") as self_bin_no')
            )
                ->groupBy(['buyer_name', 'style_or_no', 'color_name', 'item_no', 'unit'])
                ->get();
        } else {

            $trims_dashboard = TrimsAccessoriesStore::where('buyer_name', $buyer_name)
                ->select(
                    'buyer_name',
                    'style_or_no',
                    'color_name',
                    'item_no',
                    'unit',
                    DB::raw('SUM(booking_qty) as total_booking_qty'),
                    DB::raw('SUM(receive_qty) as total_receive_qty'),
                    DB::raw('SUM(issue_qty) as total_issue_qty'),
                    DB::raw('SUM(in_hand_qty) as total_in_hand_qty'),
                    DB::raw('SUM(rcv_bal_qty) as total_rcv_bal_qty'),
                    DB::raw('GROUP_CONCAT(DISTINCT rack_no ORDER BY rack_no SEPARATOR ",") as rack_no'),
                    DB::raw('GROUP_CONCAT(DISTINCT self_bin_no ORDER BY self_bin_no SEPARATOR ",") as self_bin_no')
                )
                ->groupBy(['buyer_name', 'style_or_no', 'color_name', 'item_no', 'unit'])
                ->get();
        }

        return response()->json($trims_dashboard);
    }

}
