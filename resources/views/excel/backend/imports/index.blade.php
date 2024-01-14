@extends('backend.layouts.main')

@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">範例檔案</h3>
        </div>
        <div class="block-content block-content-full">
            <div>
                <ul>
                    <li class="text-danger">匯入檔案輸入完成後，請輸出成csv檔案上傳</li>
                    <li class="text-danger">匯入資料從第4行開始</li>
                    <li class="text-danger">紅色字為必須填寫欄位</li>
                    <li class="text-danger">請依照欄位提示，填寫正確資料</li>
                </ul>
            </div>
            <table class="table table-bordered table-hover table-striped table-vcenter js-dataTable-full nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">
                            {{ __("excel::backend.downloads.name") }}
                        </th>
                        <th class="text-center">
                            {{ __("excel::backend.download") }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $key = 1;
                    @endphp
                    @foreach(config('excel.import.types') as $table => $type)
                    <tr>
                        <td class="text-center">{{($key)}}</td>
                        <td class="text-center">{{$type['name']}}</td>
                        <td class="text-center">
                            <a href="{{route('backend.excel.import.index', ['downlaod' => $table, 'action' => 'download'])}}" target="_blank">
                                <i class="fa fa-download"></i>
                            </a>
                        </td>
                    </tr>
                    @php
                    $key ++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('list') }}</h3>
            <a href="{{ route('backend.excel.import.create') }}" class="btn btn-success">匯入</a>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-hover table-striped table-vcenter js-dataTable-full nowrap" id="data-table" style="width:100%">
                <thead>
                </thead>
            </table>
        </div>
    </div>
@stop

@push('scripts')
<script>
$(function() {
    var url = '{{ route('backend.excel.import.index') }}';
    var search = makeDataTable(
        "#data-table",
        url,
        "GET",
        function() {
        },
        [
            { data: 'id', title: '#', bSearchable: false, bSortable: false, render: function ( data, type, row , meta ) {
                return  meta.row + 1;
            }},
            { data: 'name', title: '{{ __("excel::backend.excel_imports.name") }}' },
            { data: 'status', title: '{{ __("excel::backend.excel_imports.status") }}', render:function(data){
                let color = 'bg-warning';
                let text = '處理中';
                if(data == 1) {
                    color = 'bg-success';
                    text = '匯入成功';
                }else if (data ==2){
                    color = 'bg-danger';
                    text = '匯入失敗';
                }
                return `<span class="badge ${color}">${text}</span>`
            } },
            { data: 'error', title: '{{ __("excel::backend.excel_imports.error") }}', width: "250" },
            { data: 'created_at', title: '{{ __('created_at') }}' },
        ],
        function(){
        },
        {
            ordering:true,
            order:[[4,'desc']]
        }
    );
});
</script>
@endpush
