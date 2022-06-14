<?php

namespace App\Http\Controllers\BackAdmin;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\Desc;
use App\Models\Debit;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str; 

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::query()->with('account')->orderBy('created_at','desc');

            if ($request->has('account_filter') && $request->account_filter != 'all') {
                $data->where('accountId', $request->account_filter);
            }

            if ($request->has('startDate') && $request->has('endDate') && $request->startDate != 'all' && $request->endDate != 'all' ) {
                $data->where('transactionDate', '>=', $request->startDate )
                ->where('transactionDate', '<=',  $request->endDate  ) ;
            }

            return DataTables::of($data->get())->addIndexColumn()
            ->addColumn('credit',function($data) use ($request) {
                if ($data->debitCreditStatus=='2'){
                    $hasil_rupiah = "Rp " . number_format($data->amount,2,',','.');
                    return  $hasil_rupiah; 
                }else{
                    return '-';
                }

                
            })
            ->addColumn('description',function($data) use ($request) {
           
                return $data->descx->desc;
            })
            ->addColumn('transactionDate',function($data) use ($request) {
                $k =  date("Y-m-d", strtotime($data->transactionDate));
                 return  $k;
             })
            ->addColumn('debit',function($data) use ($request) {
                if ($data->debitCreditStatus=='1'){
                    $hasil_rupiah = "Rp " . number_format($data->amount,2,',','.');
                    return  $hasil_rupiah; 
                }else{
                    return '-';
                }
                
                
            })
            ->addColumn('amount',function($data) use ($request) {
                $hasil_rupiah = "Rp " . number_format($data->amount,2,',','.');
                 return  $hasil_rupiah;
             })
            ->make();
        }

        return view('backadmin.report.index')->with([
            'title' => 'List',
            'subtitle' => 'Report',
            'account' => Account::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
