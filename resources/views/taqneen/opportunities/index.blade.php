@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')

@endsection

@section('breadcrumb-title')
<h3>@trans('opportunities')</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">@lang('lang.Dashboard')</li>
<li class="breadcrumb-item active">@trans('opportunities')</li> 
@endsection

@section('content') 
    <div class="container-fluid">
        <div class="row"> 
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <div class="container-fluid">

                 </div><!-- /.container-fluid -->
                </section>
                <section>
                    <section class="content">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    {{-- <div class="card-header">
                                        <h5>@lang('lang.Opportunities')</h5>
                                    </div> --}}
                                    <div class="card-body">
                                        <a role="button" href="/opportunities/create" class="btn btn-primary" >@trans('add new')</a>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            @trans('opportunit import excel')
                                         </button>
                                        <div class="table-responsive pt-3">
                                            <table class="display" id="advance-4">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@trans('name')</th>
                                                        <th>@trans('phone')</th>
                                                        <th>@trans('email')</th>
                                                        <th>@trans('serivce')</th>
                                                        <th>@trans('package')</th>
                                                        <th>@trans('publish date')</th>
                                                        <th>@trans('actions')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($opportunities as $item)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{  $item->name  }}</td>          
                                                        <td>{{  $item->mobile  }}</td>          
                                                        <td>{{  $item->email  }}</td>          
                                                        <td>{{  optional($item->service)->name}}</td>          
                                                        <td>{{ optional($item->package)->name}}</td>
                                                        <td>{{  $item->dob  }}</td>
                                                         
                                                        <td class="d-flex">
                                                            <a role="button" href="/opportunities/{{ $item->id }}/edit" class="m-1 btn btn-primary btn-sm" >@trans('edit')</a>
                                                            <button onclick="destroy('/opportunities/{{ $item->id }}')" class="m-1 btn btn-danger bt-sm" >@trans('remove')</button>
                                                        </td>     
                                                    </tr> 
                                                    @endforeach
                                                </tbody>
                                                {{-- <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@trans('name')</th>
                                                        <th>@trans('description')</th>
                                                        <th>@trans('parent package')</th>
                                                        <th>@trans('created_by')</th>
                                                        <th>@trans('actions')</th>
                                                    </tr>
                                                </tfoot> --}}
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div><!-- /.row -->
                        </div><!-- /.container-fluid -->

                      </section>

                </section>
            </div>

        </div>
    </div>

     <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title " id="staticBackdropLabel">@trans('opportunities import excel')</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="lead"> @trans('pleas download template file ')</p>
          <a  href="/opportunit-download" class="btn btn-primary">@trans('download temblate')</a>
        </div>
        <div class="modal-footer">
            <!-- Button trigger modal -->
            <button id="next" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
               @trans('next')
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal -->
  <div class="modal " id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">@trans('opportunities import excel')</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/opportunit-upload_file" method="post" enctype="multipart/form-data">
            @csrf
           @method('post')
        <div class="modal-body">
            <p class="lead"> @trans(' now upload  file ')</p>
                <div class="form-group col-md-12 pt-3">
                    <input type="file" name="import_file"  class="form-control" placeholder="@trans('file ')" >

                </div>
        </div>
        <div class="modal-footer">
            <input type="submit" value="@trans('submit')" class="btn btn-primary float-right" data-bs-original-title="" title="">
            <button id="back" type="button" class="btn btn-info" data-bs-dismiss="modal">@trans('back')</button>

        </div>
    </form>

      </div>
    </div>
  </div>

<script type="text/javascript">
var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection




@section('script')
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>


<script>
    $(document).ready(function() {
        $('#next').click(function(){
            $('#staticBackdrop').hide();
            $('#staticBackdrop2').show();
        });
        $('#back').click(function(){
            $('#staticBackdrop2').hide();
            $('#staticBackdrop').show();
        });
    })
</script>
@endsection
