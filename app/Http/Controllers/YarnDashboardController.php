<?php

namespace App\Http\Controllers;

use App\Models\GreyDashboard;
use App\Models\YarnDashboard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class YarnDashboardController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', YarnDashboard::class); // Check if the user can view any YarnDashboard
        // $yarns = YarnDashboard::all();
        // return view('backend.library.yarns.index', compact('yarns'));

        $yarnCollection = YarnDashboard::latest();
        $search_yarn = null; // Initialize the variable


        // Check if the entry_date fields are filled
        if (request('entry_date_start') && request('entry_date_end')) {
            $yarnCollection = $yarnCollection->whereBetween('date', [
                request('entry_date_start'),
                request('entry_date_end')
            ]);
            $search_yarn = $yarnCollection->get();
            session(['search_yarn' => $search_yarn]);
        }

        $yarns = $yarnCollection->paginate(1000);

        // Check if export format is requested
        $format = strtolower(request('export_format'));

        if ($format === 'xlsx') {
            // Store the necessary values in the session
            session(['export_format' => $format]);

            // Retrieve the values from the session
            $format = session('export_format');
            $search_yarn = session('search_yarn');

            if ($search_yarn == null) {
                return redirect()->route('yarn.download')->withErrors('First search the data then export');
            } else {
                $data = compact('search_yarn');
                // Generate the view content based on the requested format
                $viewContent = View::make('backend.download.yarns_excel', $data)->render();

                // Set appropriate headers for the file download
                $filename = 'yarn' . '_' . Carbon::now()->format('Y_m_d') . '_' . time() . '.xls';
                $headers = [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                    'Content-Transfer-Encoding' => 'binary',
                    'Cache-Control' => 'must-revalidate',
                    'Pragma' => 'public',
                    'Content-Length' => strlen($viewContent)
                ];

                // Use the "binary" option in response to ensure the file is downloaded correctly
                return response()->make($viewContent, 200, $headers);
            }
        }

        return view('backend.library.yarns.index', compact('yarns', 'search_yarn'));
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

    public function commonDashboard()
    {
        $yarns = YarnDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        $grey_fabrics = GreyDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        return view('backend.dashboard.common', compact('yarns', 'grey_fabrics'));
    }

    public function getcommonDashboard()
    {
        $yarns = YarnDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        $grey_fabrics = GreyDashboard::whereMonth('date', date('m'))->orderBy('date', 'asc')->get();
        return response()->json(['yarns' => $yarns, 'grey_fabrics' => $grey_fabrics]);
    }
    public function download()
    {

        $yarnCollection = YarnDashboard::latest();
        $search_yarn = null; // Initialize the variable


        // Check if the entry_date fields are filled
        if (request('entry_date_start') && request('entry_date_end')) {
            $yarnCollection = $yarnCollection->whereBetween('date', [
                request('entry_date_start'),
                request('entry_date_end')
            ]);
            $search_yarn = $yarnCollection->get();
            session(['search_yarn' => $search_yarn]);
        }

        $yarns = $yarnCollection->paginate(10);

        // Check if export format is requested
        $format = strtolower(request('export_format'));

        if ($format === 'xlsx') {
            // Store the necessary values in the session
            session(['export_format' => $format]);

            // Retrieve the values from the session
            $format = session('export_format');
            $search_yarn = session('search_yarn');

            if ($search_yarn == null) {
                return redirect()->route('yarn.download')->withErrors('First search the data then export');
            } else {
                $data = compact('search_yarn');
                // Generate the view content based on the requested format
                $viewContent = View::make('backend.download.yarns_excel', $data)->render();

                // Set appropriate headers for the file download
                $filename = 'yarn' . '_' . Carbon::now()->format('Y_m_d') . '_' . time() . '.xls';
                $headers = [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                    'Content-Transfer-Encoding' => 'binary',
                    'Cache-Control' => 'must-revalidate',
                    'Pragma' => 'public',
                    'Content-Length' => strlen($viewContent)
                ];

                // Use the "binary" option in response to ensure the file is downloaded correctly
                return response()->make($viewContent, 200, $headers);
            }
        }

        return view('backend.download.yarns_download', compact('yarns', 'search_yarn'));
    }
}
