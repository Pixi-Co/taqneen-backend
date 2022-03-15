@extends('layouts.simple.master')
@section('title', 'Invoice')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>@trans('view')</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">@trans('subscriptions')</li>
<li class="breadcrumb-item active">@trans('view')</li>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">
               <div class="invoice">
                  <div>
                     <div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="media">
                                 <div class="media-left"><img class="media-object img-60" src="{{asset('assets/images/other-images/logo.png')}}" alt=""></div>
                                 <div class="media-body m-l-20 text-right">
                                    <h4 class="media-heading">الشركة الوطنية </h4>
                                    <p>hello@elwatnia.in<br><span>286503</span></p>
                                 </div>
                              </div>
                              <!-- End Info-->
                           </div>
                           <div class="col-sm-6">
                              <div class="text-md-end text-xs-center">
                                 <h3>@trans('price show no') <span class="counter">{{ $resource->id }}</span>#</h3>
                                 <p>@trans('date') May<span>{{ $resource->transaction_date }}</span><br></p>
                              </div>
                              <!-- End Title-->
                           </div>
                        </div>
                     </div>
                     <hr>
                     
                     <div>
                        <div class="table-responsive invoice-table" id="table">
                           <table class="table table-bordered table-striped">
                            <tr>
                               <td class="item">
                                  <h6 class="p-2 mb-0">@trans('service')</h6>
                               </td>
                               <td class="item">
                                  <h6 class="p-2 mb-0">@trans('package')</h6>
                               </td>
                               <td class="Hours">
                                  <h6 class="p-2 mb-0">@trans('number')</h6>
                               </td>
                               <td class="Rate">
                                  <h6 class="p-2 mb-0">@trans('total')</h6>
                               </td> 
                            </tr>
                              <tbody>
                                  @foreach ($resource->subscription_lines()->ge() as $item)
                                  <tr>
                                     <td class="item">
                                        <h6 class="p-2 mb-0">{{ optional($item->service)->name }}</h6>
                                     </td>
                                     <td class="item">
                                        <h6 class="p-2 mb-0">{{ optional($item->package)->name }}</h6>
                                     </td>
                                     <td class="Hours">
                                        <h6 class="p-2 mb-0">0</h6>
                                     </td>
                                     <td class="Rate">
                                        <h6 class="p-2 mb-0">{{ $item->total }}</h6>
                                     </td> 
                                  </tr>
                                  @endforeach
                                 
                              </tbody>
                           </table>
                        </div>
                        <!-- End Table-->
                        <div class="row mb-0 pb-0">
                           <div class="col-md-8">
                              <div>
                                 <p class="legal"><strong>شكرا لحسن تعاونكم معنا</p>
                              </div>
                           </div>  
                           <div class="col-sm-12 text-center mt-0 ">
                            <button class="btn btn btn-primary me-2" type="button" onclick="myFunction()">طباعة</button>
                            <button class="btn btn-secondary" type="button">الغاء</button>
                         </div>
                        </div>
                     </div>
                     <!-- End InvoiceBot-->
                  </div>
                 
                  <!-- End Invoice-->
                  <!-- End Invoice Holder-->
                  <!-- Container-fluid Ends-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/print.js')}}"></script>
@endsection
