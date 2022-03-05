 <div class="modal-dialog">
  {!! Form::open(['url' => action('PrinterController@store'), 'method' => 'post', 'id' => 'add_printer_form']) !!}
                   
  <div class="modal-content">
         <div class="modal-header ">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
             <h4 class="modal-title">{{ __('printer.add_printer_setting') }}</h4>
         </div>

         <div class="modal-body">
             <section class="content">
                 <div class=" -solid">
                     <div class="-body">
                         <div class="row">
                             <div class="col-sm-12">
                                 <div class="form-group">
                                     {!! Form::label('name', __('printer.name') . ':*') !!}
                                     {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.printer_name_help')]) !!}
                                 </div>
                             </div>
                             <div class="col-sm-12">
                                 <div class="form-group">
                                     {!! Form::label('connection_type', __('printer.connection_type') . ':*') !!}
                                     {!! Form::select('connection_type', $connection_types, null, ['class' => 'form-control select2']) !!}
                                 </div>
                             </div>

                             <div class="col-sm-12">
                                 <div class="form-group">
                                     {!! Form::label('capability_profile', __('printer.capability_profile') . ':*') !!}
                                     @show_tooltip(__('tooltip.capability_profile'))
                                     {!! Form::select('capability_profile', $capability_profiles, null, ['class' => 'form-control select2']) !!}
                                 </div>
                             </div>

                             <div class="col-sm-12">
                                 <div class="form-group">
                                     {!! Form::label('char_per_line', __('printer.character_per_line') . ':*') !!}
                                     {!! Form::number('char_per_line', 42, ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.char_per_line_help')]) !!}
                                 </div>
                             </div>

                             <div class="col-sm-12" id="ip_address_div">
                                 <div class="form-group">
                                     {!! Form::label('ip_address', __('printer.ip_address') . ':*') !!}
                                     {!! Form::text('ip_address', null, ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.ip_address_help')]) !!}
                                 </div>
                             </div>

                             <div class="col-sm-12" id="port_div">
                                 <div class="form-group">
                                     {!! Form::label('port', __('printer.port') . ':*') !!}
                                     {!! Form::text('port', 9100, ['class' => 'form-control', 'required']) !!}
                                     <span class="help-block">@trans('lang_v1.port_help')</span>
                                 </div>
                             </div>

                             <div class="col-sm-12 " id="path_div">
                                 <div class="form-group">
                                     {!! Form::label('path', __('printer.path') . ':*') !!}
                                     {!! Form::text('path', null, ['class' => 'form-control', 'required']) !!}
                                     <span class="help-block">
                                         <b>@trans('lang_v1.connection_type_windows'): </b>
                                         @trans('lang_v1.windows_type_help') <code>LPT1</code> (parallel) /
                                         <code>COM1</code> (serial). <br />
                                         <b>@trans('lang_v1.connection_type_linux'): </b>
                                         @trans('lang_v1.linux_type_help') <code>/dev/lp0</code> (parallel),
                                         <code>/dev/usb/lp1</code> (USB), <code>/dev/ttyUSB0</code> (USB-Serial),
                                         <code>/dev/ttyS0</code> (serial). <br />
                                     </span>
                                 </div>
                             </div>
 
                         </div>
                     </div>
                 </div>
             </section>



         </div>

         <div class="modal-footer">
             <button type="submit" id="settingAddBtn" class="btn btn-primary btn-sm setting-add">@trans( 'messages.save')</button>
             <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                 Close
             </button>
         </div>
     </div>
     {!! Form::close() !!}
 </div>
