<?php

namespace App\Http\Controllers;

use App\Models\FabricInformationBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FabricInformationBoardController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', FabricInformationBoard::class); // Check if the user can view any FabricInformationBoard
        $fabrics = FabricInformationBoard::all();
        return view('backend.library.fabrics.index', compact('fabrics'));
    }


    public function create()
    {

        $this->authorize('create', FabricInformationBoard::class); // Check if the user can create a FabricInformationBoard
        $fabric = FabricInformationBoard::all();
        return view('backend.library.fabrics.create', compact('fabric'));
    }


    public function store(Request $request)
    {
        $this->authorize('create', FabricInformationBoard::class); // Check if the user can create a FabricInformationBoard
        // dd($request->all()); 

        $request->validate([
            'date' => 'required',
            'buyer_name' => 'required',
            'style_or_no' => 'required',
            'booking_qty' => 'required',
            'receive_qty' => 'required',
            'rcv_bal_qty' => 'required',
        ]);



        $fabrics = new FabricInformationBoard;
        $fabrics->company_id = auth()->user()->company_id;
        $fabrics->division_id =  auth()->user()->division_id;
        $fabrics->department_id = auth()->user()->department_id;
        $fabrics->date = $request->input('date');
        //convert to uppercase 
        $fabrics->buyer_name = ucwords($request->input('buyer_name'));
        $fabrics->style_or_no = ucwords($request->input('style_or_no'));
        $fabrics->order_qty = $request->input('order_qty');
        $fabrics->fabric_type = $request->input('fabric_type');
        $fabrics->color_name = $request->input('color_name');
        $fabrics->lot = $request->input('lot');
        $fabrics->dia = $request->input('dia');
        $fabrics->gsm = $request->input('gsm');
        $fabrics->parts = $request->input('parts');
        $fabrics->cons_dz = $request->input('cons_dz');
        $fabrics->booking_qty = $request->input('booking_qty');
        $fabrics->receive_qty = $request->input('receive_qty');
        $fabrics->rcv_bal_qty = $request->input('rcv_bal_qty');
        $fabrics->dlv_cutting = $request->input('dlv_cutting');
        $fabrics->closing_stock = $request->input('closing_stock');
        $fabrics->rack_no = $request->input('rack_no');
        $fabrics->self_bin_no = $request->input('self_bin_no');
        $fabrics->remarks = $request->input('remarks');
        $fabrics->created_by = auth()->user()->id;
        $fabrics->created_date = now();

        $fabrics->save();

        // Redirect
        return redirect()->route('fabrics.index')->withMessage('FabricInformationBoard and related data added successfully!');
    }


    public function show($id)
    {

        $fabrics = FabricInformationBoard::findOrFail($id);
        $this->authorize('viewAny', $fabrics); // Check if the user can view the specific FabricInformationBoard
        return view('backend.library.fabrics.show', compact('fabrics'));
    }


    public function edit($id)
    {

        $fabric = FabricInformationBoard::findOrFail($id);
        $this->authorize('update', $fabric); // Check if the user can update the specific fabrics
        return view('backend.library.fabrics.edit', compact('fabric'));
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
        ]);





        // Data update
        $fabric = FabricInformationBoard::findOrFail($id);
        $this->authorize('update', $fabric); // Check if the user can update the specific fabrics

        $fabric->company_id = auth()->user()->company_id;
        $fabric->division_id =  auth()->user()->division_id;
        $fabric->department_id = auth()->user()->department_id;
        $fabric->date = $request->date;
        //convert to uppercase 
        $fabric->buyer_name = ucwords($request->input('buyer_name'));
        $fabric->style_or_no = ucwords($request->input('style_or_no'));
        $fabric->order_qty = $request->input('order_qty');
        $fabric->fabric_type = $request->input('fabric_type');
        $fabric->color_name = $request->input('color_name');
        $fabric->lot = $request->input('lot');
        $fabric->dia = $request->input('dia');
        $fabric->gsm = $request->input('gsm');
        $fabric->parts = $request->input('parts');
        $fabric->cons_dz = $request->input('cons_dz');
        $fabric->booking_qty = $request->input('booking_qty');
        $fabric->receive_qty = $request->input('receive_qty');
        $fabric->rcv_bal_qty = $request->input('rcv_bal_qty');
        $fabric->dlv_cutting = $request->input('dlv_cutting');
        $fabric->closing_stock = $request->input('closing_stock');
        $fabric->rack_no = $request->input('rack_no');
        $fabric->self_bin_no = $request->input('self_bin_no');
        $fabric->remarks = $request->input('remarks');

        $fabric->updated_by = auth()->user()->id;
        $fabric->updated_date = date('Y-m-d H:i:s');
        $fabric->remarks = $request->remarks;

        $fabric->save();

        // Redirect
        return redirect()->route('fabrics.index')->withMessage('FabricInformationBoard and related data updated successfully!');
    }


    public function destroy($id)
    {

        $fabric = FabricInformationBoard::findOrFail($id);
        $this->authorize('delete', $fabric); // Check if the user can delete the specific fabrics

        $fabric->delete();

        return redirect()->route('fabrics.index')->withMessage('FabricInformationBoard and related data  are deleted successfully!');
    }

    public function dashboard()
    {
        // $trims_dashboard = TrimsAccessoriesStore::all()->groupBy(['buyer_name', 'style_or_no', 'color_name', 'order_qty', 'unit']);

        $fabrics_dashboard = FabricInformationBoard::select(
            'buyer_name',
            'style_or_no',
            'color_name',
            'fabric_type',
            'order_qty',
            'lot',
            'dia',
            'gsm',
            'parts',
            DB::raw('SUM(order_qty) as total_order_qty'), 
            DB::raw('SUM(booking_qty) as total_booking_qty'),
            DB::raw('SUM(receive_qty) as total_receive_qty'),
            DB::raw('SUM(rcv_bal_qty) as total_rcv_bal_qty'),
            DB::raw('SUM(dlv_cutting) as total_dlv_cutting'),
            DB::raw('SUM(closing_stock) as total_closing_stock'),
            DB::raw('GROUP_CONCAT( DISTINCT rack_no ORDER BY rack_no SEPARATOR ",") as rack_no'),
            DB::raw('GROUP_CONCAT( DISTINCT self_bin_no ORDER BY self_bin_no SEPARATOR ",") as self_bin_no')
        )
            ->groupBy([
                'buyer_name',
                'style_or_no',
                'color_name',
                'fabric_type',
                'order_qty',
                'lot',
                'dia',
                'gsm',
                'parts'
            ])
            ->get();
        // dd($trims_dashboard);

        return view('backend.dashboard.fabrics', compact('fabrics_dashboard'));
    }

    public function getfabricsDashboard(Request $request)
    {
        $buyer_name = $request->input('buyer_name');
        if ($buyer_name == 'all') {
            $fabrics_dashboard = FabricInformationBoard::select(
                'buyer_name',
                'style_or_no',
                'color_name',
                'fabric_type',
                'order_qty',
                'lot',
                'dia',
                'gsm',
                'parts',
                DB::raw('SUM(order_qty) as total_order_qty'), 
                DB::raw('SUM(booking_qty) as total_booking_qty'),
                DB::raw('SUM(receive_qty) as total_receive_qty'),
                DB::raw('SUM(rcv_bal_qty) as total_rcv_bal_qty'),
                DB::raw('SUM(dlv_cutting) as total_dlv_cutting'),
                DB::raw('SUM(closing_stock) as total_closing_stock'),
                DB::raw('GROUP_CONCAT( DISTINCT rack_no ORDER BY rack_no SEPARATOR ",") as rack_no'),
                DB::raw('GROUP_CONCAT( DISTINCT self_bin_no ORDER BY self_bin_no SEPARATOR ",") as self_bin_no')
            )
                ->groupBy([
                    'buyer_name',
                    'style_or_no',
                    'color_name',
                    'fabric_type',
                    'order_qty',
                    'lot',
                    'dia',
                    'gsm',
                    'parts'
                ])
                ->get();
        } else {

            $fabrics_dashboard = FabricInformationBoard::where('buyer_name', $buyer_name)
                ->select(
                    'buyer_name',
                    'style_or_no',
                    'color_name',
                    'fabric_type',
                    'order_qty',
                    'lot',
                    'dia',
                    'gsm',
                    'parts',
                     DB::raw('SUM(order_qty) as total_order_qty'), 
                    DB::raw('SUM(booking_qty) as total_booking_qty'),
                    DB::raw('SUM(receive_qty) as total_receive_qty'),
                    DB::raw('SUM(rcv_bal_qty) as total_rcv_bal_qty'),
                    DB::raw('SUM(dlv_cutting) as total_dlv_cutting'),
                    DB::raw('SUM(closing_stock) as total_closing_stock'),
                    DB::raw('GROUP_CONCAT( DISTINCT rack_no ORDER BY rack_no SEPARATOR ",") as rack_no'),
                    DB::raw('GROUP_CONCAT( DISTINCT self_bin_no ORDER BY self_bin_no SEPARATOR ",") as self_bin_no')
                )
                ->groupBy([
                    'buyer_name',
                    'style_or_no',
                    'color_name',
                    'fabric_type',
                    'order_qty',
                    'lot',
                    'dia',
                    'gsm',
                    'parts'
                ])
                ->get();
        }

        return response()->json($fabrics_dashboard);
    }
}
