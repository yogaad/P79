@extends('backadmin.layouts.master')

@section('vendor-css')
    @include('backadmin.layouts.style_datatables')
    <link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.report.index') }}">Report</a></li>
@endsection

 

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>transactionDate</th>
                        <th>Description</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th  >Amount</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<template id="template">
    <label style="padding: 2 0.5rem">
        <select name="account_filter" id="account_filter" class="custom-select w-100">
            <option value="all" selected>Semua Account</option>
            @foreach ($account as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </label><br>
    <label style="padding: 0 0.5rem"> Start date
        <input type="date" 
        name="startDate" id ="startDate"
        class="form-control " 
        placeholder="Masukkan StartDate" >
   
    </label>
    <label style="padding: 0 0.5rem">End date
        <input type="date" 
        name="endDate"  id="endDate"
        class="form-control " 
        placeholder="Masukkan endDate" >
   
    </label>
</template>

@endsection

@section('vendor-js')
    @include('backadmin.layouts.script_datatables')
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
@endsection

@push('page-js')
<script>
    $(document).ready(function() {
        let url = "{{ route('backadmin.report.edit', '__id') }}";
        let icon = feather.icons['edit-2'].toSvg();

        let table = $('#table').DataTable({
            ajax: {
                url: "{{ route('backadmin.report.index') }}",
                data: function(data) {
                    data.account_filter = $('#account_filter').val() ?? 'all';
                    data.startDate = $('#startDate').val() ?? 'all';
                    data.endDate = $('#endDate').val() ?? 'all';
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { 
                    data: 'DT_RowIndex',
                    className: 'text-center',
                },
                { data: 'transactionDate' },
                { data: 'description' },
                { data: 'credit' },
                { data: 'debit' },
                { data: 'amount' },
            ],
            order: [[0, 'desc']],
            language: dtLangId
        });
        $('#table_length').append($('#template').html());
        $('#account_filter').select2({ width:'100%' }).change(function(e) {
            table.draw();
        });
        $('#endDate').change(function(e) {
            if( $("#startDate").val() ){
                table.draw();

            }
        });

        $('#startDate').change(function(e) {
            if( $("#endDate").val() ){
                table.draw();

            }
        });
    })
</script>
@endpush

