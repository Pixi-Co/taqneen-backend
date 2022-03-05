 <div class="page-title hidden">
     {{ __('lang_v1.notification_templates') }}
 </div>

 <!-- Content Header (Page header) -->
 <section class="content-header hidden">
     @if (request()->type == 'email')
         <h1>{{ __('lang_v1.notification_templates') }}</h1>
     @elseif(request()->type == 'sms')
         <h1>@trans("sms templates")</h1>
     @elseif(request()->type == 'whatsapp')
         <h1>@trans('whatsapp templates')</h1>
     @endif
 </section>

 <!-- Main content -->
 <section class="content">
     {!! Form::open(['url' => action('NotificationTemplateController@store'), 'class' => 'form', 'method' => 'post']) !!}

     <div class="text-center">
         <ul class="nav nav-pills mb-3 setting-tabs text-center" style="max-width: 500px;margin: auto" id="pills-tab"
             role="tablist"> 
             <li class="nav-item">
                 <a class="nav-link" id="generalLinkTab" data-toggle="pill" href="#generalTab" role="tab"
                     aria-controls="pills-home" aria-selected="true">
                     {{ __('lang_v1.notifications') }}
                 </a>
             </li> 
             <li class="nav-item">
                 <a class="nav-link" id="customerLinkTab" data-toggle="pill" href="#customerTab" role="tab"
                     aria-controls="pills-home" aria-selected="true">
                     {{ __('lang_v1.customer_notifications') }}
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" id="supplierLinkTab" data-toggle="pill" href="#supplierTab" role="tab"
                     aria-controls="pills-home" aria-selected="true">
                     {{ __('lang_v1.supplier_notifications') }}
                 </a>
             </li>
         </ul>
     </div>
     <br>
     <div class="tab-content" id="pills-tabContent">

         <div class="tab-pane fade" id="generalTab" role="tabpanel" aria-labelledby="pills-home-tab">
             <div class="row">
                 <div class="col-md-12">
                     @include('notification_template.partials.tabs', ['templates' => $general_notifications])
                 </div>
             </div>
         </div>

         <div class="tab-pane fade" id="customerTab" role="tabpanel" aria-labelledby="pills-home-tab">
             <div class="row">
                 <div class="col-md-12">
                     @include('notification_template.partials.tabs', ['templates' => $customer_notifications])
                 </div>
             </div>
         </div>

         <div class="tab-pane fade" id="supplierTab" role="tabpanel" aria-labelledby="pills-home-tab">
             <div class="row">
                 <div class="col-md-12">

                     @include('notification_template.partials.tabs', ['templates' => $supplier_notifications])

                     <div class="callout callout-warning">
                         <p>@trans('lang_v1.logo_not_work_in_sms'):</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>




     <div class="w3-block">
         <div class="text-center">
             <button type="submit" class="add_btn">@trans('messages.save')</button>
         </div>
     </div>
     {!! Form::close() !!}

 </section>
 <script type="text/javascript">
     $('textarea.ckeditor').each(function() {
         var editor_id = $(this).attr('id');
         tinymce.init({
             selector: 'textarea#' + editor_id,
         });
     });

     $(document).ready(function() {
        @if (request()->type == 'email')
            $('#generalLinkTab').click();
        @else
            $('#customerLinkTab').click();
        @endif
     });
 </script>
