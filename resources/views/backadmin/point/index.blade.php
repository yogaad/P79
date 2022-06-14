@extends('backadmin.layouts.master')

@section('vendor-css')
    @include('backadmin.layouts.style_datatables')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.point.index') }}">point </a></li>
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
                        <th>AccountName</th> 
                        <th>TotalPoint</th> 
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
        

        let table = $('#table').DataTable({
            data :{!! json_encode($dataz) !!},
            
            columns: [
                { 
                    data: 'num',
                    className: 'text-center',
                },
                { data: 'id'
                    
                },
                { data: 'name' },
                { data: 'point' },
               
            ],
            order: [[0, 'asc']],
            language: dtLangId
        });
        
    })
</script>
@endpush

