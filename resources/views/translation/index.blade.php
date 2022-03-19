 
@extends('layouts.app')
@section('title', 'translations')
    
@section('content')
 
<!-- Main content -->
<section class="content"> 
    <!--
        <div class="">
            <button type="button" class="add_btn btn-modal" data-href="{{ action('LanguageController@create') }}"
                data-container=".translation_modal">
                <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
        </div>  
    -->
        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">{{ __('language') }}</label>
                    <select class="form-control language-filter">
                        @foreach(App\Language::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
             
            <div class="col-md-3 hidden">
                <div class="form-group">
                    <label for="">{{ __('business_type') }}</label>
                    <select class="form-control business-filter">
                        @foreach(App\BusinessType::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group" style="padding-top: 20px" >
                    <button class="btn btn-warning" onclick="filterTrans($('.language-filter').val(), $('.business-filter').val())" >@trans('search')</button>
                    <button class="btn btn-warning" onclick="filterTrans($('.language-filter').val(), $('.business-filter').val())" >@trans('cache translation')</button>
                    <button class="btn btn-warning hidden" onclick="$('.copy-trans-modal').modal('show')" >@trans('copy translation')</button>
                    <button class="btn w3-green" onclick="saveTrans()" >{{ __('save') }}</button>
                </div>
            </div> 
        </div>
        <div class="table-responsive w3-light-gray">
            <table data-title="translations" class="table table-bordered table-striped" id="translation_table">
                <thead>
                    <tr>
                        <th style="width: 15%" >{{ __( 'business_type' ) }}</th> 
                        <th style="width: 10%" >{{ __( 'language' ) }}</th>
                        <th style="width: 10%" >{{ __( 'key' ) }}</th>
                        <th style="width: 65%" >{{ __( 'trans' ) }}</th> 
                    </tr>
                </thead>
            </table>
        </div> 


    <div class="modal fade translation_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

    @include("translation.copy")

</section>
<!-- /.content --> 
@stop
@section('javascript')

 
<script>

    var transList = [];
    
    //translationiness type table
    var translation_table = $('#translation_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/translations',
        @include("layouts.partials.datatable_plugin")
        columnDefs: [],
        columns: [
            { 
                data: 'business_type_id'
            },
            { 
                data: 'language_id'
            },
            {
                data: 'key' 
            },
            {
                data: 'trans'
            },
        ], 
        "initComplete": function(settings, json) { 
             
        }
    });

    function filterTrans(language, businessType) {
        var data = {
            language_id: language,
            business_type_id: businessType,
            load: 1
        };
        var url = '/translations?' + $.param(data);
        translation_table.ajax.url(url);
        translation_table.ajax.reload();

        data = {
            language_id: language,
            business_type_id: businessType, 
        };
        url = '/translations?' + $.param(data);
        translation_table.ajax.url(url);
    }

    function addToTransSaveList(input) {
        var data = {
            id: $(input).data('id'),
            value: input.value
        };

        transList.push(data);
    }

    function saveTrans() {
        var data = {
            data: JSON.stringify(transList),
            _token: '{{ csrf_token() }}'
        };
        $.post("{{ action('TransController@store') }}", data, function(r){
            if (r.status == 1) {
                toastr.success(r.message);
                translation_table.ajax.reload();
                transList = [];
            } else {
                toastr.error(r.message);
            } 
        });
    }

    $(document).ready(function(){
        formAjax();
        filterTrans($('.language-filter').val(), $('.business-filter').val());
    });
 
</script>
@endsection
 

