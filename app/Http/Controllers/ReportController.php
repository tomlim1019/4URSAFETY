<?php

namespace App\Http\Controllers;

use App\PurchaseLog;

use App\Quotation;

use App\User;

use App\Exports\UsersExport;
use App\Exports\SalesExport;
use App\Exports\RequestExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $logsCounted = PurchaseLog::select('product_id', PurchaseLog::raw('count(*) as number'))
                    ->groupBy('product_id')
                    ->get();
        
        $aCustomerCounted = User::where('status', '=', 'Approved')
                    ->where('role', '=', 'customer')
                    ->get();

        $aRequestCounted = Quotation::select('product_id', Quotation::raw('count(*) as number'))
                    ->where('status', '=', 'Approved')
                    ->groupBy('product_id')
                    ->get();

        return view('staff.report.report')->with('logs', $logsCounted)
                ->with('customerRequests', $aCustomerCounted)
                ->with('approvedRequests', $aRequestCounted);
    }

    public function export(Request $request)
    {
        if($request->report == 'sales')
        {
            return Excel::download(new SalesExport, 'sales.xlsx');
        }
        else if($request->report == 'customer')
        {
            return Excel::download(new UsersExport, 'users.xlsx');
        }
        else if($request->report == 'request')
        {
            return Excel::download(new RequestExport, 'requests.xlsx');
        }
    }
}
