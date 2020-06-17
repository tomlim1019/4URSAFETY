<?php

namespace App\Http\Controllers;

use App\PurchaseLog;

use App\Quotation;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $logsCounted = PurchaseLog::select('product_id', PurchaseLog::raw('count(*) as number'))
                    ->groupBy('product_id')
                    ->get();
        
        $pRequestCounted = Quotation::select('product_id', Quotation::raw('count(*) as number'))
                    ->where('status', '=', 'Pending')
                    ->groupBy('product_id')
                    ->get();

        $aRequestCounted = Quotation::select('product_id', Quotation::raw('count(*) as number'))
        ->where('status', '=', 'Approved')
        ->groupBy('product_id')
        ->get();

        return view('staff.report.report')->with('logs', $logsCounted)
                ->with('pendingRequests', $pRequestCounted)
                ->with('approvedRequests', $aRequestCounted);
    }
}
