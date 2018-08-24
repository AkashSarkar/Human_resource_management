<?php

namespace App\Http\Controllers;

use App\Models\ErrorR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ErrorRController extends Controller
{
    function index()
    {
        return view('error.list');
    }

    function dataTable(Request $request)
    {
        $responseData = [];
        $columns = array(
            0 => 'id',
            1 => 'id',
            2 => 'message',
            3 => 'file_name',
            4 => 'function_name',
            5 => 'line_number',
            6 => 'memory',
            7 => 'seconds',
            8 => 'source',
            9 => 'created_at',
        );

        $totalData = ErrorR::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->has('order.0.dir') ? $request->input('order.0.dir') : "desc";

        if (empty($request->input('search.value'))) {
            $errorr = DB::table('errorr')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $errorr = ErrorR::where('id', 'LIKE', "%{$search}%")
                ->orWhere('message', 'LIKE', "%{$search}%")
                ->orWhere('file_name', 'LIKE', "%{$search}%")
                ->orWhere('function_name', 'LIKE', "%{$search}%")
                ->orWhere('line_number', 'LIKE', "%{$search}%")
                ->orWhere('caller_file_name', 'LIKE', "%{$search}%")
                ->orWhere('caller_line_number', 'LIKE', "%{$search}%")
                ->orWhere('memory', 'LIKE', "%{$search}%")
                ->orWhere('seconds', 'LIKE', "%{$search}%")
                ->orWhere('source', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = count($errorr);
        }

        $responseData['draw'] = intval($request->input('draw'));
        $responseData['recordsTotal'] = $totalData;
        $responseData['recordsFiltered'] = $totalFiltered;
        $responseData['data'] = $errorr;

        return response()
            ->json($responseData);
    }

    public function destroy()
    {
        try {
            DB::table("errorr")->truncate();
            return redirect(route('errorr'))->with('message', 'Error log TRUNCATED!');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}
