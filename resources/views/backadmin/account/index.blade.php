@extends('backadmin.layouts.master')

@section('vendor-css')
    @include('backadmin.layouts.style_datatables')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.account.index') }}">Account</a></li>
@endsection

@section('action')
<a href="{{ route('backadmin.account.create') }}" class="btn btn-primary"><i data-feather="plus"></i> Account</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>AccountId</th> 
                        <th>Name</th> 
                        <th class="wb-table-col-action-1">Aksi</th>
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
        let url = "{{ route('backadmin.account.edit', '__id') }}";
        let icon = feather.icons['log-out'].toSvg();

        let table = $('#table').DataTable({
            ajax: {
                url: "{{ route('backadmin.account.index') }}"
            },
            serverSide: true,
            processing: true,
            columns: [
                { 
                    data: 'DT_RowIndex',
                    className: 'text-center',
                },
                { 
                    data: 'id',
                    className: 'text-center',
                },
                { data: 'name',
                    className: 'text-center', },
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

