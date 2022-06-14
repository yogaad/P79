<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use App\Models\Logo;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class UserController extends Controller
{
    private $title = 'Pengguna';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::query()->where('username', '!=', 'superadmin');
            if ($request->has('filter_type') && $request->filter_type != 'all') {
                $user = $user->where('type', $request->filter_type);
            }

            return DataTables::of($user->get())->addIndexColumn()->make();
        }

        return view('backadmin.user.index')->with([
            'title' => 'List',
            'subtitle' => 'Pengguna'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backadmin.user.form', [
            'title' => 'Form',
            'subtitle' => $this->title,
            'data' => new User
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
        // dd($request->all());
        $request['password'] = bcrypt($request['password']);
        $request->validate([
            'name' => 'required'
        ]);
        try {
            DB::beginTransaction();
                $data = User::withTrashed()->where('username',$request->username)->first();
                if($data) {
                    $data->restore();
                    $data->fill($request->except('_token','repassword'));
                } else {
                    $data = User::make($request->except('_token','repassword'));
                }
                $data->save();
                if($request->role == 'client'){
                    $request['nama'] = $request->name;
                    $request['user_id'] = $data->id;
                    $client = Client::where('user_id',$data->id)->first();
                    if($client) {
                        $client->fill($request->only('nama','alamat','email','nohp','user_id'));
                    } else {
                        $client = Client::make($request->only('nama','alamat','email','nohp','user_id'));
                        $client->save();
                    }
                }
                    
            DB::commit();
        } catch (InvalidEntityException $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withInput()->withError($e->getMessage());
        }

        return redirect()->route('backadmin.users.index')->withSuccess('User berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('backadmin.user.form', [
            'title' => 'Form',
            'subtitle' => $user->name,
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request['password'] = bcrypt($request['password']);
        $request->validate([
            'name' => 'required'
        ]);
        try {
            DB::beginTransaction();
                $user->fill($request->except('_token','repassword'));
                $user->role = $request->role;
                $user->save();
                if($request->role == 'client'){
                    $request['nama'] = $request->name;
                    $client = Client::where('user_id',$user->id)->first();
                    if(!$client) 
                        $client = new Client;
                    
                    $client->fill($request->only('nama','alamat','email','nohp'));
                    $client->save();
                }
            DB::commit();
        } catch (InvalidEntityException $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        if (auth()->user()->role=="client"){
            return redirect()->back()->withSuccess('User berhasil diubah');
        }else{
            return redirect()->route('backadmin.users.index')->withSuccess('User berhasil diubah');

        }
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('backadmin.users.index')->withSuccess('User berhasil dihapus');
    }

    public function logos(Request $request)
    { 
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'mimes:jpeg,jpg,png|max:5120',
            ]);
            $logo = Logo::where('name','logo')->first();
            if(!$logo) {
                $logo = new Logo();
                $logo->name = 'logo';
            }
            $logo->storeFile($request->logo);
            $logo->save();
        }

        if ($request->hasFile('logologin')) {
            $request->validate([
                'logologin' => 'mimes:jpeg,jpg,png|max:5120',
            ]);
            $logologin = Logo::where('name','logologin')->first();
            if(!$logologin) {
                $logologin = new Logo();
                $logologin->name = 'logologin';
            }
            $logologin->storeFile($request->logologin);
            $logologin->save();
        }

        if ($request->hasFile('logofavicon')) {
            $request->validate([
                'logofavicon' => 'mimes:ico,icon|max:5120',
            ]);
            $logofavicon = Logo::where('name','logofavicon')->first();
            if(!$logofavicon) {
                $logofavicon = new Logo();
                $logofavicon->name = 'logofavicon';
            }
            $logofavicon->storeFile($request->logofavicon);
            $logofavicon->save();
        }

        return redirect()->back()->withSuccess('Logo Berhasil Diubah');
    }
}
