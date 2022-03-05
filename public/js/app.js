function autoloadAppJs() {
    getTotalUnreadNotifications();
    $('body').on('click', 'label', function(e) {
        var field_id = $(this).attr('for');
        if (field_id) {
            if ($('#' + field_id).hasClass('select2')) {
                $('#' + field_id).select2('open');
                return false;
            }
        }
    });
    fileinput_setting = {
        showUpload: false,
        showPreview: false,
        browseLabel: LANG.file_browse_label,
        removeLabel: LANG.remove,
    };
    $(document).ajaxStart(function() {
        Pace.restart();
    });

    __select2($('.select2'));

    // popover
    $('body').on('mouseover', '[data-toggle="popover"]', function() {
        if ($(this).hasClass('popover-default')) {
            return false;
        }
        $(this).popover('show');
    });

    //Date picker
    $('.start-date-picker').datepicker({
        autoclose: true,
        endDate: 'today',
    });
    $(document).on('click', '.btn-modal', function(e) {
        e.preventDefault();
        var container = $(this).data('container');

        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function(result) {
                $(container)
                    .html(result)
                    .modal('show');
            },
        });
    });

    $(document).on('submit', 'form#brand_add_form', function(e) {
        e.preventDefault();
        $(this)
            .find('button[type="submit"]')
            .attr('disabled', true);
        var data = $(this).serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == true) {
                    $('div.brands_modal').modal('hide');
                    toastr.success(result.msg);
                    brands_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });






    //End: CRUD for product variations
    $(document).on('change', '.toggler', function() {
        var parent_id = $(this).attr('data-toggle_id');
        if ($(this).is(':checked')) {
            $('#' + parent_id).removeClass('hide');
        } else {
            $('#' + parent_id).addClass('hide');
        }
    });
    //Start: CRUD for products
    $(document).on('change', '#category_id', function() {
        get_sub_categories();
    });
    $(document).on('change', '#unit_id', function() {
        get_sub_units();
    });
    if ($('.product_form').length && !$('.product_form').hasClass('create')) {
        show_product_type_form();
    }
    $('#type').change(function() {
        show_product_type_form();
    });

    $(document).on('click', '#add_variation', function() {
        var row_index = $('#variation_counter').val();
        var action = $(this).attr('data-action');
        $.ajax({
            method: 'POST',
            url: '/products/get_product_variation_row',
            data: { row_index: row_index, action: action },
            dataType: 'html',
            success: function(result) {
                if (result) {
                    $('#product_variation_form_part  > tbody').append(result);
                    $('#variation_counter').val(parseInt(row_index) + 1);
                    toggle_dsp_input();
                }
            },
        });
    });
    //End: CRUD for products

    //bussiness settings start

    if ($('form#bussiness_edit_form').length > 0) {
        $('form#bussiness_edit_form').validate({
            ignore: [],
        });

        // logo upload
        $('#business_logo').fileinput(fileinput_setting);

        //Purchase currency
        $('input#purchase_in_diff_currency').on('ifChecked', function(event) {
            $('div#settings_purchase_currency_div, div#settings_currency_exchange_div').removeClass(
                'hide'
            );
        });
        $('input#purchase_in_diff_currency').on('ifUnchecked', function(event) {
            $('div#settings_purchase_currency_div, div#settings_currency_exchange_div').addClass(
                'hide'
            );
        });

        //Product expiry
        $('input#enable_product_expiry').change(function() {
            if ($(this).is(':checked')) {
                $('select#expiry_type').attr('disabled', false);
                $('div#on_expiry_div').removeClass('hide');
            } else {
                $('select#expiry_type').attr('disabled', true);
                $('div#on_expiry_div').addClass('hide');
            }
        });

        $('select#on_product_expiry').change(function() {
            if ($(this).val() == 'stop_selling') {
                $('input#stop_selling_before').attr('disabled', false);
                $('input#stop_selling_before')
                    .focus()
                    .select();
            } else {
                $('input#stop_selling_before').attr('disabled', true);
            }
        });

        //enable_category
        $('input#enable_category').on('ifChecked', function(event) {
            $('div.enable_sub_category').removeClass('hide');
        });
        $('input#enable_category').on('ifUnchecked', function(event) {
            $('div.enable_sub_category').addClass('hide');
        });
    }
    //bussiness settings end

    $('#upload_document').fileinput(fileinput_setting);

    //user profile
    $('form#edit_user_profile_form').validate();
    $('form#edit_password_form').validate({
        rules: {
            current_password: {
                required: true,
                minlength: 5,
            },
            new_password: {
                required: true,
                minlength: 5,
            },
            confirm_password: {
                equalTo: '#new_password',
            },
        },
    });


    //option-div
    $(document).on('click', '.option-div-group .option-div', function() {
        $(this)
            .closest('.option-div-group')
            .find('.option-div')
            .each(function() {
                $(this).removeClass('active');
            });
        $(this).addClass('active');
        $(this)
            .find('input:radio')
            .prop('checked', true)
            .change();
    });

    $(document).on('change', 'input[type=radio][name=scheme_type]', function() {
        $('#invoice_format_settings').removeClass('hide');
        var scheme_type = $(this).val();
        if (scheme_type == 'blank') {
            $('#prefix')
                .val('')
                .attr('placeholder', 'XXXX')
                .prop('disabled', false);
        } else if (scheme_type == 'year') {
            var d = new Date();
            var this_year = d.getFullYear();
            $('#prefix')
                .val(this_year + '-')
                .attr('placeholder', '')
                .prop('disabled', true);
        }
        show_invoice_preview();
    });
    $(document).on('change', '#prefix', function() {
        show_invoice_preview();
    });
    $(document).on('keyup', '#prefix', function() {
        show_invoice_preview();
    });
    $(document).on('keyup', '#start_number', function() {
        show_invoice_preview();
    });
    $(document).on('change', '#total_digits', function() {
        show_invoice_preview();
    });


    $('#add_barcode_settings_form').validate();
    $(document).on('change', '#is_continuous', function() {
        if ($(this).is(':checked')) {
            $('.stickers_per_sheet_div').addClass('hide');
            $('.paper_height_div').addClass('hide');
        } else {
            $('.stickers_per_sheet_div').removeClass('hide');
            $('.paper_height_div').removeClass('hide');
        }
    });

    //initialize iCheck
    /*$('input[type="checkbox"].input-icheck, input[type="radio"].input-icheck').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green',
    });*/

    $(document).on('ifChecked', '.check_all', function() {
        $(this)
            .closest('.check_group')
            .find('.input-icheck')
            .each(function() {
                $(this).iCheck('check');
            });
    });
    $(document).on('ifUnchecked', '.check_all', function() {
        $(this)
            .closest('.check_group')
            .find('.input-icheck')
            .each(function() {
                $(this).iCheck('uncheck');
            });
    });
    $('.check_all').each(function() {
        var length = 0;
        var checked_length = 0;
        $(this)
            .closest('.check_group')
            .find('.input-icheck')
            .each(function() {
                length += 1;
                if ($(this).iCheck('update')[0].checked) {
                    checked_length += 1;
                }
            });
        length = length - 1;
        if (checked_length != 0 && length == checked_length) {
            $(this).iCheck('check');
        }
    });

    //Business locations CRUD
    business_locations = $('#business_location_table').DataTable({
        processing: true,
        serverSide: true,
        bPaginate: false,
        buttons: [],
        ajax: '/business-location',
        columnDefs: [{
            targets: 11,
            orderable: false,
            searchable: false,
        }, ],
    });
    $('.location_add_modal, .location_edit_modal').on('shown.bs.modal', function(e) {
        $('form#business_location_add_form')
            .submit(function(e) {
                e.preventDefault();
            })
            .validate({
                rules: {
                    location_id: {
                        remote: {
                            url: '/business-location/check-location-id',
                            type: 'post',
                            data: {
                                location_id: function() {
                                    return $('#location_id').val();
                                },
                                hidden_id: function() {
                                    if ($('#hidden_id').length) {
                                        return $('#hidden_id').val();
                                    } else {
                                        return '';
                                    }
                                },
                            },
                        },
                    },
                },
                messages: {
                    location_id: {
                        remote: LANG.location_id_already_exists,
                    },
                },
                submitHandler: function(form) {
                    e.preventDefault();
                    $(form)
                        .find('button[type="submit"]')
                        .attr('disabled', true);
                    var data = $(form).serialize();

                    $.ajax({
                        method: 'POST',
                        url: $(form).attr('action'),
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success == true) {
                                $('div.location_add_modal').modal('hide');
                                $('div.location_edit_modal').modal('hide');
                                toastr.success(result.msg);
                                business_locations.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                },
            });

        $('form#business_location_add_form').find('#featured_products').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: '',
            ajax: {
                url: '/products/list?not_for_selling=true',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term, // search term
                        page: params.page,
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            var string = obj.name;
                            if (obj.type == 'variable') {
                                string += '-' + obj.variation;
                            }

                            string += ' (' + obj.sub_sku + ')';
                            return { id: obj.variation_id, text: string };
                        })
                    };
                },
            },
        })
    });

    if ($('#header_text').length) {
        init_tinymce('header_text');
    }

    if ($('#footer_text').length) {
        init_tinymce('footer_text');
    }

    //Start: CRUD for expense category


    //Start: CRUD operation for printers

    //Add Printer
    if ($('form#add_printer_form').length == 1) {
        printer_connection_type_field($('select#connection_type').val());
        $('select#connection_type').change(function() {
            var ctype = $(this).val();
            printer_connection_type_field(ctype);
        });

        $('form#add_printer_form').validate();
    }

    //Business Location Receipt setting
    if ($('form#bl_receipt_setting_form').length == 1) {
        if ($('select#receipt_printer_type').val() == 'printer') {
            $('div#location_printer_div').removeClass('hide');
        } else {
            $('div#location_printer_div').addClass('hide');
        }

        $('select#receipt_printer_type').change(function() {
            var printer_type = $(this).val();
            if (printer_type == 'printer') {
                $('div#location_printer_div').removeClass('hide');
            } else {
                $('div#location_printer_div').addClass('hide');
            }
        });

        $('form#bl_receipt_setting_form').validate();
    }

    $(document).on('click', 'a.pay_purchase_due, a.pay_sale_due', function(e) {
        var self = this;
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            dataType: 'html',
            success: function(result) {
                $('.pay_contact_due_modal')
                    .html(result)
                    .modal('show');
                __currency_convert_recursively($('.pay_contact_due_modal'));
                $('#paid_on').datetimepicker({
                    format: moment_date_format + ' ' + moment_time_format,
                    ignoreReadonly: true,
                });
                $('.pay_contact_due_modal')
                    .find('form#pay_contact_due_form')
                    .validate();

                // set installment value if exist
                if ($(self).attr('data-value')) {
                    $('.pay_contact_due_modal #amount').val($(self).attr('data-value'));
                    $('.pay_contact_due_modal #note').val($(self).attr('data-notes'));
                    $('.pay_contact_due_modal').find('input[name=installment_id]').val($(self).attr('data-installment_id'));
                }
                $('.installment-modal-dialog').modal('hide');
            },
        });
    });

    //Todays profit modal
    $('#view_todays_profit').click(function() {
        var loader = '<div class="text-center">' + __fa_awesome() + '</div>';
        $('#todays_profit').html(loader);
        $('#todays_profit_modal').modal('show');
    });
    $('#todays_profit_modal').on('shown.bs.modal', function() {
        var start = $('#modal_today').val();
        var end = start;
        var location_id = '';

        updateProfitLoss(start, end, location_id, $('#todays_profit'));
    });

    //Used for Purchase & Sell invoice.
    $(document).on('click', 'a.print-invoice', function(e) {
        e.preventDefault();
        var href = $(this).data('href');

        $.ajax({
            method: 'GET',
            url: href,
            dataType: 'json',
            success: function(result) {
                if (result.success == 1 && result.receipt.html_content != '') {
                    // new code
                    new_print_receipt(result.receipt.html_content);

                    // old code
                    //$('#receipt_section').html(result.receipt.html_content);
                    //__currency_convert_recursively($('#receipt_section'));
                    //__print_receipt('receipt_section');
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });



    if ($('form#add_invoice_layout_form').length > 0) {
        $('select#design').change(function() {
            if ($(this).val() == 'columnize-taxes') {
                $('div#columnize-taxes').removeClass('hide');
                $('div#columnize-taxes')
                    .find('input')
                    .removeAttr('disabled', 'false');
            } else {
                $('div#columnize-taxes').addClass('hide');
                $('div#columnize-taxes')
                    .find('input')
                    .attr('disabled', 'true');
            }
        });
    }

    $(document).on('keyup', 'form#unit_add_form input#actual_name', function() {
        $('form#unit_add_form span#unit_name').text($(this).val());
    });
    $(document).on('keyup', 'form#unit_edit_form input#actual_name', function() {
        $('form#unit_edit_form span#unit_name').text($(this).val());
    });

    $('#user_dob').datepicker({
        autoclose: true
    });

    setInterval(function() { getTotalUnreadNotifications() }, __new_notification_count_interval);


    types_of_service_table = $('#types_of_service_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: base_path + '/types-of-service',
        columnDefs: [{
            targets: [3],
            orderable: false,
            searchable: false,
        }, ],
        aaSorting: [1, 'asc'],
        columns: [
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'packing_charge', name: 'packing_charge' },
            { data: 'action', name: 'action' },
        ],
        fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#types_of_service_table'));
        },
    });

    //Search Settings
    //Set all labels as select2 options
    label_objects = [];
    search_options = [{
        id: '',
        text: ''
    }];
    var i = 0;
    $('.pos-tab-container label').each(function() {
        label_objects.push($(this));
        var label_text = $(this).text().trim().replace(":", "").replace("*", "");
        search_options.push({
            id: i,
            text: label_text
        });
        i++;
    });
    $('#search_settings').select2({
        data: search_options,
        placeholder: LANG.search,
    });
    $('#search_settings').change(function() {
        //Get label position and add active class to the tab
        var label_index = $(this).val();
        var label = label_objects[label_index];
        $('.pos-tab-content.active').removeClass('active');
        var tab_content = label.closest('.pos-tab-content');
        tab_content.addClass('active');
        tab_index = $('.pos-tab-content').index(tab_content);
        $('.list-group-item.active').removeClass('active');
        $('.list-group-item').eq(tab_index).addClass('active');

        //Highlight the label for three seconds
        $([document.documentElement, document.body]).animate({
            scrollTop: label.offset().top - 100
        }, 500);
        label.css('background-color', 'yellow');
        setTimeout(function() {
            label.css('background-color', '');
        }, 3000);
    });
    $('#add_invoice_layout_form #design').change(function() {
        if ($(this).val() == 'slim') {
            $('#hide_price_div').removeClass('hide');
        } else {
            $('#hide_price_div').addClass('hide');
        }
    });


}

$(document).ready(function() {
    autoloadAppJs();
});

function addInstallment() {
    var balanceDue = $('#in_balance_due').val();
    var date = new Date($('#transaction_date').val());
    // add 30 days
    date.setDate(date.getDate() + 30);
    var startDate = date;
    var interval = $('#installment_interval').val();
    var intervalNumber = $('#installment_interval_number').val();
    var installment_count = $('#installment_count').val();
    var stepDays = 0;
    var dates = [];
    var value = 0;


    if (!installment_count || !interval || !intervalNumber) {
        return toastr.error('enter installment data');
    }

    if (balanceDue <= 0)
        return toastr.error('balance due is must bigger than zero');

    if (interval == 'day') {
        stepDays = intervalNumber / installment_count;
    } else if (interval == 'month') {
        stepDays = (intervalNumber * 30) / installment_count;
    } else if (interval == 'year') {
        stepDays = (intervalNumber * 360) / installment_count;
    }


    if (stepDays < 1) {
        return toastr.error('invalid installment intervals and days');
    }

    value = balanceDue / installment_count;

    console.log(stepDays, ", ", startDate.toLocaleDateString());
    for (var index = 0; index < installment_count; index++) {
        var installmentDate = startDate;
        var daysNumber = stepDays;
        installmentDate.setDate(startDate.getDate() + daysNumber);

        console.log(daysNumber);
        console.log(startDate.toLocaleDateString());
        dates.push(startDate.toISOString().substring(0, 10));
    }

    console.log(dates);

    var container = $('#installmentTableBody');
    container.html('');

    for (var index = 0; index < dates.length; index++) {
        var installDate = dates[index];
        var row = document.createElement('tr');
        var rowContent = `
            <td>
                <input type='date' readonly required class='w3-input' name='installment_dates[]' value='${installDate}' >
            </td>
            <td>
                <input type='number' readonly required class='w3-input installment_value' value='${value}' name='installment_values[]' >
            </td>
            <td>
                <input type='text' class='w3-input' name='installment_notes[]' >
            </td> 
        `;
        row.innerHTML = rowContent;
        container.append(row);
    }
}


function createProduct(params = '') {
    $('.product-form-modal').html('');
    $('.product-form-modal').modal('show');
    $.get("/products/create?" + params, function(r) {
        $('.product-steps').remove();
        $('.product-form-modal').html(r);
    });
}

function updateCashRegister(id, status = 'user_receive_money') {
    var data = {
        cash_register_id: id,
        safe_status: status
    };
    $.post("/cash-register/update-status", $.param(data), function(r) {
        if (r.status == 1) {
            toastr.success(r.message);
            if (register_report_table) {
                register_report_table.ajax.reload();
            }
        } else
            toastr.error(r.message);
    });
}

function editProduct(id) {
    $('.product-form-modal').html('');
    $('.product-form-modal').modal('show');
    $.get("/products/" + id + "/edit", function(r) {
        $('.product-steps').remove();
        $('.product-form-modal').html(r);

        setTimeout(function() {
            get_sub_units();
            $('.select2').select2();
        }, 2000);
    });
}

function createMembership() {
    $('.membership-form-modal').html('');
    $('.membership-form-modal').modal('show');
    $.get("/memberships/create", function(r) {
        $('.membership-form-modal').html(r);
    });
}

function editMembership(id) {
    $('.membership-form-modal').html('');
    $('.membership-form-modal').modal('show');
    $.get("/memberships/" + id + "/edit", function(r) {
        $('.membership-form-modal').html(r);

        setTimeout(function() {
            get_sub_units();
            $('.select2').select2();
        }, 2000);
    });
}

$('.quick_add_product_modal').on('shown.bs.modal', function() {
    $('.quick_add_product_modal')
        .find('.select2')
        .each(function() {
            var $p = $(this).parent();
            $(this).select2({ dropdownParent: $p });
        });
    $('.quick_add_product_modal')
        .find('input[type="checkbox"].input-icheck')
        .each(function() {
            $(this).iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green',
            });
        });
});

function viewInstallmentModal(contact) {
    $('.installment-modal-dialog').modal('show');
    loadInstallmentsOfContact(contact, "#installmentBodyModal", function(r) {});
}

function loadInstallmentsOfContact(contact, container, action = null) {
    $.get("/contacts/installments/" + contact, function(res) {

        $(container).html(res);
        $(container).find('table').DataTable({
            "autoWidth": true,
            "lengthMenu": [
                [10, 25, 50, 100, 500, 1000, -1],
                [10, 25, 50, 100, 500, 1000, "All"]
            ],
            dom: 'RlBfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'colvis'
            ],
        });

        editDatatable();

        if (action)
            action(res);
    });
}


function printer_connection_type_field(ctype) {
    if (ctype == 'network') {
        $('div#path_div').addClass('hide');
        $('div#ip_address_div, div#port_div').removeClass('hide');
    } else if (ctype == 'windows' || ctype == 'linux') {
        $('div#path_div').removeClass('hide');
        $('div#ip_address_div, div#port_div').addClass('hide');
    }
}

function show_invoice_preview() {
    var prefix = $('#prefix').val();
    var start_number = $('#start_number').val();
    var total_digits = $('#total_digits').val();
    var preview = prefix + pad_zero(start_number, total_digits);
    $('#preview_format').text('#' + preview);
}

function pad_zero(str, max) {
    str = str.toString();
    return str.length < max ? pad_zero('0' + str, max) : str;
}

function get_sub_categories() {
    var cat = $('#category_id').val();
    $.ajax({
        method: 'POST',
        url: '/products/get_sub_categories',
        dataType: 'html',
        data: { cat_id: cat },
        success: function(result) {
            if (result) {
                $('#sub_category_id').html(result);
            }
        },
    });
}

function get_sub_units() {
    //Add dropdown for sub units if sub unit field is visible
    //if ($('#sub_unit_ids').is(':visible')) {

    var unit_id = $('#unit_id').val();
    $.ajax({
        method: 'GET',
        url: '/products/get_sub_units',
        dataType: 'html',
        data: { unit_id: unit_id },
        success: function(result) {
            if (result) {
                $('#sub_unit_ids').html(result);

                if (document.getElementById('edit_sub_units')) {
                    $('#sub_unit_ids').val(JSON.parse($('#edit_sub_units').val()));
                }
            }
        },
    });
    //}
}

function show_product_type_form() {

    //Disable Stock management & Woocommmerce sync if type combo
    if ($('#type').val() == 'combo') {
        $('#enable_stock').iCheck('uncheck');
        $('input[name="woocommerce_disable_sync"]').iCheck('check');
    }

    var action = $('#type').attr('data-action');
    var product_id = $('#type').attr('data-product_id');
    $.ajax({
        method: 'POST',
        url: '/products/product_form_part',
        dataType: 'html',
        data: { type: $('#type').val(), product_id: product_id, action: action },
        success: function(result) {
            if (result) {
                $('#product_form_part').html(result);
                toggle_dsp_input();
            }
        },
    });
}

$(document).on('click', 'table.ajax_view tbody tr', function(e) {
    if (!$(e.target).is('td.selectable_td input[type=checkbox]') &&
        !$(e.target).is('td.selectable_td') &&
        !$(e.target).is('td.clickable_td') &&
        !$(e.target).is('a') &&
        !$(e.target).is('button') &&
        !$(e.target).hasClass('label') &&
        !$(e.target).is('li') &&
        $(this).data('href') &&
        !$(e.target).is('i')
    ) {
        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function(result) {
                $('.view_modal')
                    .html(result)
                    .modal('show');
            },
        });
    }
});
$(document).on('click', 'td.clickable_td', function(e) {
    e.preventDefault();
    e.stopPropagation();
    if (e.target.tagName == 'SPAN' || e.target.tagName == 'TD' || e.target.tagName == 'I') {
        return false;
    }
    var link = $(this).find('a');
    if (link.length) {
        if (!link.hasClass('no-ajax')) {
            var href = link.attr('href');
            var container = $('.payment_modal');

            $.ajax({
                url: href,
                dataType: 'html',
                success: function(result) {
                    $(container)
                        .html(result)
                        .modal('show');
                    __currency_convert_recursively(container);
                },
            });
        }
    }
});

$(document).on('click', 'button.select-all', function() {
    var this_select = $(this)
        .closest('.form-group')
        .find('select');
    this_select.find('option').each(function() {
        $(this).prop('selected', 'selected');
    });
    this_select.trigger('change');
});
$(document).on('click', 'button.deselect-all', function() {
    var this_select = $(this)
        .closest('.form-group')
        .find('select');
    this_select.find('option').each(function() {
        $(this).prop('selected', '');
    });
    this_select.trigger('change');
});

$(document).on('ifToggled', 'input.row-select', function() {
    if (this.checked) {
        $(this)
            .closest('tr')
            .addClass('selected');
    } else {
        $(this)
            .closest('tr')
            .removeClass('selected');
    }
});

$(document).on('ifToggled', '#select-all-row', function(e) {
    if (this.checked) {


        /*$(this)
            .closest('table')
            .find('tbody')
            .find*/
        $('input.row-select')
            .each(function() {
                if (!this.checked) {
                    /*$(this)
                        .prop('checked', true)
                        .change();*/
                    $(this).iCheck('check');
                    this.checked = true;
                    //this.value = 1;
                }
            });
    } else {
        /*$(this)
            .closest('table')
            .find('tbody')
            .find*/
        $('input.row-select')
            .each(function() {
                if (this.checked) {
                    /*$(this)
                        .prop('checked', false)
                        .change();*/
                    $(this).iCheck('uncheck');
                    this.checked = false;
                }
            });
    }
});

$(document).on('click', 'a.view_purchase_return_payment_modal', function(e) {
    e.preventDefault();
    e.stopPropagation();
    var href = $(this).attr('href');
    var container = $('.payment_modal');

    $.ajax({
        url: href,
        dataType: 'html',
        success: function(result) {
            $(container)
                .html(result)
                .modal('show');
            __currency_convert_recursively(container);
        },
    });
});

$(document).on('click', 'a.view_invoice_url', function(e) {
    e.preventDefault();
    $('div.view_modal').load($(this).attr('href'), function() {
        $(this).modal('show');
    });
    return false;
});
$(document).on('click', '.load_more_notifications', function(e) {
    e.preventDefault();
    var this_link = $(this);
    this_link.text(LANG.loading + '...');
    this_link.attr('disabled', true);
    var page = parseInt($('input#notification_page').val()) + 1;
    var href = '/load-more-notifications?page=' + page;
    $.ajax({
        url: href,
        dataType: 'html',
        success: function(result) {
            if ($('li.no-notification').length == 0) {
                $('ul#notifications_list').append(result);
                // $(result).append(this_link.closest('li'));
            }

            this_link.text(LANG.load_more);
            this_link.removeAttr('disabled');
            $('input#notification_page').val(page);
        },
    });
    return false;
});

$(document).on('click', 'a.load_notifications', function(e) {
    e.preventDefault();
    $('li.load_more_li').addClass('hide');
    var this_link = $(this);
    var href = '/load-more-notifications?page=1';
    $('span.notifications_count').html(__fa_awesome());
    $.ajax({
        url: href,
        dataType: 'html',
        success: function(result) {
            $('li.notification-li').remove();
            $('ul#notifications_list').prepend(result);
            $('span.notifications_count').text('');
            $('li.load_more_li').removeClass('hide');
        },
    });
});

$(document).on('click', 'a.delete_purchase_return', function(e) {
    e.preventDefault();
    swal({
        title: LANG.sure,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(willDelete => {
        if (willDelete) {
            var href = $(this).attr('href');
            var data = $(this).serialize();

            $.ajax({
                method: 'DELETE',
                url: href,
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        toastr.success(result.msg);
                        purchase_return_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        }
    });
});

$(document).on('submit', 'form#types_of_service_form', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    $(this).find('button[type="submit"]').attr('disabled', true);
    $.ajax({
        method: $(this).attr('method'),
        url: $(this).attr('action'),
        dataType: 'json',
        data: data,
        success: function(result) {
            if (result.success == true) {
                $('div.type_of_service_modal').modal('hide');
                toastr.success(result.msg);
                types_of_service_table.ajax.reload();
            } else {
                toastr.error(result.msg);
            }
        },
    });
});

$(document).on('click', 'button.delete_type_of_service', function(e) {
    e.preventDefault();
    swal({
        title: LANG.sure,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(willDelete => {
        if (willDelete) {
            var href = $(this).data('href');
            var data = $(this).serialize();

            $.ajax({
                method: 'DELETE',
                url: href,
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        toastr.success(result.msg);
                        types_of_service_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        }
    });
});

$(document).on('submit', 'form#edit_shipping_form', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    $(this)
        .find('button[type="submit"]')
        .attr('disabled', true);
    $.ajax({
        method: $(this).attr('method'),
        url: $(this).attr('action'),
        dataType: 'json',
        data: data,
        success: function(result) {
            if (result.success == true) {
                $('div.view_modal').modal('hide');
                toastr.success(result.msg);
                sell_table.ajax.reload();
            } else {
                toastr.error(result.msg);
            }
        },
    });
});

$(document).on('show.bs.modal', '.register_details_modal, .close_register_modal', function() {
    __currency_convert_recursively($(this));
});

function updateProfitLoss(start = null, end = null, location_id = null, selector = null) {
    if (start == null) {
        var start = $('#profit_loss_date_filter')
            .data('daterangepicker')
            .startDate.format('YYYY-MM-DD');
        $('.start_date').val(start);
    }
    if (end == null) {
        var end = $('#profit_loss_date_filter')
            .data('daterangepicker')
            .endDate.format('YYYY-MM-DD');

        $('.end_date').val(end);
    }
    if (location_id == null) {
        var location_id = $('#profit_loss_location_filter').val();
    }
    var data = { start_date: start, end_date: end, location_id: location_id };
    selector = selector == null ? $('#pl_data_div') : selector;
    var loader = '<div class="text-center">' + __fa_awesome() + '</div>';
    selector.html(loader);
    $.ajax({
        method: 'GET',
        url: '/reports/profit-loss',
        dataType: 'html',
        data: data,
        success: function(html) {
            selector.html(html);
            __currency_convert_recursively(selector);
        },
    });
}

$(document).on('click', 'button.activate-deactivate-location', function() {
    swal({
        title: LANG.sure,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(willDelete => {
        if (willDelete) {
            $.ajax({
                url: $(this).data('href'),
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        toastr.success(result.msg);
                        business_locations.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        }
    });
});

function getTotalUnreadNotifications() {
    if ($('span.notifications_count').length) {
        var href = '/get-total-unread';
        $.ajax({
            url: href,
            dataType: 'json',
            global: false,
            success: function(data) {
                if (data.total_unread != 0) {
                    $('span.notifications_count').text(data.total_unread);
                }
                if (data.notification_html) {
                    $('.view_modal').html(data.notification_html);
                    $('.view_modal').modal('show');
                }
            },
        });
    }
}

$(document).on('shown.bs.modal', '.view_modal', function(e) {
    if ($(this).find('#email_body').length) {
        tinymce.init({
            selector: 'textarea#email_body',
        });
    }
});
$(document).on('hidden.bs.modal', '.view_modal', function(e) {
    if ($(this).find('#email_body').length) {
        tinymce.remove("textarea#email_body");
    }

    //check if modal opened then make it scrollable
    if ($('.modal.in').length > 0) {
        $('body').addClass('modal-open');
    }
});
$(document).on('shown.bs.modal', '.quick_add_product_modal', function(e) {
    /*tinymce.init({
        selector: 'textarea#product_description',
    });*/
});
$(document).on('hidden.bs.modal', '.quick_add_product_modal', function(e) {
    //tinymce.remove("textarea#product_description");
});

$(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
        $('.scrolltop:hidden').stop(true, true).fadeIn();
    } else {
        $('.scrolltop').stop(true, true).fadeOut();
    }
});
$(function() { $(".scroll").click(function() { $("html,body").animate({ scrollTop: $(".thetop").offset().top }, "1000"); return false }) })

$(document).on('click', 'a.update_contact_status', function(e) {
    e.preventDefault();
    var href = $(this).attr('href');
    $.ajax({
        url: href,
        dataType: 'json',
        success: function(data) {
            if (data.success == true) {
                toastr.success(data.msg);
                contact_table.ajax.reload();
            } else {
                toastr.error(data.msg);
            }
        },
    });
});

$(document).on('shown.bs.modal', '.contact_modal', function(e) {
    $('.dob-date-picker').datepicker({
        autoclose: true,
        endDate: 'today',
    });
});

$(document).on('change', '#sms_service', function(e) {
    var sms_service = $(this).val();
    $('div.sms_service_settings').each(function() {
        if (sms_service == $(this).data('service')) {
            $(this).removeClass('hide');
        } else {
            $(this).addClass('hide');
        }
    });
});

$(document).on('click', 'a.show-notification-in-popup', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        method: 'GET',
        url: url,
        dataType: 'html',
        success: function(result) {
            $('.view_modal').html(result);
            $('.view_modal').modal('show');
        },
    });
})


function success(text) {
    alert(text);
}

function error(text) {
    alert(text);
}
//form add shipping companies

$(document).on('click', 'button.edit_shipping_fees_button', function() {
    $('div.shipping_fees_form').load($(this).data('href'), function() {
        $(this).modal('show');

        $('form#shipping_fees_edit_form').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();


            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        $('div.shipping_fees_form').modal('hide');
                        toastr.success(result.msg);

                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        });
    });
});