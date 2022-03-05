@extends('layouts.app')
@section('title', __('lang_v1.import_contacts'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@trans('lang_v1.import_contacts')
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        @if (session('notification') || !empty($notification))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        @if (!empty($notification['msg']))
                            {{ $notification['msg'] }}
                        @elseif(session('notification.msg'))
                            {{ session('notification.msg') }}
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                @component('components.widget', ['class' => 'box-primary'])
                    {!! Form::open(['url' => action('ContactController@postImportContacts'), 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                    <div class="">
                        <div class="w3-padding">
                            {!! Form::label('name', __('product.file_to_import') . ':') !!}
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">

                                    <div class="hidden uploaded-file">
                                        {!! Form::file('contacts_csv', ['accept' => '.xls', 'required' => 'required']) !!}
                                    </div>

                                    <div 
                                    onclick="$('.uploaded-file input').click()"
                                    class="w3-round-xlarge w3-center w3-light-gray w3-padding w3-button w3-block">
                                        <div class="" style="width: 60px;margin: auto">
                                            @include("layouts.partials.upload_svg", ["style" => "width: 45px;height: 45px"])
                                        </div>
                                    </div>
                                    <br>
                                     
                                    <center>
                                        <button type="submit" class="add_btn" style="float: inherit" >@trans('messages.submit')</button>
                                    </center>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6"> 
                                <a 
                                href="{{ asset('files/import_contacts_csv_template.xls') }}"
                                class="w3-round-xlarge w3-center text-center w3-light-gray w3-padding w3-button w3-block">
                                    <div class="w3-padding text-center">
                                        <i class="fas fa-cloud-download-alt w3-text-white w3-xxlarge" ></i>
                                        @trans('lang_v1.download_template_file')
                                    </div>
                                    
                                </a>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                    <br><br> 
                    <div class="w3-large">
                        @trans('lang_v1.instruction_line1')<br>
                        @trans('lang_v1.instruction_line2')
                    </div>
                    <br><br>
                    <table class="table table-striped">
                        <tr>
                            <th>@trans('lang_v1.col_no')</th>
                            <th>@trans('lang_v1.col_name')</th>
                            <th>@trans('lang_v1.instruction')</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>@trans('contact.contact_type') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
                            <td>{!! __('lang_v1.import_contact_type_ins') !!}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>@trans('business.prefix') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>@trans('business.first_name') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>@trans('lang_v1.middle_name') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>@trans('business.last_name') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>@trans('business.business_name') <br><small
                                    class="text-muted">(@trans('lang_v1.required_if_supplier'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>@trans('lang_v1.contact_id') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>@trans('lang_v1.contact_id_ins')</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>@trans('contact.tax_no') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>@trans('lang_v1.opening_balance') <small class="text-muted">(@trans('lang_v1.optional'))</small>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>@trans('contact.pay_term') <br><small
                                    class="text-muted">(@trans('lang_v1.required_if_supplier'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>@trans('contact.pay_term_period') <br><small
                                    class="text-muted">(@trans('lang_v1.required_if_supplier'))</small></td>
                            <td><strong>@trans('lang_v1.pay_term_period_ins')</strong></td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>@trans('lang_v1.credit_limit') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>@trans('business.email') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>@trans('contact.mobile') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>@trans('contact.alternate_contact_number') <small
                                    class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>@trans('contact.landline') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>@trans('business.city') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>@trans('business.state') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>@trans('business.country') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>@trans('lang_v1.address_line_1') <small class="text-muted">(@trans('lang_v1.optional'))</small>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>@trans('lang_v1.address_line_2') <small class="text-muted">(@trans('lang_v1.optional'))</small>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>@trans('business.zip_code') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>23</td>
                            <td>@trans('lang_v1.dob') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>@trans('lang_v1.dob_ins') ({{ \Carbon::now()->format('Y-m-d') }})</td>
                        </tr>
                        @php
                            $custom_labels = json_decode(session('business.custom_labels'), true);
                        @endphp
                        <tr>
                            <td>24</td>
                            <td>{{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}
                                <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>{{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}
                                <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>26</td>
                            <td>{{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}
                                <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>27</td>
                            <td>{{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}
                                <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.instructions')])
                    
                @endcomponent
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection
