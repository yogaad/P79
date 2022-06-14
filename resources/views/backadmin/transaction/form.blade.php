@extends('backadmin.layouts.master')

@section('vendor-css')
 
    <link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">   
    
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.transaction.index') }}">transaction</a></li>
@endsection

@section('actions')
<button type="submit" form="form-main" formaction="{{ $data->id ? route('backadmin.transaction.update', $data->id) : route('backadmin.transaction.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @if($data->id)
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</button>
    @endif
@endsection
<script>
    function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
            
</script>

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app">
                <form id="form-main" method="post"  >
                    @csrf
                    @if ($data->id)
                        @method('PUT')
                    @endif
                    <section class="pr-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            <div class="col-6 col-md-6 form-group">
                                <label for="accountId" class="form-label required">AccountName</label>
                                <select
                                    name="accountId"
                                    class="form-control @error('accountId') {{ 'is-invalid' }} @enderror">
                                </select>
                                @error('accountId')
                                    <small class="text-danger">{{ $errors->first('accountId') }}</small>
                                @enderror
                            </div>
                        
                            <div class="col-6 form-group" 
                            >
                                <label for="name" class="form-label required">TransactionDate</label>
                                <input type="date" 
                                    name="transactionDate"
                                    v-model="data.transactionDate" 
                                    class="form-control @error('transactionDate') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Transaction Date" autocomplete="off">
                                @error('transactionDate')
                                    <small class="text-danger">{{ $errors->first('transactionDate') }}</small>
                                @enderror
                            </div> 
                        </div>
                            <div class="row">
                                <div class="col-6 col-md-6 form-group">
                                    <label for="description" class="form-label required">Description</label>
                                    <select
                                        name="description"
                                        class="form-control @error('description') {{ 'is-invalid' }} @enderror">
                                    </select>
                                    @error('description')
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6 form-group">
                                    <label for="debitCreditStatus" class="form-label required">DebitCredit</label>
                                    <select
                                        name="debitCreditStatus"
                                        class="form-control @error('debitCreditStatus') {{ 'is-invalid' }} @enderror">
                                    </select>
                                    @error('debitCreditStatus')
                                        <small class="text-danger">{{ $errors->first('debitCreditStatus') }}</small>
                                    @enderror
                                </div>
                            </div>
                                <div class="row">
                                    
                            <div class="col-6 form-group" 
                            >
                                <label for="name" class="form-label required">Amount</label>
                                <input type="text"  onkeypress='validate(event)' 
                                    name="amount"
                                    v-model="data.amount" 
                                    class="form-control @error('amount') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan amount" autocomplete="off">
                                @error('amount')
                                    <small class="text-danger">{{ $errors->first('amount') }}</small>
                                @enderror
                            </div> 
                           
                                </div>
                    
                            </section>
                            
                        
                            
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
                <form action="{{ route('backadmin.transaction.destroy', $data->id) }}" method="POST">
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
@endsection

@push('page-js') 
<script>
    let form = Vue.createApp({
        data() {
            return {
                data: {

                },
                dateE: {

                },
                
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            data = {!! json_encode($data) !!};
            dateE = {!! json_encode($dateE) !!};
           
            this.data = {
                transactionDate: old.transactionDate ?? dateE ??data.transactionDate ?? '', 
                amount: old.amount ?? data.amount ?? '',  
                accountId: old.accountId ?? data.accountId ?? 0,
                description: old.description ?? data.description ?? 0,
                debitCreditStatus: old.debitCreditStatus ?? data.debitCreditStatus ?? 0,
              
            } 
          
           
            if(this.data.accountId)
                initS2FieldWithAjax('[name=accountId]', "{{ route('backadmin.s2Init.edit-accounts')}}", {
                    id: this.data.accountId
                }, ['name']);

            if(this.data.description)
                initS2FieldWithAjax('[name=description]', "{{ route('backadmin.s2Init.edit-descs')}}", {
                    id: this.data.description
                }, ['desc']); 
                
            if(this.data.debitCreditStatus)
                initS2FieldWithAjax('[name=debitCreditStatus]', "{{ route('backadmin.s2Init.edit-debits')}}", {
                    id: this.data.debitCreditStatus
                }, ['ket']); 
     
                
          
             
        },
        mounted() {
           
            //select
            $('[name=accountId]').select2({
                ajax: {
                    url: "{{ route('backadmin.s2Opt.accounts') }}",
                    data: function(params) {
                        let query = {
                            q: params.term
                        };
                        return query;
                    },
                    processResults: function(data) {
                        return { results: data }
                    }
                },
                minimumInputLength: 2,
                placeholder: 'Masukkan Customer1/customer2/etc.',
                templateResult: function(data) {
                    return data.loading ? 'Mencari...' : data.name;
                },
                templateSelection: function(data) {
                    return data.text || data.name;
                },
                width: '100%'
            }).on('select2:select', function(e) {
                form.data.accountId = e.target.value;
            });

             //select
             $('[name=description]').select2({
                ajax: {
                    url: "{{ route('backadmin.s2Opt.descs') }}",
                    data: function(params) {
                        let query = {
                            q: params.term
                        };
                        return query;
                    },
                    processResults: function(data) {
                        return { results: data }
                    }
                },
                minimumInputLength: 2,
                placeholder: 'Masukkan Bayar Listrik/Tarik tunai/beli pulsa/setor tunai',
                templateResult: function(data) {
                    return data.loading ? 'Mencari...' : data.desc;
                },
                templateSelection: function(data) {
                    return data.text || data.desc;
                },
                width: '100%'
            }).on('select2:select', function(e) {
                form.data.description = e.target.value;
            });

             //select
             $('[name=debitCreditStatus]').select2({
                ajax: {
                    url: "{{ route('backadmin.s2Opt.debits') }}",
                    data: function(params) {
                        let query = {
                            q: params.term
                        };
                        return query;
                    },
                    processResults: function(data) {
                        return { results: data }
                    }
                },
                minimumInputLength: 2,
                placeholder: 'Masukkan Debit/credit',
                templateResult: function(data) {
                    return data.loading ? 'Mencari...' : data.ket ;
                },
                templateSelection: function(data) {
                    return data.text || data.ket;
                },
                width: '100%'
            }).on('select2:select', function(e) {
                form.data.debitCreditStatus = "asd";
            });

            
        },
        computed: {

        }
    }).mount('#app');
</script>
@endpush

