<div class="modal  animate__animated animate__zoomIn" style="display: none" id="importModel" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" style="display: block; padding-right: 16px;"
    data-select2-id="select2-data-importModel" aria-modal="true">
    {!! Form::open(['url' => action('ImportProductsController@store'), 'method' => 'post', 'class' => 'form', 'id' => 'importForm', 'enctype' => 'multipart/form-data']) !!}
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@trans('Import data')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body w3-padding">
                <div class="row mb-3">
                    <div class="col-12 w3-padding">
                        <small>@trans('Vaux can import spreadsheet data if its saved as a CSV file')</small><br>
                        <small>@trans('If your spreadsheet is not in CSV format yet, you can use Microsoft Excel or Google Sheets and save it as a CSV')</small>
                        <a href="{{ url('/documentation') }}" target="_blank" class="learn_more_link">@trans('Learn More')</a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 col-12 pt-2">
                        <h6>@trans('Data type')</h6>
                    </div>
                    <div class="col-md-9 col-12">
                        <select class="imgSelect custom-select form-control"
                            onchange="setImport(this.value)">

                            <option value="">@trans('select one')</option>

                            <option value="{{ action('ImportProductsController@store') }}*products_csv*{{ asset('files/import_products_csv_template.xls') }}*product">
                              @trans('sale.products')
                            </option>

                            <option value="{{ action('ImportOpeningStockController@store') }}*products_csv*{{ asset('files/import_opening_stock_csv_template.xls') }}*open_stock">
                              @trans('lang_v1.product_stock_history')
                            </option>

                            <option value="{{ action('ContactController@postImportContacts') }}*contacts_csv*{{ asset('files/import_contacts_csv_template.xls') }}*contact">
                              {{ __('contact.contacts') }}
                            </option>

                            <option value="{{ action('ImportSalesController@preview') }}*sales*{{ asset('files/import_sales_template.xlsx') }}*sales">
                              @trans( 'sale.sells')
                            </option>

                        </select>
                         
                        <a 
                        style="display: none;margin-top: 10px"
                        href="#" 
                        id="importDownloadLink" 
                        class="btn btn-success w3-round-large" download ><i class="fa fa-download"></i> @trans('lang_v1.download_template_file')</a>
                        <br>
                        <br>
                      </div>
                </div> 
                <div class="row mb-3">
                    <div class="col-md-3 col-12 pt-2">
                        <h6> @trans('File') </h6>
                    </div>
                    <div class="col-md-9 col-12">
                        <div class="custom-file import_custom_file">
                            <label for="formFileMultiple" class="form-label">
                                <img src="{{ url('/images/icons/csv.svg') }}" alt="some img"><br>
                                <span>@trans('click to select a file')</span><br> 
                            </label>
                            <input 
                              class="form-control" 
                              type="file"
                              accept=".xls, .xlsx, .csv"
                              required
                              id="formFileMultiple" multiple="">
                        </div>
                    </div>
                </div>
                <br>
                <div class="w3-block" style="max-height: 400px;overflow: auto" >
                    @include('home.import_notes')
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@trans('Cancel')</button>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">@trans('Close')</button> -->
                <button type="submit" class="btn btn-primary"  >@trans('messages.submit') </button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
