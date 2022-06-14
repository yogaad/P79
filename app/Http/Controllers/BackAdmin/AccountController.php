<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str; 

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $title = 'Account';

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $account = Account::query(); 

            return DataTables::of($account->get())->addIndexColumn()->make();
        }

        return view('backadmin.account.index')->with([
            'title' => 'List',
            'subtitle' => 'Account'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backadmin.account.form', [
            'title' => 'Form',
            'subtitle' => $this->title,
            'data' => new Account
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
            'name' => 'required'
        ]);
        try {
            DB::beginTransaction();
                   $data = Account::make($request->except('_token'));
                   $data->save();
               
                
                    
            DB::commit();
        } catch (InvalidEntityException $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withInput()->withError($e->getMessage());
        }

        return redirect()->route('backadmin.account.index')->withSuccess('Account berhasil disimpan');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('backadmin.account.form', [
            'title' => 'Form',
            'subtitle' => $account->name,
            'data' => $account
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => 'required'
        ]);
        try {
            DB::beginTransaction();
                $account->fill($request->except('_token'));
                
                $account->save();
                
            DB::commit();
        } catch (InvalidEntityException $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        
            return redirect()->route('backadmin.account.index')->withSuccess('account  berhasil diubah');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    { 
        $account->delete();
        return redirect()->route('backadmin.account.index')->withSuccess('kategoriProduk berhasil dihapus');
    
    }
    public function getS2Options(Request $request)
    {
        $term = $request->q;
        $query = Account::query()
            ->select('id','name')
            ->where('name', 'like', '%' . $term . '%');

        return $query->get();
    }
    public function getS2Init(Request $request)
    {
        return Account::select(['id', 'name'])
            ->where('id', $request->id)
            ->first();
    }
}
