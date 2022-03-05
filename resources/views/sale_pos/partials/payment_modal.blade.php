<div class="modal fade" tabindex="-1" role="dialog" id="modal_payment">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@trans('lang_v1.payment')</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-12">
                        <strong>@trans('lang_v1.advance_balance'):</strong> <span id="advance_balance_text"></span>
                        {!! Form::hidden('advance_balance', null, ['id' => 'advance_balance', 'data-error-msg' => __('lang_v1.required_advance_balance_not_available')]) !!}
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div id="payment_rows_div">
                                @foreach ($payment_lines as $payment_line)

                                    @if ($payment_line['is_return'] == 1)
                                        @php
                                            $change_return = $payment_line;
                                        @endphp

                                        @continue
                                    @endif

                                    @include('sale_pos.partials.payment_row', ['removable' => !$loop->first, 'row_index'
                                    => $loop->index, 'payment_line' => $payment_line])
                                @endforeach
                            </div>
                            <input type="hidden" id="payment_row_index" value="{{ count($payment_lines) }}">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-block"
                                    id="add-payment-row">@trans('sale.add_payment_row')</button>
                            </div>
                        </div>
                        @can_bt(['installments'])
                        <br>
                        <label for="" class="w3-padding">
                            <input type="checkbox"
                                onchange="this.checked? $('.installment_row').show() : $('.installment_row').hide()">
                            <b>@trans('is installment')</b>
                        </label>
                        @endcan_bt
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('sale_note', __('sale.sell_note') . ':') !!}
                                    {!! Form::textarea('sale_note', !empty($transaction) ? $transaction->additional_notes : null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('sale.sell_note')]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('staff_note', __('sale.staff_note') . ':') !!}
                                    {!! Form::textarea('staff_note', !empty($transaction) ? $transaction->staff_note : null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('sale.staff_note')]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 installment_row" style="display: none">
                            <h3>
                                @trans("installments")
                            </h3>
                            <hr>
                            <div class="w3-block">
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="col-md-5">
                                        <b>@trans('installment interval')</b>
                                    </div>
                                    <div class="col-md-7">
                                        @if (isset($pos_settings['cant_edit_installment_interval']))
                                            @if ($pos_settings['cant_edit_installment_interval'] == 1)
                                                <input type="text" readonly
                                                    value="{{ $pos_settings['installment_interval'] ?? '' }}"
                                                    class="form-control" id="installment_interval">
                                            @else
                                                <select class="form-control"
                                                    value="{{ $pos_settings['installment_interval'] ?? '' }}"
                                                    id="installment_interval">
                                                    <option value="day">@trans('day')</option>
                                                    <option value="month">@trans('month')</option>
                                                    <option value="year">@trans('year')</option>
                                                </select>
                                            @endif
                                        @else
                                            <select class="form-control"
                                                value="{{ $pos_settings['installment_interval'] ?? '' }}"
                                                id="installment_interval">
                                                <option value="day">@trans('day')</option>
                                                <option value="month">@trans('month')</option>
                                                <option value="year">@trans('year')</option>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="col-md-5">
                                        <b>@trans('installment interval number')</b>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" @if (isset($pos_settings['cant_edit_installment_interval_number']))
                                        @if ($pos_settings['cant_edit_installment_interval_number'] == 1)
                                            readonly
                                        @endif
                                        @endif

                                        value="{{ $pos_settings['installment_interval_number'] ?? '' }}"
                                        id="installment_interval_number" placeholder="@trans('installment interval
                                        number')" >
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="col-md-5">
                                        <b>@trans('installment number')</b>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" @if (isset($pos_settings['cant_edit_installment_count']))
                                        @if ($pos_settings['cant_edit_installment_count'] == 1)
                                            readonly
                                        @endif
                                        @endif
                                        value="{{ $pos_settings['installment_count'] ?? '' }}"
                                        class="form-control" id="installment_count" placeholder="@trans('installment
                                        number')" >
                                    </div>
                                </div>
                            </div>
                            <button type="button" onclick="addInstallment()" class="btn w3-deep-orange">
                                @trans('create installments')
                            </button>
                            <br>
                            <br>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>@trans("date")</th>
                                    <th>@trans("value")</th>
                                    <th>@trans("notes")</th>
                                </tr>
                                <tbody id="installmentTableBody">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="box box-solid bg-orange">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <strong>
                                        @trans('lang_v1.total_items'):
                                    </strong>
                                    <br />
                                    <span class="lead text-bold total_quantity">0</span>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <strong>
                                        @trans('sale.total_payable'):
                                    </strong>
                                    <br />
                                    <span class="lead text-bold total_payable_span">0</span>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <strong>
                                        @trans('lang_v1.total_paying'):
                                    </strong>
                                    <br />
                                    <span class="lead text-bold total_paying">0</span>
                                    <input type="hidden" id="total_paying_input">
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <strong>
                                        @trans('lang_v1.change_return'):
                                    </strong>
                                    <br />
                                    <span class="lead text-bold change_return_span">0</span>
                                    {!! Form::hidden('change_return', $change_return['amount'], ['class' => 'form-control change_return input_number', 'required', 'id' => 'change_return']) !!}
                                    <!-- <span class="lead text-bold total_quantity">0</span> -->
                                    @if (!empty($change_return['id']))
                                        <input type="hidden" name="change_return_id" value="{{ $change_return['id'] }}">
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <strong>
                                        @trans('lang_v1.balance'):
                                    </strong>
                                    <br />
                                    <span class="w3-text-white lead text-bold balance_due">0</span>
                                    <input type="hidden" id="in_balance_due" value=0>
                                </div>



                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@trans('messages.close')</button>
                <button type="submit" class="btn btn-primary _pos-cod-finalize-action_"
                    id="pos-save">@trans('sale.finalize_payment')</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Used for express checkout card transaction -->
<div class="modal fade" tabindex="-1" role="dialog" id="card_details_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@trans('lang_v1.card_transaction_details')</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('card_type', __('lang_v1.card_type')) !!}
                                {!! Form::select('', ['visa' => 'Visa', 'master' => 'MasterCard'], 'visa', ['class' => 'form-control select2', 'id' => 'card_type']) !!}
                            </div>
                        </div>
						<!--
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('card_number', __('lang_v1.card_no')) !!}
                                {!! Form::text('', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.card_no'), 'id' => 'card_number', 'autofocus']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('card_holder_name', __('lang_v1.card_holder_name')) !!}
                                {!! Form::text('', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.card_holder_name'), 'id' => 'card_holder_name']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('card_transaction_number', __('lang_v1.card_transaction_no')) !!}
                                {!! Form::text('', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.card_transaction_no'), 'id' => 'card_transaction_number']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('card_month', __('lang_v1.month')) !!}
                                {!! Form::text('', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.month'), 'id' => 'card_month']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('card_year', __('lang_v1.year')) !!}
                                {!! Form::text('', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.year'), 'id' => 'card_year']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('card_security', __('lang_v1.security_code')) !!}
                                {!! Form::text('', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.security_code'), 'id' => 'card_security']) !!}
                            </div>
                        </div>
					-->
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    id="pos-save-card">@trans('sale.finalize_payment')</button>
            </div>

        </div>
    </div>
</div>
