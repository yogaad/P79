@extends('backadmin.layouts.master')

@section('vendor-css')
    @include('backadmin.layouts.style_datatables')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.transaction.index') }}">transaction</a></li>
@endsection

@section('action')
<a href="{{ route('backadmin.transaction.create') }}" class="btn btn-primary"><i data-feather="plus"></i>  transaction</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>AccountName</th> 
                        <th>TransactionDate</th> 
                        <th>Description</th> 
                        <th>DebitCredit</th> 
                        <th>Amount</th> 
                        <th class="wb-table-col-action-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('vendor-js')
    @include('backadmin.layouts.script_datatables')
@endsection

@push('page-js')
<script>
    $(document).ready(function() {
        let url = "{{ route('backadmin.transaction.edit', '__id') }}";
        let icon = feather.icons['log-out'].toSvg();

        let table = $('#table').DataTable({
            ajax: {
                url: "{{ route('backadmin.transaction.index') }}"
            },
            serverSide: true,
            processing: true,
            columns: [
                { 
                    data: 'DT_RowIndex',
                    className: 'text-center',
                },
                { data: 'name' },
                { data: 'transactionDate' },
                { data: 'description' },
                { data: 'debitCreditStatus' },
               { data: 'amount' },
                
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false, 
                    render: function(data, type, row, meta) {
                        return '<a href="' + url.replace('__id', data) + '" class="btn btn-primary btn-sm btn-icon rounded-circle">' + icon + '</a>'
                    } 
                }
            ],
            order: [[0, 'desc']],
            language: dtLangId
        });
        
    })
</script>
@endpush

