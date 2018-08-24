<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerformanceController extends Controller
{
    function index()
    {
        return view('performance.list');
    }

    function dataTable(Request $request)
    {
        $responseData = [];
        $columns = array(
            0 => 'id',
            1 => 'id',
            2 => 'full_url',
            3 => 'query_number',
            4 => 'caller_file_name',
            5 => 'function_name',
            6 => 'caller_line_number',
            7 => 'memory',
            8 => 'seconds',
            9 => 'source',
            10 => 'created_at',
        );

        $totalData = Performance::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->has('order.0.dir') ? $request->input('order.0.dir') : "desc";

        if (empty($request->input('search.value'))) {
            $performance = Performance::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $performance = Performance::where('id', 'LIKE', "%{$search}%")
                ->orWhere('full_url', 'LIKE', "%{$search}%")
                ->orWhere('query_number', 'LIKE', "%{$search}%")
                ->orWhere('get', 'LIKE', "%{$search}%")
                ->orWhere('post', 'LIKE', "%{$search}%")
                ->orWhere('function_name', 'LIKE', "%{$search}%")
                ->orWhere('caller_file_name', 'LIKE', "%{$search}%")
                ->orWhere('caller_line_number', 'LIKE', "%{$search}%")
                ->orWhere('memory', 'LIKE', "%{$search}%")
                ->orWhere('seconds', 'LIKE', "%{$search}%")
                ->orWhere('source', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = count($performance);
        }

        $responseData['draw'] = intval($request->input('draw'));
        $responseData['recordsTotal'] = $totalData;
        $responseData['recordsFiltered'] = $totalFiltered;
        $responseData['data'] = $performance;

        return response()
            ->json($responseData);
    }


    public function destroy()
    {
        try {
            DB::table("performance")->truncate();
            return redirect(route('performance'))->with('message', 'Performance log TRUNCATED!');;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}
