@extends('backadmin.layouts.master')

@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.account.index') }}">Satuan</a></li>
@endsection

@section('actions')
<button type="submit" form="form-main" formaction="{{ $data->id ? route('backadmin.account.update', $data->id) : route('backadmin.account.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
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
                                <label for="name" class="form-label required">Name</label>
                                <input type="text" 
                                    name="name"
                                    v-model="data.name" 
                                    class="form-control @error('name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="input name" autocomplete="off">
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div> 
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
                <form action="{{ route('backadmin.account.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus data ini?</p>
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
              
            }
        },
        mounted() {
           
           
        },
        computed: {

        }
    }).mount('#app');
</script>
@endpush

