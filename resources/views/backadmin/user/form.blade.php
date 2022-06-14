@extends('backadmin.layouts.master')

@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.users.index') }}">Satuan</a></li>
@endsection

@section('actions')
<button type="submit" form="form-main" formaction="{{ $data->id ? route('backadmin.users.update', $data->id) : route('backadmin.users.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @if($data->id)
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</button>
    @endif
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app">
                <form id="form-main" method="post">
                    @csrf
                    @if ($data->id)
                        @method('PUT')
                    @endif
                    <section class="pr-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 form-group" 
                            >
                                <label for="name" class="form-label required">Nama</label>
                                <input type="text" 
                                    name="name"
                                    v-model="data.name" 
                                    class="form-control @error('name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan nama" autocomplete="off">
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            {{-- @{{data.name}} --}}
                            <div class="col-12 form-group" 
                            >
                                <label for="name" class="form-label required">Nama Lengkap</label>
                                <input type="text" 
                                    name="fullname"
                                    v-model="data.fullname" 
                                    class="form-control @error('fullname') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan nama" autocomplete="off">
                                @error('fullname')
                                    <small class="text-danger">{{ $errors->first('fullname') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="nohp" class="form-label required">Nomor HP</label>
                                <input type="text" 
                                    name="nohp"
                                    v-model="data.nohp" 
                                    class="form-control @error('nohp') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan nohp" autocomplete="off">
                                @error('nohp')
                                    <small class="text-danger">{{ $errors->first('nohp') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-6 form-group">
                                <label for="role" class="form-label required">Role</label>
                                @if(auth()->user()->role != 'client')
                                <select
                                    data-placeholder="Pilih Role"
                                    name="role"
                                    v-model="data.role" 
                                    class="form-control @error('role') {{ 'is-invalid' }} @enderror">
                                    <option value="client">Client</option>
                                    <option value="hr">Human Resource</option>
                                </select>
                                @endif
                                @if(auth()->user()->role == 'client')
                                <input type="text" 
                                name="role"
                                v-model="data.role" readonly 
                                class="form-control"  >
                                @endif
                                @error('role')
                                    <small class="text-danger">{{ $errors->first('role') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-md-12 form-group">
                                <label for="alamat" class="form-label required">Alamat</label>
                                <textarea rows="5"
                                    name="alamat"
                                    v-model="data.alamat" 
                                    class="form-control @error('alamat') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan alamat" autocomplete="off"></textarea>
                                @error('alamat')
                                    <small class="text-danger">{{ $errors->first('alamat') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-6 form-group">
                                <label for="username" class="form-label required">Username</label>
                                <input type="text" 
                                    name="username"
                                    v-model="data.username" 
                                    class="form-control @error('username') {{ 'is-invalid' }} @enderror"   @if(auth()->user()->role == 'client') readonly @endif
                                    placeholder="Masukkan Username" autocomplete="off">
                                @error('username')
                                    <small class="text-danger">{{ $errors->first('username') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="email" class="form-label required">Email</label>
                                <input type="text" 
                                    name="email"
                                    v-model="data.email" 
                                    class="form-control @error('email') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan email" autocomplete="off">
                                @error('email')
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="password" class="form-label required">Password</label>
                                <input type="password" 
                                    name="password"
                                    class="form-control @error('password') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan password" autocomplete="off">
                                @error('password')
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="repassword" class="form-label required">Konfirmasi Password</label>
                                <input type="password" 
                                    name="repassword"
                                    class="form-control @error('repassword') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan repassword" autocomplete="off">
                                @error('repassword')
                                    <small class="text-danger">{{ $errors->first('repassword') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        </div><!-- .row -->
                    </section><!-- .pr-form-main -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('modal')
    @if ($data->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.users.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus User ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Hapus</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endpush

@section('vendor-js')
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
@endsection

@push('page-js')
<script>
    let form = Vue.createApp({
        data() {
            return {
                data: {

                },
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            data = {!! json_encode($data) !!};
            this.data = {
                name: old.name ?? data.name ?? '',
                fullname: old.fullname ?? data.fullname ?? '',
                username: old.username ?? data.username ?? '',
                email: old.email ?? data.email ?? '',
                password: old.password ?? data.password ?? '',
                repassword: old.repassword ?? data.repassword ?? '',
                nohp: old.nohp ?? data.nohp ?? '',
                role: old.role ?? data.role ?? '',
                alamat: old.alamat ?? data.alamat ?? ''
            }
        },
        mounted() {
            $('select[name=role]').select2().on('select2:select', function(e) { form.data.role = e.target.value });
           
        },
        computed: {

        }
    }).mount('#app');
</script>
@endpush

