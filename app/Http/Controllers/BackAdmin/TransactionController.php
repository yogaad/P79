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

class TransactionController extends Controller
{
    private $title = 'Transaction';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
         
        if ($request->ajax()) {
            $acc =Transaction::query(); 
            

            return DataTables::of($acc->get())->addIndexColumn()
            ->addColumn('description',function($data) use ($request) {
           
                return $data->descx->desc;
            })
            ->addColumn('name',function($data) use ($request) {
           
                return $data->account->name;
            })
            ->addColumn('debitCreditStatus',function($data) use ($request) {
           
                return $data->debitx->debit;
            })
            
            
            ->addColumn('transactionDate',function($data) use ($request) {
               $k =  date("Y-m-d", strtotime($data->transactionDate));
                return  $k;
            })

            ->addColumn('amount',function($data) use ($request) {
                $hasil_rupiah = "Rp " . number_format($data->amount,2,',','.');
                 return  $hasil_rupiah;
             })
            
           

            ->make();
        }

        return view('backadmin.transaction.index')->with([
            'title' => 'List',
            'subtitle' => 'transaction' 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function create()
    {
        $mytime = Carbon::now();
        $k =  date("Y-m-d", strtotime($mytime->toDateTimeString()));
        return view('backadmin.transaction.form', [
            'title' => 'Form',
            'subtitle' => $this->title,
            'data' => new Transaction,
            'dateE' => $k 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
        $request->validate([
            'accountId' => 'required',
            'transactionDate' => 'required',
            'description' => 'required',
             'debitCreditStatus' => 'required',
            'amount' => 'required|numeric|min:3'
        ]);

        try {
            DB::beginTransaction();
                   $data = Transaction::make($request->except('_token'));
                   $data->save();
               
                
                    
            DB::commit();
        } catch (InvalidEntityException $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withInput()->withError($e->getMessage());
        }

        return redirect()->route('backadmin.transaction.index')->withSuccess('Transaction berhasil disimpan');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(transaction $transaction)
    {
        $k =  date("Y-m-d", strtotime($transaction->transactionDate));
        return view('backadmin.transaction.form', [
            'title' => 'Form',
            'subtitle' => $transaction->description,
            'data' => $transaction, 
            'dateE' => $k
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaction $transaction)
    {
        $request->validate([
            'accountId' => 'required',
            'transactionDate' => 'required',
            'description' => 'required',
             'debitCreditStatus' => 'required',
             'amount' => 'required|numeric|min:3'

        ]);
        try {
            DB::beginTransaction();
                $transaction->fill($request->except('_token'));
                
                $transaction->save();
                
            DB::commit();
        } catch (InvalidEntityException $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        
            return redirect()->route('backadmin.transaction.index')->withSuccess('Transaction berhasil diubah');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('backadmin.transaction.index')->withSuccess('Transaction berhasil dihapus');
    }

    public function getS2Options(Request $request)
    {
        $term = $request->q;
        $query = Desc::query()
            ->select('id','desc')
            ->where('desc', 'like', '%' . $term . '%');

        return $query->get();
    }
    public function getS2Init(Request $request)
    {
        return Desc::select(['id', 'desc'])
            ->where('id', $request->id)
            ->first();
    }
    public function getS21ptions(Request $request)
    {
        $term = $request->q;
        $query = Debit::query()
            ->select('id','debit','ket')
            ->where('ket', 'like', '%' . $term . '%');

        return $query->get();
    }
    public function getS22nit(Request $request)
    {
        return Debit::select(['id', 'debit','ket'])
            ->where('id', $request->id)
            ->first();
    }
}
