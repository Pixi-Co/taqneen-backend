
    <!-- model 1 Company Setting Models -->
    <!-- 1- tax rate model 1 -->
    <div class="modal in" id="tax_rate_model" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Tax Rates</h4>
          </div>
 
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <span>
                  Define your taxing schemes to account for different types of
                  taxes on purchase and sales orders (e.g., state taxes)
                </span>
              </div>
            </div>
            <div class="tax_item">
              <div class="row">
                <div class="col-md-4">
                  <div class="row">
                    <a href="#" class="delete_rate"> <span>×</span> </a>
                    <h6>No Tax</h6>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="row">
                    <div class="taxRateDiv">
                      <h6>Tax</h6>
                    </div>
                    <span>14%</span>
                  </div>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                  <div class="rating">
                    <label for="super-happy">
                      <input type="radio" name="rating" class="super-happy" id="super-happy" value="super-happy" checked="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"></path>
                      </svg>
                    </label>
                  </div>
                  <a data-dismiss="modal" data-toggle="modal" href="#tax_rate_model2"><i class="fas fa-arrow-circle-right tax_arrow"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="tax_item">
              <div class="row">
                <div class="col-md-4">
                  <div class="row">
                    <a href="#" class="delete_rate"> <span>×</span> </a>
                    <h6>No Tax</h6>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="row">
                    <div class="taxRateDiv">
                      <h6>Tax</h6>
                    </div>
                    <span>14%</span>
                  </div>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                  <div class="rating">
                    <label for="happy">
                      <input type="radio" name="rating" class="happy" id="happy" value="happy">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"></path>
                      </svg>
                    </label>
                  </div>
                  <a href="#"><i class="fas fa-arrow-circle-right tax_arrow"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <a href="#" class="learn_more_link"> + Add Tax Rate</a>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- 2- tax rate model 2 -->
    <div class="modal in" id="tax_rate_model2" tabindex="-1" role="dialog" aria-labelledby="tax_rate_model2" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <a data-dismiss="modal" data-toggle="modal" href="#tax_rate_model" class="modal-title"><i class="fas fa-arrow-circle-left tax_arrow"></i><span>Tax 1</span></a>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 col-12">
                <form>
                  <div class="form-group">
                    <label class="col-form-label">Taxing scheme name</label>
                    <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="  tax name ">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Tax name</label>
                    <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="  tax name ">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Tax Rate</label>
                    <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="  tax rate ">
                  </div>
                </form>
              </div>
              <div class="col-md-6 col-12 form_colored">
                <h6>Preview</h6>
                <form>
                  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Subtotal</label>
                    <div class="col-sm-10">
                      <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="
                        $100.00">
                    </div>
                  </div>
                  <div class="form-group row justify-content-between">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Freight</label>
                    <div class="col-sm-5 mr-4">
                      <input type="text" class="form-control" value="
                        ">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">sas</label>
                    <div class="col-sm-10">
                      <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="
                        $14.40">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Total</label>
                    <div class="col-sm-10">
                      <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="
                        $134.40">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- 3- add printer model  -->
    <div class="modal in bd-example-modal-lg" id="printer_model" tabindex="-1" role="dialog" aria-labelledby="printer_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Manage Printers</h4>
          </div>

          <div class="modal-body">
            <div class="form">
              <div class="row justify-content-center">
                <div class="col-md-12 col-12">
                  <div class="input-icons">
                    <label> Product Name:*</label>
                    <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="Short Descriptive Name to recognize printer">
                  </div>
                </div>
                <div class="col-md-12 col-12 ">
                  <label class="customlabel">Printer Type :
                  </label>
                  <select class="mySelect custom-select" id="cases3" tabindex="0" aria-hidden="false">
                    <option value="select" selected="selected">Please Select
                    </option>
                    <option value="yes">main printer
                    </option>
                    <option value="no">sub printer
                    </option>
                  </select>
                </div>
              </div>
              <div class="product_edit_form my-3 " id="yes" style="display: none;">
                <div class="col-md-12 col-12 ">
                  <label class="customlabel">Category :
                  </label>
                  <select class="mySelect custom-select select2-hidden-accessible" id="cases3" data-select2-id="select2-data-cases3" tabindex="-1" aria-hidden="true">
                    <option value="select" selected="selected" data-select2-id="select2-data-6-ntc7">Please Select
                    </option>
                    <option> Category 1
                    </option>
                    <option>Category 2
                    </option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-5-5sy2" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-cases3-container" aria-controls="select2-cases3-container"><span class="select2-selection__rendered" id="select2-cases3-container" role="textbox" aria-readonly="true" title="Please Select
                    ">Please Select
                    </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
              </div>
              <div class="my-3">
                <div class="product_edit_form_content">
                  <div class="row justify-content-center">
                    <div class="col-md-12 col-12">
                      <div class="form-group">
                        <label class="customlabel">Connection Type:* </label>
                        <select class="mySelect custom-select select2-hidden-accessible" id="cases4" data-select2-id="select2-data-cases4" tabindex="-1" aria-hidden="true">
                          <option value="select" selected="selected" data-select2-id="select2-data-8-fto5">
                            Please Select
                          </option>
                          <option value="network">Network</option>
                          <option value="windows">windows</option>
                          <option value="linux">linux</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-7-71dv" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-cases4-container" aria-controls="select2-cases4-container"><span class="select2-selection__rendered" id="select2-cases4-container" role="textbox" aria-readonly="true" title="
                            Please Select
                          ">
                            Please Select
                          </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product_table_form my-3" id="network" style="display: none;">
                  <div class="row justify-content-center">
                    <div class="col-md-12 col-12">
                      <div class="form-group">
                        <label class="customlabel">Capability Profile:* <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-original-title="Support for commands and code pages varies between printer vendors and models. If you're not sure, it's a good idea to use the 'simple' Capability Profile"></span></a>
                        </label>
                        <select class="mySelect custom-select select2-hidden-accessible" data-select2-id="select2-data-9-g0zk" tabindex="-1" aria-hidden="true">
                          <option value="default" data-select2-id="select2-data-11-uekx">Default</option>
                          <option value="simple">Simple</option>
                          <option value="SP2000">Star Branded</option>
                          <option value="TEP-200M">Espon Tep</option>
                          <option value="P822D">P822D</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-10-xyt6" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-dq5h-container" aria-controls="select2-dq5h-container"><span class="select2-selection__rendered" id="select2-dq5h-container" role="textbox" aria-readonly="true" title="Default">Default</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                      </div>
                    </div>
                    <div class="col-md-12 col-12">
                      <div class="input-icons">
                        <label> Characters per line:*</label>
                        <input type="number" class="form-control form-control-rounded" id="regular-form-2" placeholder="Number of character that can be printed per line">
                      </div>
                    </div>
                    <div class="col-md-12 col-12">
                      <div class="input-icons">
                        <label> IP Address:*</label>
                        <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="IP address for connecting to the printer">
                      </div>
                    </div>
                    <div class="col-md-12 col-12">
                      <div class="input-icons">
                        <label> Port:*</label>
                        <input type="text" class="form-control form-control-rounded" id="regular-form-2" value="9100">
                        <small>Most printer works on port 9100</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product_table_form my-3" id="windows" style="display: none;">
                  <div class="row justify-content-center">
                    <div class="col-md-12 col-12">
                      <div class="form-group">
                        <label class="customlabel">Capability Profile:* <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-original-title="Support for commands and code pages varies between printer vendors and models. If you're not sure, it's a good idea to use the 'simple' Capability Profile"></span></a>
                        </label>
                        <select class="mySelect custom-select select2-hidden-accessible" data-select2-id="select2-data-12-uf1t" tabindex="-1" aria-hidden="true">
                          <option value="default" data-select2-id="select2-data-14-gyva">Default</option>
                          <option value="simple">Simple</option>
                          <option value="SP2000">Star Branded</option>
                          <option value="TEP-200M">Espon Tep</option>
                          <option value="P822D">P822D</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-13-nmbw" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-b5o9-container" aria-controls="select2-b5o9-container"><span class="select2-selection__rendered" id="select2-b5o9-container" role="textbox" aria-readonly="true" title="Default">Default</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                      </div>
                    </div>
                    <div class="col-md-12 col-12">
                      <div class="input-icons">
                        <label> Characters per line:*</label>
                        <input type="number" class="form-control form-control-rounded" id="regular-form-2" placeholder="Number of character that can be printed per line">
                      </div>
                    </div>

                    <div class="col-md-12 col-12">
                      <div class="input-icons">
                        <label> Path:*</label>
                        <input type="text" class="form-control form-control-rounded" id="regular-form-2" value="9100">
                        <small>Connection Type Windows: The device files will be along the lines of LPT1 (parallel) /
                          COM1 (serial).
                          Connection Type Linux: Your printer device file will be somewhere like /dev/lp0 (parallel),
                          /dev/usb/lp1 (USB), /dev/ttyUSB0 (USB-Serial), /dev/ttyS0 (serial).</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product_table_form my-3" id="linux" style="display: none;">
                  <div class="row justify-content-center">
                    <div class="col-md-12 col-12">
                      <div class="form-group">
                        <label class="customlabel">Capability Profile:* <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-original-title="Support for commands and code pages varies between printer vendors and models. If you're not sure, it's a good idea to use the 'simple' Capability Profile"></span></a>
                        </label>
                        <select class="mySelect custom-select select2-hidden-accessible" data-select2-id="select2-data-15-toua" tabindex="-1" aria-hidden="true">
                          <option value="default" data-select2-id="select2-data-17-b2gw">Default</option>
                          <option value="simple">Simple</option>
                          <option value="SP2000">Star Branded</option>
                          <option value="TEP-200M">Espon Tep</option>
                          <option value="P822D">P822D</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-16-b1ln" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-dh7c-container" aria-controls="select2-dh7c-container"><span class="select2-selection__rendered" id="select2-dh7c-container" role="textbox" aria-readonly="true" title="Default">Default</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                      </div>
                    </div>
                    <div class="col-md-12 col-12">
                      <div class="input-icons">
                        <label> Characters per line:*</label>
                        <input type="number" class="form-control form-control-rounded" id="regular-form-2" placeholder="Number of character that can be printed per line">
                      </div>
                    </div>

                    <div class="col-md-12 col-12">
                      <div class="input-icons">
                        <label> Path:*</label>
                        <input type="text" class="form-control form-control-rounded" id="regular-form-2" value="9100">
                        <small>Connection Type Windows: The device files will be along the lines of LPT1 (parallel) /
                          COM1 (serial).
                          Connection Type Linux: Your printer device file will be somewhere like /dev/lp0 (parallel),
                          /dev/usb/lp1 (USB), /dev/ttyUSB0 (USB-Serial), /dev/ttyS0 (serial).</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- 4- generate_barcode_model  model  -->
    <div class="modal in " id="generate_barcode_model" tabindex="-1" role="dialog" aria-labelledby="generate_barcode_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Generate Barcode</h4>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 col-12 mb-2">
                <small>If you have your own barcodes, we suggest importing or setting them up manually <a href="#" class="learn_more_link">learn more </a></small> <br>
                <small>Activating these toggles will fill in empty barcode or SKU fields, but Vaux will never
                  overwrite existing barcodes or SKUs on your products.

                  If both toggles stay off, Vaux will not generate any new codes. </small>
              </div>
              <div class="  input-div ">
                <div class="row px-3 my-1">
                  <div class="col-md-4 col-12">
                    <div class="input-icon">
                      <label>Prefix</label>
                      <input type="text" class="form-control form-control-rounded" id="regular-form-2">
                    </div>
                  </div>
                  <div class="col-md-4 col-12 ">
                    <div class="input-icon">
                      <label>Next number</label>
                      <input type="text" class="form-control form-control-rounded" id="regular-form-2" value="0111">
                    </div>
                  </div>
                  <div class="col-md-4 col-12 ">
                    <div class="input-icon">
                      <label> Suffix</label>
                      <input type="text" class="form-control form-control-rounded" id="regular-form-2">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-12 ">
                <div class="form-group">
                  <label class="font-weight-bolder"> Preview</label>
                  <input readonly="" type="text" class="form-control form-control-rounded" id="regular-form-2">
                </div>
              </div>
              <div class="col-12">
                <a href="#" id="b1" class="learn_more_link"> + Add New Barcode </a>

              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- 5- print_barcode_model  model  -->
    <div class="modal in bd-example-modal-lg " id="print_barcode_model" tabindex="-1" role="dialog" aria-labelledby="print_barcode_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Print Barcode</h4>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 col-12">
                <div class="panel">
                  <div class="box-body ">
                    <div class="row">
                      <div class="col-10 offset-sm-1">
                        <div class="form-group ">
                          <input class="search_input" type="text" name="" id="" placeholder="Search">
                          <button class="search_button"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-10 offset-sm-1">
                        <table class="table table-bordered  table-striped import_contacts" id="product_table">
                          <thead>
                            <tr>
                              <th>Products</th>
                              <th>No. of labels</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="panel print_label_filter">
                  <div class="panel-header">
                    <h6 class="panel-title text-center">Information to show in Labels</h6>
                  </div>
                  <div class="form">
                    <div class="form-check my-3">
                      <div class="row">
                        <div class="col-12 my-2">
                          <label class="customcheck"> Product Name
                            <input id="checkbox1" type="checkbox">
                            <span class="checkmark"></span>
                          </label>
                        </div>
                        <div class=" col-12 my-2">
                          <label class="customcheck"> Product Variation (recommended)
                            <input id="checkbox1" type="checkbox">
                            <span class="checkmark"></span>
                          </label>
                        </div>

                        <div class=" col-12 my-2">
                          <label class="customcheck">Business name
                            <input id="checkbox1" type="checkbox">
                            <span class="checkmark"></span>
                          </label>
                        </div>
                        <div class=" col-12 my-2">
                          <label class="customcheck">Branch name
                            <input id="checkbox1" type="checkbox">
                            <span class="checkmark"></span>
                          </label>
                        </div>
                        <div class=" col-12 my-2">
                          <label class="customcheck"> Product Price
                            <input id="checkbox1" class="checkbox1" type="checkbox">
                            <span class="checkmark"></span>
                          </label>
                        </div>
                        <div class="col-12 my-2">
                          <div id="autoUpdate" class="autoUpdate" style="display: none">
                            <label class="customcheck" style="padding-left: 0 !important;"> Show Price: </label>
                            <div class="input-group  pr-3">
                              <select class="form-control">
                                <option value="inclusive" selected="selected">Inc. tax</option>
                                <option value="exclusive">Exc. tax</option>
                              </select>
                            </div>
                          </div>
                        </div>

                      </div>

                    </div>

                  </div>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="panel">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12 col-12 ">
                        <div class="form-group">
                          <label for="price_type">Location Name :</label>
                          <div class="input-group">
                            <select class="mySelect form-control select2-hidden-accessible" name="barcode_setting" data-select2-id="select2-data-18-j4o5" tabindex="-1" aria-hidden="true">
                              <option value="1" data-select2-id="select2-data-20-r1qt">Location 1</option>
                              <option value="1">Location 2</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-19-oy6o" style="width: 1px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-barcode_setting-i5-container" aria-controls="select2-barcode_setting-i5-container"><span class="select2-selection__rendered" id="select2-barcode_setting-i5-container" role="textbox" aria-readonly="true" title="Location 1">Location 1</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12 ">
                        <div class="form-group">
                          <label for="price_type">Barcode setting:</label>
                          <div class="input-group">
                            <select class="mySelect form-control select2-hidden-accessible" name="barcode_setting" data-select2-id="select2-data-21-xeho" tabindex="-1" aria-hidden="true">
                              <option value="1" data-select2-id="select2-data-23-m3h6">20 Labels per Sheet, Sheet Size: 8.5" x 11", Label Size: 4" x 1", Labels
                                per
                                sheet: 20</option>
                              <option value="2">30 Labels per sheet, Sheet Size: 8.5" x 11", Label Size: 2.625" x 1",
                                Labels
                                per sheet: 30</option>
                              <option value="3">32 Labels per sheet, Sheet Size: 8.5" x 11", Label Size: 2" x 1.25",
                                Labels
                                per sheet: 32</option>
                              <option value="4">40 Labels per sheet, Sheet Size: 8.5" x 11", Label Size: 2" x 1", Labels
                                per
                                sheet: 40</option>
                              <option value="5">50 Labels per Sheet, Sheet Size: 8.5" x 11", Label Size: 1.5" x 1",
                                Labels
                                per sheet: 50</option>
                              <option value="6">Continuous Rolls - 31.75mm x 25.4mm, Label Size: 31.75mm x 25.4mm, Gap:
                                3.18mm</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-22-vl6h" style="width: 1px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-barcode_setting-ir-container" aria-controls="select2-barcode_setting-ir-container"><span class="select2-selection__rendered" id="select2-barcode_setting-ir-container" role="textbox" aria-readonly="true" title="20 Labels per Sheet, Sheet Size: 8.5&quot; x 11&quot;, Label Size: 4&quot; x 1&quot;, Labels
                                per
                                sheet: 20">20 Labels per Sheet, Sheet Size: 8.5" x 11", Label Size: 4" x 1", Labels
                                per
                                sheet: 20</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 ">
                        <button type="button" id="labels_preview" class="btn btn-primary pull-right btn-flat btn-block btn_preview">Preview</button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- 5- setting_barcode_model  model  -->
    <div class="modal in bd-example-modal-lg " id="setting_barcode_model" tabindex="-1" role="dialog" aria-labelledby="setting_barcode_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Print Barcode</h4>
          </div>

          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-4 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Sticker Sheet setting Name:*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                  </div>
                </div>
                <div class="col-md-4 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Additional top margin (In Inches):*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                  </div>
                </div>
                <div class="col-md-4 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Additional left margin (In Inches):*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                  </div>
                </div>
                <div class="col-md-4 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Width of sticker (In Inches):*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                  </div>
                </div>
                <div class="col-md-4 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Height of sticker (In Inches):*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                  </div>
                </div>
                <div class="col-md-4 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Paper width (In Inches):*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                  </div>
                </div>
                <div class="col-md-4 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Paper height (In Inches):*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                  </div>
                </div>
                <div class="col-md-4 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Stickers in one row:*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                  </div>
                </div>
                <div class="col-md-4 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Distance between two rows (In Inches):*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                  </div>
                </div>
                <div class="col-md-6 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Distance between two columns (In Inches):*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                  </div>
                </div>
                <div class="col-md-6 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">No. of Stickers per sheet:*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                  </div>
                </div>
                <div class="col-md-12 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Sticker Sheet setting Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
                </div>
                <div class="col-md-12 col-12 mb-2">
                  <div class="form-group">
                    <label class="customcheck"> Set as default
                      <input id="checkbox1" type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
              </div>
            </form>


          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- 5- invoice_schemes_model  model  -->
    <div class="modal in " id="invoice_schemes_model" tabindex="-1" role="dialog" aria-labelledby="invoice_schemes_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title"> Invoice Schemes</h4>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class=" col-md-6 col-12">
                <div class="form-group">
                  <label class="option-div">
                    <input type="radio" name="radioname" value="one_value" checked="checked">
                    <div>FORMAT: <br>XXXX <i class="fa fa-check-circle pull-right icon"></i></div>
                  </label>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label class="option-div">
                    <input type="radio" name="radioname" value="one_value">
                    <div>FORMAT: <br>2021-XXXX <i class="fa fa-check-circle pull-right icon"></i></div>
                  </label>
                </div>
              </div>
              <div class="col-md-6 col-12 ">
                <div class="form-group">
                  <label for="heading">Name:*</label>
                  <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true">
                </div>
              </div>
              <div class="col-md-6 col-12 ">
                <div class="form-group">
                  <label for="heading">Prefix:*</label>
                  <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true">
                </div>
              </div>
              <div class="col-md-6 col-12 ">
                <div class="form-group">
                  <label for="heading">Start from:</label>
                  <input class="form-control" required="" name="heading" type="number" id="heading" aria-required="true" placeholder="">
                </div>
              </div>
              <div class="col-md-6 col-12 mb-3">
                <label class="">Number of digits:</label>
                <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-24-ye7m" tabindex="-1" aria-hidden="true">
                  <option data-select2-id="select2-data-26-lyx0">1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-25-3io5" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-b9d7-container" aria-controls="select2-b9d7-container"><span class="select2-selection__rendered" id="select2-b9d7-container" role="textbox" aria-readonly="true" title="1">1</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
              </div>
            </div>



          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- 5- invoice_layouts_model  model  -->
    <div class="modal in bd-example-modal-xl" id="invoice_layouts_model" tabindex="-1" role="dialog" aria-labelledby="printer_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Invoice Layouts</h4>
          </div>

          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Layout name:*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Layout name">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class=""> Design:*</label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-27-zic1" tabindex="-1" aria-hidden="true">
                    <option value="classic" selected="selected" data-select2-id="select2-data-29-cw7x">Classic (For normal printer)</option>
                    <option value="elegant">Elegant (For normal printer)</option>
                    <option value="detailed">Detailed (For normal printer)</option>
                    <option value="columnize-taxes">Columnize Taxes (For normal printer)</option>
                    <option value="slim">Slim (Recommended for thermal line receipt printer, 80mm paper size)</option>
                    <option value="slim2">Slim 2 (Recommended for thermal line receipt printer, 80mm and 58mm paper
                      size)</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-28-e3l9" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ixxd-container" aria-controls="select2-ixxd-container"><span class="select2-selection__rendered" id="select2-ixxd-container" role="textbox" aria-readonly="true" title="Classic (For normal printer)">Classic (For normal printer)</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
               
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Invoice heading: </label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Invoice heading">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Invoice no. label: </label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Invoice no. label">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Date Label: </label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Date Label">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Customer  Label: </label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Customer">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class=""> Custom Fields
                  </label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-30-vms8" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-32-xqb8">Custom Field 1</option>
                    <option value="">Custom Field 2</option>
                    <option value="">Custom Field 3</option>
                    <option value="">Custom Field 4</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-31-hzmg" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-oae1-container" aria-controls="select2-oae1-container"><span class="select2-selection__rendered" id="select2-oae1-container" role="textbox" aria-readonly="true" title="Custom Field 1">Custom Field 1</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 check_box_div ">
                  <label class="customcheck ">
                    Show invoice Logo
                    <input id="checkbox1" class="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="col-md-3 col-12 check_box_div ">
                  <label class="customcheck ">
                    Show location name
                    <input id="checkbox1" class="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="col-md-3 col-12 check_box_div ">
                  <label class="customcheck ">
                    Show Customer information
                    <input id="checkbox1" class="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="col-md-3 col-12 check_box_div ">
                  <label class="customcheck ">
                    Show reward point
                    <input id="checkbox1" class="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div> 
              </div>
              <hr>
              <div class="row">
               <div class="col-12 text-center">
                 <h6>Fields to be shown in location address:</h6>
               </div>
               <div class="col-md-3 col-12 check_box_div ">
                <label class="customcheck ">
                  Landmark
                  <input id="checkbox1" class="checkbox1" type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="col-md-3 col-12 check_box_div ">
                <label class="customcheck ">
                  City
                  <input id="checkbox1" class="checkbox1" type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="col-md-3 col-12 check_box_div ">
                <label class="customcheck ">
                  State
                  <input id="checkbox1" class="checkbox1" type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="col-md-3 col-12 check_box_div ">
                <label class="customcheck ">
                  Country
                  <input id="checkbox1" class="checkbox1" type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div> 
              <div class="col-md-3 col-12 check_box_div ">
                <label class="customcheck ">
                  Zip Code
                  <input id="checkbox1" class="checkbox1" type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div> 
              <div class="col-md-3 col-12 mb-2">
                <label class=""> Custom Fields
                </label>
                <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-33-0jby" tabindex="-1" aria-hidden="true">
                  <option value="" selected="selected" data-select2-id="select2-data-35-7rf0">Custom Field 1</option>
                  <option value="">Custom Field 2</option>
                  <option value="">Custom Field 3</option>
                  <option value="">Custom Field 4</option>
                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-34-i57i" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-hccn-container" aria-controls="select2-hccn-container"><span class="select2-selection__rendered" id="select2-hccn-container" role="textbox" aria-readonly="true" title="Custom Field 1">Custom Field 1</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
              </div>
              </div>
              <hr>
              <div class="row">
                 <div class="col-md-6">
                   <div class="row">
                    <div class="col-12 text-center">
                      <h6>Fields for Communication details:</h6>
                    </div>
                    <div class="col-md-6 col-12 check_box_div ">
                     <label class="customcheck ">
                      Mobile number
                       <input id="checkbox1" class="checkbox1" type="checkbox">
                       <span class="checkmark"></span>
                     </label>
                   </div>
                   <div class="col-md-6 col-12 check_box_div ">
                     <label class="customcheck ">
                      Email
                       <input id="checkbox1" class="checkbox1" type="checkbox">
                       <span class="checkmark"></span>
                     </label>
                   </div>
                   </div>
                 </div>
               
                 <div class="col-md-6">
                  <div class="row">
                   <div class="col-12 text-center">
                     <h6>Fields for Tax details:</h6>
                   </div>
                   <div class="col-md-6 col-12 check_box_div ">
                    <label class="customcheck ">
                      Tax 1 details
                      <input id="checkbox1" class="checkbox1" type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-md-6 col-12 check_box_div ">
                    <label class="customcheck ">
                      Tax 2 details
                      <input id="checkbox1" class="checkbox1" type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  </div>
                </div>
               </div>
              <hr>
              <div class="row">
                <div class="col-12 text-center">
                  <h6>Sub Total to be shown:</h6>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Subtotal label:</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Subtotal label">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Discount label: </label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Discount label">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Tax label: </label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Tax label:">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Total label: </label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Total label:">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Round off label:</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Round off label">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Total Due Label (Current sale):</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Due">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Amount Paid Label:</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Total Paid">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Total Due Label (All sales):</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Total Due Label">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Change return label: </label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Change return ">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class=""> 
                    Word Format:
                  </label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-36-9t9l" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-38-19kn">International</option>
                    <option value=""> Indian</option>
                    
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-37-vqgd" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-wd00-container" aria-controls="select2-wd00-container"><span class="select2-selection__rendered" id="select2-wd00-container" role="textbox" aria-readonly="true" title="International">International</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 check_box_div ">
                  <label class="customcheck ">
                    Show Payment information
                    <input id="checkbox1" class="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="col-md-3 col-12 check_box_div ">
                  <label class="customcheck ">
                    Show Barcode
                    <input id="checkbox1" class="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="col-md-3 col-12 check_box_div ">
                  <label class="customcheck ">
                    Show total in words 
                    <input id="checkbox1" class="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="col-md-3 col-12 check_box_div ">
                  <label class="customcheck ">
                    Show total balance due (All sales) 
                    <input id="checkbox1" class="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div> 
                
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6 col-12 ">
                  <div class="form-group">
                    <label for="heading">Header text:</label>
                    <textarea class="tiny" id="mce_0" aria-hidden="true" style="display: none;"></textarea><div role="application" class="tox tox-tinymce" aria-disabled="false" style="visibility: hidden; height: 200px;"><div class="tox-editor-container"><div data-alloy-vertical-dir="toptobottom" class="tox-editor-header"><div role="menubar" data-alloy-tabstop="true" class="tox-menubar"><button aria-haspopup="true" role="menuitem" type="button" data-alloy-tabstop="true" unselectable="on" tabindex="-1" class="tox-mbtn tox-mbtn--select" aria-expanded="false" style="user-select: none;"><span class="tox-mbtn__select-label">File</span><div class="tox-mbtn__select-chevron"><svg width="10" height="10"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 010-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"></path></svg></div></button><button aria-haspopup="true" role="menuitem" type="button" data-alloy-tabstop="true" unselectable="on" tabindex="-1" class="tox-mbtn tox-mbtn--select" aria-expanded="false" style="user-select: none;"><span class="tox-mbtn__select-label">Edit</span><div class="tox-mbtn__select-chevron"><svg width="10" height="10"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 010-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"></path></svg></div></button><button aria-haspopup="true" role="menuitem" type="button" data-alloy-tabstop="true" unselectable="on" tabindex="-1" class="tox-mbtn tox-mbtn--select" aria-expanded="false" style="user-select: none;"><span class="tox-mbtn__select-label">View</span><div class="tox-mbtn__select-chevron"><svg width="10" height="10"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 010-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"></path></svg></div></button><button aria-haspopup="true" role="menuitem" type="button" data-alloy-tabstop="true" unselectable="on" tabindex="-1" class="tox-mbtn tox-mbtn--select" aria-expanded="false" style="user-select: none;"><span class="tox-mbtn__select-label">Format</span><div class="tox-mbtn__select-chevron"><svg width="10" height="10"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 010-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"></path></svg></div></button></div><div role="group" class="tox-toolbar-overlord" aria-disabled="false"><div role="group" class="tox-toolbar__primary"><div title="history" role="toolbar" data-alloy-tabstop="true" tabindex="-1" class="tox-toolbar__group"><button aria-label="Undo" title="Undo" type="button" tabindex="-1" class="tox-tbtn tox-tbtn--disabled" aria-disabled="true"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M6.4 8H12c3.7 0 6.2 2 6.8 5.1.6 2.7-.4 5.6-2.3 6.8a1 1 0 01-1-1.8c1.1-.6 1.8-2.7 1.4-4.6-.5-2.1-2.1-3.5-4.9-3.5H6.4l3.3 3.3a1 1 0 11-1.4 1.4l-5-5a1 1 0 010-1.4l5-5a1 1 0 011.4 1.4L6.4 8z" fill-rule="nonzero"></path></svg></span></button><button aria-label="Redo" title="Redo" type="button" tabindex="-1" class="tox-tbtn tox-tbtn--disabled" aria-disabled="true"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M17.6 10H12c-2.8 0-4.4 1.4-4.9 3.5-.4 2 .3 4 1.4 4.6a1 1 0 11-1 1.8c-2-1.2-2.9-4.1-2.3-6.8.6-3 3-5.1 6.8-5.1h5.6l-3.3-3.3a1 1 0 111.4-1.4l5 5a1 1 0 010 1.4l-5 5a1 1 0 01-1.4-1.4l3.3-3.3z" fill-rule="nonzero"></path></svg></span></button></div><div title="styles" role="toolbar" data-alloy-tabstop="true" tabindex="-1" class="tox-toolbar__group"><button title="Formats" aria-label="Formats" aria-haspopup="true" type="button" unselectable="on" tabindex="-1" class="tox-tbtn tox-tbtn--select tox-tbtn--bespoke" aria-expanded="false" style="user-select: none;"><span class="tox-tbtn__select-label">Paragraph</span><div class="tox-tbtn__select-chevron"><svg width="10" height="10"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 010-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"></path></svg></div></button></div><div title="formatting" role="toolbar" data-alloy-tabstop="true" tabindex="-1" class="tox-toolbar__group"><button aria-label="Bold" title="Bold" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M7.8 19c-.3 0-.5 0-.6-.2l-.2-.5V5.7c0-.2 0-.4.2-.5l.6-.2h5c1.5 0 2.7.3 3.5 1 .7.6 1.1 1.4 1.1 2.5a3 3 0 01-.6 1.9c-.4.6-1 1-1.6 1.2.4.1.9.3 1.3.6s.8.7 1 1.2c.4.4.5 1 .5 1.6 0 1.3-.4 2.3-1.3 3-.8.7-2.1 1-3.8 1H7.8zm5-8.3c.6 0 1.2-.1 1.6-.5.4-.3.6-.7.6-1.3 0-1.1-.8-1.7-2.3-1.7H9.3v3.5h3.4zm.5 6c.7 0 1.3-.1 1.7-.4.4-.4.6-.9.6-1.5s-.2-1-.7-1.4c-.4-.3-1-.4-2-.4H9.4v3.8h4z" fill-rule="evenodd"></path></svg></span></button><button aria-label="Italic" title="Italic" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M16.7 4.7l-.1.9h-.3c-.6 0-1 0-1.4.3-.3.3-.4.6-.5 1.1l-2.1 9.8v.6c0 .5.4.8 1.4.8h.2l-.2.8H8l.2-.8h.2c1.1 0 1.8-.5 2-1.5l2-9.8.1-.5c0-.6-.4-.8-1.4-.8h-.3l.2-.9h5.8z" fill-rule="evenodd"></path></svg></span></button></div><div title="alignment" role="toolbar" data-alloy-tabstop="true" tabindex="-1" class="tox-toolbar__group"><button aria-label="Align left" title="Align left" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm0 4h8c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm0 8h8c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2zm0-4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2z" fill-rule="evenodd"></path></svg></span></button><button aria-label="Align center" title="Align center" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm3 4h8c.6 0 1 .4 1 1s-.4 1-1 1H8a1 1 0 110-2zm0 8h8c.6 0 1 .4 1 1s-.4 1-1 1H8a1 1 0 010-2zm-3-4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2z" fill-rule="evenodd"></path></svg></span></button><button aria-label="Align right" title="Align right" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm6 4h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 010-2zm0 8h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 010-2zm-6-4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2z" fill-rule="evenodd"></path></svg></span></button><button aria-label="Justify" title="Justify" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm0 4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm0 4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2zm0 4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2z" fill-rule="evenodd"></path></svg></span></button></div><div title="indentation" role="toolbar" data-alloy-tabstop="true" tabindex="-1" class="tox-toolbar__group"><button aria-label="Decrease indent" title="Decrease indent" type="button" tabindex="-1" class="tox-tbtn tox-tbtn--disabled" aria-disabled="true"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M7 5h12c.6 0 1 .4 1 1s-.4 1-1 1H7a1 1 0 110-2zm5 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 010-2zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 010-2zm-5 4h12a1 1 0 010 2H7a1 1 0 010-2zm1.6-3.8a1 1 0 01-1.2 1.6l-3-2a1 1 0 010-1.6l3-2a1 1 0 011.2 1.6L6.8 12l1.8 1.2z" fill-rule="evenodd"></path></svg></span></button><button aria-label="Increase indent" title="Increase indent" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M7 5h12c.6 0 1 .4 1 1s-.4 1-1 1H7a1 1 0 110-2zm5 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 010-2zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 010-2zm-5 4h12a1 1 0 010 2H7a1 1 0 010-2zm-2.6-3.8L6.2 12l-1.8-1.2a1 1 0 011.2-1.6l3 2a1 1 0 010 1.6l-3 2a1 1 0 11-1.2-1.6z" fill-rule="evenodd"></path></svg></span></button></div></div></div><div class="tox-anchorbar"></div></div><div class="tox-sidebar-wrap"><div class="tox-edit-area"><iframe id="mce_0_ifr" frameborder="0" allowtransparency="true" title="Rich Text Area. Press ALT-0 for help." class="tox-edit-area__iframe"></iframe></div><div role="complementary" class="tox-sidebar"><div data-alloy-tabstop="true" tabindex="-1" class="tox-sidebar__slider tox-sidebar--sliding-closed" style="width: 0px;"><div class="tox-sidebar__pane-container"></div></div></div></div></div><div class="tox-statusbar"><div class="tox-statusbar__text-container"><div role="navigation" data-alloy-tabstop="true" class="tox-statusbar__path" aria-disabled="false"><div role="button" data-index="0" tab-index="-1" aria-level="1" tabindex="-1" class="tox-statusbar__path-item" aria-disabled="false">p</div></div><span class="tox-statusbar__branding"><a href="https://www.tiny.cloud/?utm_campaign=editor_referral&amp;utm_medium=poweredby&amp;utm_source=tinymce&amp;utm_content=v5" rel="noopener" target="_blank" tabindex="-1" aria-label="Powered by Tiny">Powered by Tiny</a></span></div><div title="Resize" data-alloy-tabstop="true" tabindex="-1" class="tox-statusbar__resize-handle"><svg width="10" height="10"><g fill-rule="nonzero"><path d="M8.1 1.1A.5.5 0 119 2l-7 7A.5.5 0 111 8l7-7zM8.1 5.1A.5.5 0 119 6l-3 3A.5.5 0 115 8l3-3z"></path></g></svg></div></div><div aria-hidden="true" class="tox-throbber" style="display: none;"></div></div>
                  </div>
                </div>
                <div class="col-md-6 col-12 ">
                  <div class="form-group">
                    <label for="heading">Footer text:</label>
                    <textarea class="tiny" id="mce_2" aria-hidden="true" style="display: none;"></textarea><div role="application" class="tox tox-tinymce" aria-disabled="false" style="visibility: hidden; height: 200px;"><div class="tox-editor-container"><div data-alloy-vertical-dir="toptobottom" class="tox-editor-header"><div role="menubar" data-alloy-tabstop="true" class="tox-menubar"><button aria-haspopup="true" role="menuitem" type="button" data-alloy-tabstop="true" unselectable="on" tabindex="-1" class="tox-mbtn tox-mbtn--select" aria-expanded="false" style="user-select: none;"><span class="tox-mbtn__select-label">File</span><div class="tox-mbtn__select-chevron"><svg width="10" height="10"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 010-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"></path></svg></div></button><button aria-haspopup="true" role="menuitem" type="button" data-alloy-tabstop="true" unselectable="on" tabindex="-1" class="tox-mbtn tox-mbtn--select" aria-expanded="false" style="user-select: none;"><span class="tox-mbtn__select-label">Edit</span><div class="tox-mbtn__select-chevron"><svg width="10" height="10"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 010-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"></path></svg></div></button><button aria-haspopup="true" role="menuitem" type="button" data-alloy-tabstop="true" unselectable="on" tabindex="-1" class="tox-mbtn tox-mbtn--select" aria-expanded="false" style="user-select: none;"><span class="tox-mbtn__select-label">View</span><div class="tox-mbtn__select-chevron"><svg width="10" height="10"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 010-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"></path></svg></div></button><button aria-haspopup="true" role="menuitem" type="button" data-alloy-tabstop="true" unselectable="on" tabindex="-1" class="tox-mbtn tox-mbtn--select" aria-expanded="false" style="user-select: none;"><span class="tox-mbtn__select-label">Format</span><div class="tox-mbtn__select-chevron"><svg width="10" height="10"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 010-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"></path></svg></div></button></div><div role="group" class="tox-toolbar-overlord" aria-disabled="false"><div role="group" class="tox-toolbar__primary"><div title="history" role="toolbar" data-alloy-tabstop="true" tabindex="-1" class="tox-toolbar__group"><button aria-label="Undo" title="Undo" type="button" tabindex="-1" class="tox-tbtn tox-tbtn--disabled" aria-disabled="true"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M6.4 8H12c3.7 0 6.2 2 6.8 5.1.6 2.7-.4 5.6-2.3 6.8a1 1 0 01-1-1.8c1.1-.6 1.8-2.7 1.4-4.6-.5-2.1-2.1-3.5-4.9-3.5H6.4l3.3 3.3a1 1 0 11-1.4 1.4l-5-5a1 1 0 010-1.4l5-5a1 1 0 011.4 1.4L6.4 8z" fill-rule="nonzero"></path></svg></span></button><button aria-label="Redo" title="Redo" type="button" tabindex="-1" class="tox-tbtn tox-tbtn--disabled" aria-disabled="true"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M17.6 10H12c-2.8 0-4.4 1.4-4.9 3.5-.4 2 .3 4 1.4 4.6a1 1 0 11-1 1.8c-2-1.2-2.9-4.1-2.3-6.8.6-3 3-5.1 6.8-5.1h5.6l-3.3-3.3a1 1 0 111.4-1.4l5 5a1 1 0 010 1.4l-5 5a1 1 0 01-1.4-1.4l3.3-3.3z" fill-rule="nonzero"></path></svg></span></button></div><div title="styles" role="toolbar" data-alloy-tabstop="true" tabindex="-1" class="tox-toolbar__group"><button title="Formats" aria-label="Formats" aria-haspopup="true" type="button" unselectable="on" tabindex="-1" class="tox-tbtn tox-tbtn--select tox-tbtn--bespoke" aria-expanded="false" style="user-select: none;"><span class="tox-tbtn__select-label">Paragraph</span><div class="tox-tbtn__select-chevron"><svg width="10" height="10"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 010-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"></path></svg></div></button></div><div title="formatting" role="toolbar" data-alloy-tabstop="true" tabindex="-1" class="tox-toolbar__group"><button aria-label="Bold" title="Bold" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M7.8 19c-.3 0-.5 0-.6-.2l-.2-.5V5.7c0-.2 0-.4.2-.5l.6-.2h5c1.5 0 2.7.3 3.5 1 .7.6 1.1 1.4 1.1 2.5a3 3 0 01-.6 1.9c-.4.6-1 1-1.6 1.2.4.1.9.3 1.3.6s.8.7 1 1.2c.4.4.5 1 .5 1.6 0 1.3-.4 2.3-1.3 3-.8.7-2.1 1-3.8 1H7.8zm5-8.3c.6 0 1.2-.1 1.6-.5.4-.3.6-.7.6-1.3 0-1.1-.8-1.7-2.3-1.7H9.3v3.5h3.4zm.5 6c.7 0 1.3-.1 1.7-.4.4-.4.6-.9.6-1.5s-.2-1-.7-1.4c-.4-.3-1-.4-2-.4H9.4v3.8h4z" fill-rule="evenodd"></path></svg></span></button><button aria-label="Italic" title="Italic" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M16.7 4.7l-.1.9h-.3c-.6 0-1 0-1.4.3-.3.3-.4.6-.5 1.1l-2.1 9.8v.6c0 .5.4.8 1.4.8h.2l-.2.8H8l.2-.8h.2c1.1 0 1.8-.5 2-1.5l2-9.8.1-.5c0-.6-.4-.8-1.4-.8h-.3l.2-.9h5.8z" fill-rule="evenodd"></path></svg></span></button></div><div title="alignment" role="toolbar" data-alloy-tabstop="true" tabindex="-1" class="tox-toolbar__group"><button aria-label="Align left" title="Align left" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm0 4h8c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm0 8h8c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2zm0-4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2z" fill-rule="evenodd"></path></svg></span></button><button aria-label="Align center" title="Align center" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm3 4h8c.6 0 1 .4 1 1s-.4 1-1 1H8a1 1 0 110-2zm0 8h8c.6 0 1 .4 1 1s-.4 1-1 1H8a1 1 0 010-2zm-3-4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2z" fill-rule="evenodd"></path></svg></span></button><button aria-label="Align right" title="Align right" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm6 4h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 010-2zm0 8h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 010-2zm-6-4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2z" fill-rule="evenodd"></path></svg></span></button><button aria-label="Justify" title="Justify" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false" aria-pressed="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm0 4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 110-2zm0 4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2zm0 4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 010-2z" fill-rule="evenodd"></path></svg></span></button></div><div title="indentation" role="toolbar" data-alloy-tabstop="true" tabindex="-1" class="tox-toolbar__group"><button aria-label="Decrease indent" title="Decrease indent" type="button" tabindex="-1" class="tox-tbtn tox-tbtn--disabled" aria-disabled="true"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M7 5h12c.6 0 1 .4 1 1s-.4 1-1 1H7a1 1 0 110-2zm5 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 010-2zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 010-2zm-5 4h12a1 1 0 010 2H7a1 1 0 010-2zm1.6-3.8a1 1 0 01-1.2 1.6l-3-2a1 1 0 010-1.6l3-2a1 1 0 011.2 1.6L6.8 12l1.8 1.2z" fill-rule="evenodd"></path></svg></span></button><button aria-label="Increase indent" title="Increase indent" type="button" tabindex="-1" class="tox-tbtn" aria-disabled="false"><span class="tox-icon tox-tbtn__icon-wrap"><svg width="24" height="24"><path d="M7 5h12c.6 0 1 .4 1 1s-.4 1-1 1H7a1 1 0 110-2zm5 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 010-2zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 010-2zm-5 4h12a1 1 0 010 2H7a1 1 0 010-2zm-2.6-3.8L6.2 12l-1.8-1.2a1 1 0 011.2-1.6l3 2a1 1 0 010 1.6l-3 2a1 1 0 11-1.2-1.6z" fill-rule="evenodd"></path></svg></span></button></div></div></div><div class="tox-anchorbar"></div></div><div class="tox-sidebar-wrap"><div class="tox-edit-area"><iframe id="mce_2_ifr" frameborder="0" allowtransparency="true" title="Rich Text Area. Press ALT-0 for help." class="tox-edit-area__iframe"></iframe></div><div role="complementary" class="tox-sidebar"><div data-alloy-tabstop="true" tabindex="-1" class="tox-sidebar__slider tox-sidebar--sliding-closed" style="width: 0px;"><div class="tox-sidebar__pane-container"></div></div></div></div></div><div class="tox-statusbar"><div class="tox-statusbar__text-container"><div role="navigation" data-alloy-tabstop="true" class="tox-statusbar__path" aria-disabled="false"><div role="button" data-index="0" tab-index="-1" aria-level="1" tabindex="-1" class="tox-statusbar__path-item" aria-disabled="false">p</div></div><span class="tox-statusbar__branding"><a href="https://www.tiny.cloud/?utm_campaign=editor_referral&amp;utm_medium=poweredby&amp;utm_source=tinymce&amp;utm_content=v5" rel="noopener" target="_blank" tabindex="-1" aria-label="Powered by Tiny">Powered by Tiny</a></span></div><div title="Resize" data-alloy-tabstop="true" tabindex="-1" class="tox-statusbar__resize-handle"><svg width="10" height="10"><g fill-rule="nonzero"><path d="M8.1 1.1A.5.5 0 119 2l-7 7A.5.5 0 111 8l7-7zM8.1 5.1A.5.5 0 119 6l-3 3A.5.5 0 115 8l3-3z"></path></g></svg></div></div><div aria-hidden="true" class="tox-throbber" style="display: none;"></div></div>
                  </div>
                </div>
              </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- 5- invoice_layouts_model  model  -->
    <div class="modal in bd-example-modal-xl" id="business_locations_model" tabindex="-1" role="dialog" aria-labelledby="printer_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Manage business location</h4>
          </div>

          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Name:*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" name">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Location ID:</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Location ID">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Landmark:</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Landmark ">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">City:*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" City ">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Zip Code:</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Zip Code ">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading"> State:</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" State ">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Country:*</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Country ">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Mobile:</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Mobile ">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Alternate contact number:</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Alternate contact number ">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Email:</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Email ">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <div class="form-group">
                    <label for="heading">Website:</label>
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Website ">
                  </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class=""> Invoice scheme:*
                    <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Invoice Scheme means invoice numbering format. Select the scheme to be used for this business location<br><small class='text-muted'><i>You can add new Invoice Scheme</b> in Invoice Settings</i></small>"></span></a>
                  </label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-39-k9dz" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-41-v467">Defualt</option>
                    <option value="">Year</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-40-1mvn" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-85tn-container" aria-controls="select2-85tn-container"><span class="select2-selection__rendered" id="select2-85tn-container" role="textbox" aria-readonly="true" title="Defualt">Defualt</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class=""> Invoice layout for POS:*
                    <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Invoice Layout to be used for this business location<br><small class='text-muted'>(<i>You can add new <b>Invoice Layout</b> in <b>Invoice Settings<b></i>)</small>"></span></a>
                  </label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-42-her4" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-44-8ytb">Defualt</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-43-n4e2" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-s06r-container" aria-controls="select2-s06r-container"><span class="select2-selection__rendered" id="select2-s06r-container" role="textbox" aria-readonly="true" title="Defualt">Defualt</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class=""> Invoice layout for sale:*
                    <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Invoice layout for direct sales"></span></a>
                  </label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-45-kwt2" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-47-aree">Defualt</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-46-4qa0" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-w1tt-container" aria-controls="select2-w1tt-container"><span class="select2-selection__rendered" id="select2-w1tt-container" role="textbox" aria-readonly="true" title="Defualt">Defualt</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class=""> Default Selling Price Group:
                    <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="This price group will be used as the default price group in this location."></span></a>
                  </label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-48-qxk0" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-50-99ti">Defualt</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-49-uojv" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-x3fw-container" aria-controls="select2-x3fw-container"><span class="select2-selection__rendered" id="select2-x3fw-container" role="textbox" aria-readonly="true" title="Defualt">Defualt</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class=""> Auto print invoice after finalizing:
                    <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Enable or Disable auto-printing of invoice on finalizing"></span></a>
                  </label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-51-ee5q" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-53-if8o">Yes</option>
                    <option value="">No</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-52-ffnz" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-pghl-container" aria-controls="select2-pghl-container"><span class="select2-selection__rendered" id="select2-pghl-container" role="textbox" aria-readonly="true" title="Yes">Yes</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class="">Receipt Printer Type:*
                    <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="<i>Browser Based Printing</i>: Show Browser Print Dialog Box with Invoice Preview<br/><br/> <i>Use Configured Receipt Printer</i>: Select a Configured Receipt / Thermal printer for printing"></span></a>
                  </label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-54-5qsx" tabindex="-1" aria-hidden="true">
                    <option value="browser" selected="selected" data-select2-id="select2-data-56-hvmy">Browser Based Printing</option>
                    <option value="printer">Use Configured Receipt Printer</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-55-udw0" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-jv2z-container" aria-controls="select2-jv2z-container"><span class="select2-selection__rendered" id="select2-jv2z-container" role="textbox" aria-readonly="true" title="Browser Based Printing">Browser Based Printing</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class="">Invoice layout:* 
                    <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Invoice Layout to be used for this business location<br><small class='text-muted'>(<i>You can add new <b>Invoice Layout</b> in <b>Invoice Settings<b></i>)</small>"></span></a>
                  </label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-57-dqrm" tabindex="-1" aria-hidden="true">
                    <option value="browser" selected="selected" data-select2-id="select2-data-59-e9by">Defualt</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-58-7dke" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-amsh-container" aria-controls="select2-amsh-container"><span class="select2-selection__rendered" id="select2-amsh-container" role="textbox" aria-readonly="true" title="Defualt">Defualt</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-6 col-12 mb-2">
                  <label class="">POS screen Featured Products:
                    <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Selected products will be shown on top of the pos screen product suggestion for quick access"></span></a>
                  </label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-60-e776" tabindex="-1" aria-hidden="true">
                    <option data-select2-id="select2-data-62-xp8h">Defualt</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-61-9eln" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-wcbg-container" aria-controls="select2-wcbg-container"><span class="select2-selection__rendered" id="select2-wcbg-container" role="textbox" aria-readonly="true" title="Defualt">Defualt</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12 text-center mb-3">
                  <h5>Payment Options:</h5>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class="customcheck"> Cash <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Payment Method"></span></a>
                    <input id="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
      
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-63-ys0r" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-65-g53w">None</option>
                    <option value="">BMisr</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-64-izws" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-cywo-container" aria-controls="select2-cywo-container"><span class="select2-selection__rendered" id="select2-cywo-container" role="textbox" aria-readonly="true" title="None">None</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class="customcheck"> Card <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Payment Method"></span></a>
                    <input id="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
      
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-66-z82y" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-68-uyn7">None</option>
                    <option value="">BMisr</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-67-ppzk" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-wrrn-container" aria-controls="select2-wrrn-container"><span class="select2-selection__rendered" id="select2-wrrn-container" role="textbox" aria-readonly="true" title="None">None</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class="customcheck"> Cheque <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Payment Method"></span></a>
                    <input id="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
      
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-69-8f4u" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-71-rwcg">None</option>
                    <option value="">BMisr</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-70-3g3p" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-g92g-container" aria-controls="select2-g92g-container"><span class="select2-selection__rendered" id="select2-g92g-container" role="textbox" aria-readonly="true" title="None">None</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class="customcheck"> Bank Transfer <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Payment Method"></span></a>
                    <input id="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
      
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-72-7vd9" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-74-cbvc">None</option>
                    <option value="">BMisr</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-73-5rsb" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-3lax-container" aria-controls="select2-3lax-container"><span class="select2-selection__rendered" id="select2-3lax-container" role="textbox" aria-readonly="true" title="None">None</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class="customcheck"> Other <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Payment Method"></span></a>
                    <input id="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
      
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-75-804w" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-77-hr24">None</option>
                    <option value="">BMisr</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-76-o7zc" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-6udj-container" aria-controls="select2-6udj-container"><span class="select2-selection__rendered" id="select2-6udj-container" role="textbox" aria-readonly="true" title="None">None</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class="customcheck"> Custom Payment 1 <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Payment Method"></span></a>
                    <input id="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
      
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-78-etrm" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-80-pvaf">None</option>
                    <option value="">BMisr</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-79-cmqh" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-65lh-container" aria-controls="select2-65lh-container"><span class="select2-selection__rendered" id="select2-65lh-container" role="textbox" aria-readonly="true" title="None">None</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class="customcheck"> Custom Payment 2 <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Payment Method"></span></a>
                    <input id="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
      
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-81-cu5b" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-83-d0ev">None</option>
                    <option value="">BMisr</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-82-o6yj" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-yq0q-container" aria-controls="select2-yq0q-container"><span class="select2-selection__rendered" id="select2-yq0q-container" role="textbox" aria-readonly="true" title="None">None</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
                <div class="col-md-3 col-12 mb-2">
                  <label class="customcheck"> Custom Payment 3 <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Payment Method"></span></a>
                    <input id="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
      
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-84-rtcs" tabindex="-1" aria-hidden="true">
                    <option value="" selected="selected" data-select2-id="select2-data-86-0zbn">None</option>
                    <option value="">BMisr</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-85-mmo1" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-kqk6-container" aria-controls="select2-kqk6-container"><span class="select2-selection__rendered" id="select2-kqk6-container" role="textbox" aria-readonly="true" title="None">None</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
              </div>
              
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- 1-custom Field modal 1 -->
    <div class="modal in" id="custom_field_model1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Custom fields</h4>
          </div>
 
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <span>
                  Customize Vaux to your specific needs with custom fields for products, orders, customers, and vendors.
                </span>
              </div>
            </div>
            <div class="tax_item">
              <div class="row">
                <div class="col-md-6">   
                    <h6>Sales Order</h6>  
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                  <a data-dismiss="modal" data-toggle="modal" href="#custom_field_model2"><i class="fas fa-arrow-circle-right tax_arrow"></i>
                  </a>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">   
                    <h6>Purchase Order</h6>  
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                  <a data-dismiss="modal" data-toggle="modal" href="#custom_field_model2"><i class="fas fa-arrow-circle-right tax_arrow"></i>
                  </a>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">   
                    <h6> Product</h6>  
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                  <a data-dismiss="modal" data-toggle="modal" href="#custom_field_model2"><i class="fas fa-arrow-circle-right tax_arrow"></i>
                  </a>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">   
                    <h6> Customer</h6>  
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                  <a data-dismiss="modal" data-toggle="modal" href="#custom_field_model2"><i class="fas fa-arrow-circle-right tax_arrow"></i>
                  </a>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">   
                    <h6> Vendor</h6>  
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                  <a data-dismiss="modal" data-toggle="modal" href="#custom_field_model2"><i class="fas fa-arrow-circle-right tax_arrow"></i>
                  </a>
                </div>
              </div>
              <hr>
            </div>
    
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- 2- custom Field modal 2 -->
    <div class="modal in" id="custom_field_model2" tabindex="-1" role="dialog" aria-labelledby="tax_rate_model2" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <a data-dismiss="modal" data-toggle="modal" href="#custom_field_model1" class="modal-title"><i class="fas fa-arrow-circle-left tax_arrow"></i><span>
                  Sales order custom fields</span></a>
          </div>
          <div class="modal-body">
              <div class="multi-field-wrapper">
                <div class="multi-fields">
                  <div class="multi-field d-flex mb-3">
                    <button type="button" class=" remove-field remove_btn">
                      <i class="fas fa-times"></i>
                    </button>
                    <h6>Field</h6>
                    <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="Enter field name">
                      <label class="customcheck"> Print 
                        <input id="checkbox1" type="checkbox">
                        <span class="checkmark"></span>
                      </label>
                  </div>
                
                </div>
                <div class="row justify-content-between my-1">
                  <div class="col-md-12">
                    <button type="button" class="btn  add-field">
                      <i class="fa fa-plus"></i>Add custom field
                    </button>
                  </div>
                </div>
              </div>
             
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>

     <!-- - purchase_model    -->
     <div class="modal in " id="purchase_model" tabindex="-1" role="dialog" aria-labelledby="printer_model" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
         <div class="modal-header dir_rtl">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
           <h4 class="modal-title"> Purchase</h4>
         </div>

         <div class="modal-body">
           <form>
             <div class="row">
               <div class="col-md-12 col-12 check_box_div ">
                 <label class="customcheck ">
                  Enable editing product price from purchase screen 
                  <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-original-title="If enabled product purchase price and selling price will be updated after a purchase is added or updated"></span></a>
                   <input id="checkbox1" class="checkbox1" type="checkbox">
                   <span class="checkmark"></span>
                 </label>
               </div>
               <div class="col-md-12 col-12 check_box_div ">
                <label class="customcheck ">
                  Enable Purchase Status
                 <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-original-title="On disable all purchases will be marked as <i>Item Received</i>"></span></a>
                  <input id="checkbox1" class="checkbox1" type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="col-md-12 col-12 check_box_div ">
                <label class="customcheck ">
                  Enable Lot number
                 <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-original-title="This will enable you to enter Lot number for each purchase line in purchase screen"></span></a>
                  <input id="checkbox1" class="checkbox1" type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
             </div>
             <hr>

           </form>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary btn-sm">Save</button>
           <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
             Close
           </button>
         </div>
       </div>
     </div>
   </div>
   <!-- 5- product model    -->
   <div class="modal in " id="product_model" tabindex="-1" role="dialog" aria-labelledby="product_model" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header dir_rtl">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
         <h4 class="modal-title">Product model </h4>
       </div>
       <div class="modal-body">
         <form>
           <div class="row">
             <div class="col-md-6 col-12 mb-2">
               <div class="form-group">
                 <label for="heading">SKU prefix:</label>
                 <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true">
               </div>
             </div>
             <div class="col-md-6 col-12 mb-2">
               <label class=""> Enable Product Expiry:
                <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Enable product expiry. <br/> <br/><b>Add item expiry</b>: To directly add item expiry only. <br/> <b>Add manufacturing date &amp; expiry period</b>: To add manufacturing date &amp; expiry period and calculate expiry date based on that."></span></a>
               </label>
               <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-87-p5uz" tabindex="-1" aria-hidden="true">
                <option value="add_expiry" selected="" data-select2-id="select2-data-89-jf8r">
                  Add item expiry
              </option>
              <option value="add_manufacturing">Add manufacturing date &amp; expiry period</option>
               </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-88-uutm" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ber8-container" aria-controls="select2-ber8-container"><span class="select2-selection__rendered" id="select2-ber8-container" role="textbox" aria-readonly="true" title="
                  Add item expiry
              ">
                  Add item expiry
              </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
             </div>
             <div class="col-md-6 col-12 mb-2">
                <div class="input-icons">
                  <label class="">On Product Expiry:
                    <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Specify action that needs to be done on product expiry. <br><br> <b>Keep Selling</b>: Products will be kept on selling after expiry also. <br> <b>Stop Selling</b>: Stop selling item n days before expiry."></span></a>
                  </label><br>
                  <div class="inline_inputs d-flex">
                    <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" style="width:40%;">
                    <div class="width-60">
                      <select class="mySelect select3 form-control select2-hidden-accessible" style="width:60% !important;" data-select2-id="select2-data-90-mnw0" tabindex="-1" aria-hidden="true">
                        <option value="keep_selling" selected="selected" data-select2-id="select2-data-92-1dmy">Keep Selling</option>
                        <option value="stop_selling">Stop Selling n days before</option>
                      </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-91-k5xs" style="width: 60%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-nwjl-container" aria-controls="select2-nwjl-container"><span class="select2-selection__rendered" id="select2-nwjl-container" role="textbox" aria-readonly="true" title="Keep Selling">Keep Selling</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                     
                    </div>
                  </div>
              
              </div>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <label class="">Default Unit:</label>
              <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-93-cwls" tabindex="-1" aria-hidden="true">
                <option value="">Please Select</option><option value="18" selected="selected" data-select2-id="select2-data-95-wx7t">Pieces (Pc(s))</option><option value="23">Meters (M)</option>
              </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-94-1pu3" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-0d60-container" aria-controls="select2-0d60-container"><span class="select2-selection__rendered" id="select2-0d60-container" role="textbox" aria-readonly="true" title="Pieces (Pc(s))">Pieces (Pc(s))</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <label class="customcheck"> Enable Brands
                <input id="checkbox1" type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <label class="customcheck">  Enable Categories
                <input id="checkbox1" type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <label class="customcheck"> Enable Sub-Categories
                <input id="checkbox1" type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <label class="customcheck"> Enable Price &amp; Tax info
                <input id="checkbox1" type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <label class="customcheck">  Enable Sub Units 
                <input id="checkbox1" type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
             <div class="col-md-6 col-12 mb-2">
              <label class="customcheck">  Enable Racks
                <input id="checkbox1" type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <label class="customcheck">   Enable Row
                <input id="checkbox1" type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <label class="customcheck">  Enable Position
                <input id="checkbox1" type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <label class="customcheck">    Enable Warranty
                <input id="checkbox1" type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <label class="customcheck">    Sales price is minimum selling price
                <input id="checkbox1" type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <label class="customcheck">    Allow Overselling 
                <input id="checkbox1" type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
           </div>
  

         </form>
       </div>
       <div class="modal-footer">
         <button type="submit" class="btn btn-primary btn-sm">Save</button>
         <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
           Close
         </button>
       </div>
     </div>
   </div>
 </div>
 <!-- 5- Weighing_model     -->
 <div class="modal in " id="Weighing_model" tabindex="-1" role="dialog" aria-labelledby="Weighing_model" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
   <div class="modal-content">
     <div class="modal-header dir_rtl">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
       <h4 class="modal-title">Weighing Scale barcode Setting </h4>
     </div>
     <div class="modal-body">
       <form>
         <div class="row">
           <div class="col-md-6 col-12 mb-2">
             <div class="form-group">
               <label for="heading"> prefix:</label>
               <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true">
             </div>
           </div>
           <div class="col-md-6 col-12 mb-2">
             <label class="">Product sku length:
      
             </label>
             <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-96-6xa1" tabindex="-1" aria-hidden="true">
              <option value="" data-select2-id="select2-data-98-0do9">1</option>
              <option value="">2</option>
              <option value="">3</option>
              <option value="">4</option>
             </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-97-8ej9" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-rnf9-container" aria-controls="select2-rnf9-container"><span class="select2-selection__rendered" id="select2-rnf9-container" role="textbox" aria-readonly="true" title="1">1</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
           </div>
           <div class="col-md-6 col-12 mb-2">
            <label class="">Quantity integer part length:
     
            </label>
            <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-99-t0zb" tabindex="-1" aria-hidden="true">
             <option value="" data-select2-id="select2-data-101-fwfx">1</option>
             <option value="">2</option>
             <option value="">3</option>
             <option value="">4</option>
            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-100-ib9n" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-hsd1-container" aria-controls="select2-hsd1-container"><span class="select2-selection__rendered" id="select2-hsd1-container" role="textbox" aria-readonly="true" title="1">1</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
          </div>
          <div class="col-md-6 col-12 mb-2">
            <label class=""> 
              Quantity fractional part length:
     
            </label>
            <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-102-22d2" tabindex="-1" aria-hidden="true">
             <option value="" data-select2-id="select2-data-104-p6k5">1</option>
             <option value="">2</option>
             <option value="">3</option>
             <option value="">4</option>
            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-103-lfd6" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-r2cp-container" aria-controls="select2-r2cp-container"><span class="select2-selection__rendered" id="select2-r2cp-container" role="textbox" aria-readonly="true" title="1">1</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
          </div>
         </div>


       </form>
     </div>
     <div class="modal-footer">
       <button type="submit" class="btn btn-primary btn-sm">Save</button>
       <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
         Close
       </button>
     </div>
   </div>
 </div>
</div>

 <!-- 5- discount model    -->
 <div class="modal fade bd-example-modal-lg" id="discounts_model" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header dir_rtl">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">
                          Add Discount</h4>
                      </div>
                    
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="heading">Name:*</label>
                              <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Name">
                            </div>
                          </div>
                      
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="heading">Products:</label>
                              <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Short Name:">
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                           <div class="form-group">
                            <label class="">Brand:</label>
                            <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-105-afoc" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-107-j0zp">Please Select</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-106-6k8j" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-1fep-container" aria-controls="select2-1fep-container"><span class="select2-selection__rendered" id="select2-1fep-container" role="textbox" aria-readonly="true" title="Please Select">Please Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                           </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              <label class="">Category:</label>
                            <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-108-q8xn" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-110-vdb9">Please Select</option>
                              <option>Watches</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-109-di8z" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-2bbg-container" aria-controls="select2-2bbg-container"><span class="select2-selection__rendered" id="select2-2bbg-container" role="textbox" aria-readonly="true" title="Please Select">Please Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                           <div class="form-group">
                            <label class="">Location:*</label>
                            <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-111-wau6" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-113-yunj">Please Select</option>
                              <option>Demo All in One (BL0001)</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-112-o6tj" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-hfsz-container" aria-controls="select2-hfsz-container"><span class="select2-selection__rendered" id="select2-hfsz-container" role="textbox" aria-readonly="true" title="Please Select">Please Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                           </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="heading">Priority:
                                <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-html="true" data-original-title="Discount with higher priority will have higher weightage, however priority will not be considered for exact matches"></span></a>
                              </label>
                              <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Short Name:">
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              <label class="">Discount Type:*</label>
                            <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-114-op0h" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-116-xc64">Please Select</option>
                              <option>Fixed</option>
                              <option>Percentage</option>
                              
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-115-wucr" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-gjsi-container" aria-controls="select2-gjsi-container"><span class="select2-selection__rendered" id="select2-gjsi-container" role="textbox" aria-readonly="true" title="Please Select">Please Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="heading">   Discount Amount:*
                              </label>
                              <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="    Discount Amount:*">
                            </div>
                          </div>
                         
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="heading"> Starts At:
                              </label>
                              <input class="form-control" required="" name="heading" type="date" id="heading" aria-required="true" placeholder="    Discount Amount:*">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="heading">   Ends At:
                              </label>
                              <input class="form-control" required="" name="heading" type="date" id="heading" aria-required="true" placeholder=" ">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="heading">Default Sale Discount:*</label>
                              <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="0.00">
                            </div>
                          </div>
                        </div>
                        <div class="form-check my-3">
                          <div class="row">
                            <div class="col-md-4 col-12">
                              <label class="customcheck"> Apply in selling price groups
                             
                                <input id="checkbox1" class="checkbox1" type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                            </div>
                            <div class="col-md-4 col-12">
                              <label class="customcheck"> Apply in customer groups
                                <input id="checkbox1" class="checkbox1" type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                            </div>
                            <div class="col-md-4 col-12">
                              <label class="customcheck"> Is active
                            
                                <input id="checkbox1" class="checkbox1" type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                            </div>
                         
                          </div>

                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                          Save </button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                          Close </button>
                      </div>
                    </div>
                  </div>
                </div>
    <!-- 1- Reset Data model -->
    <div class="modal in" id="reset_data_model" tabindex="-1" role="dialog" aria-labelledby="add_table_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="modalTitle">Reset data <br> <small class="font_small">
                Just a reminder that this will delete ALL of your Vaux Cloud data. You and your team won’t be able
                to access Vaux Cloud while the reset is happening, but once it’s complete we’ll notify you by email at
                the address on your Vaux Cloud profile.</small></h4>

          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-md-12 col-12 mb-3">
                <label class="">When you are ready to continue, please type RESET DATA below.</label>
                <input type="text" class="form-control form-control-rounded" id="regular-form-2">
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Reset</button>
          </div>
        </div>
      </div>
    </div>
    
      
    <!-- ___________________________ Integration tab Model ______________________  -->

    <!-- 1- woocommerce -->
    <div class="modal in" id="wooCommerce_model" tabindex="-1" role="dialog" aria-labelledby="add_table_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="modalTitle">WooCommerce setup and settings <br> <small class="font_small">inFlow
                will pull sales orders from WooCommerce and push inventory levels to WooCommerce in real time.</small>
            </h4>

          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-md-12 col-12 mb-3">
                <label class=""> Store URL</label>
                <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="Store URL (for example, https://yourstore.com) ">
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Connect</button>
          </div>
        </div>
      </div>
    </div>
    <!-- 1- email -->
    <div class="modal in" id="email_model" tabindex="-1" role="dialog" aria-labelledby="add_table_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="modalTitle">Email setup and settings <br>
              <!-- <small class="font_small" >Vaux will pull sales orders from WooCommerce and push inventory levels to WooCommerce in real time.</small> -->
            </h4>

          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-md-12 col-12 mb-3">
                <label class=""> Your Mail</label>
                <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="Your Mail">
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Connect</button>
          </div>
        </div>
      </div>
    </div>
    <!-- 1- SMS  -->
    <div class="modal in" id="sms_model" tabindex="-1" role="dialog" aria-labelledby="add_table_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="modalTitle">SMS setup and settings
              <!-- <br>  
                  <small class="font_small" >Vaux will pull sales orders from WooCommerce and push inventory levels to WooCommerce in real time.</small> -->
            </h4>

          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-md-12 col-12 mb-3">
                <label class=""> Your Number </label>
                <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder=" Your Number ">
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Connect</button>
          </div>
        </div>
      </div>
    </div>
    <!-- ___________________________ product setting Setting Models______________________  -->

    <!-- 1- Modifiers -->
    <div class="modal fade" id="add_modifiers_model" tabindex="-1" role="dialog" aria-labelledby="add_modifiers_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="modalTitle">Add Modifier</h4>
          </div>
          <div class="modal-body">
            <div class="form">
              <div class="my-3">
                <div class="input-icons">
                  <label class="">Modifier Set:*</label>
                  <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder=" Name">
                </div>
              </div>
              <div class="my-3">
                <div class="input-icons">
                  <div class="multi-field-wrapper">
                    <div class="row justify-content-between px-3 my-1">
                      <label class="">Modifiers</label>
                      <button type="button" class="btn btn-primary add_select_btn add-field">
                        <i class="fa fa-plus-circle"></i>
                      </button>
                    </div>
                    <div class="multi-fields">
                      <div class="multi-field d-flex mb-3">
                        <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="Modifiers">

                        <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="Price">
                        <button type="button" class="btn btn-danger remove-field remove_btn">
                          <i class="fa fa-minus-circle"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="new_chq"></div>
                <input type="hidden" value="1" id="total_chq">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">
              Save changes
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- 2- Tables -->
    <div class="modal fade" id="add_table_model" tabindex="-1" role="dialog" aria-labelledby="add_table_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="modalTitle">Add table</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 col-12 mb-3">
                <label class="">Business Location :</label>
                <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-117-4wsj" tabindex="-1" aria-hidden="true">
                  <option data-select2-id="select2-data-119-wnm2">All</option>
                  <option>None</option>
                  <option>Vaux restaurant (BL0001)</option>
                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-118-0bfq" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-kr1a-container" aria-controls="select2-kr1a-container"><span class="select2-selection__rendered" id="select2-kr1a-container" role="textbox" aria-readonly="true" title="All">All</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
              </div>
              <div class="col-md-12 col-12 mb-3">
                <label class=""> Table name:*</label>
                <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="Table name ">
              </div>
              <div class="col-md-12 col-12 mb-3">
                <label class=""> Short Description: </label>
                <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="Short Description:">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- 3- categoris -->
    <div class="modal fade" id="add_categories_model" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Add Category</h4>
          </div>
          <!-- model id like project_id, user_id -->
          <input class="form-control" name="notable_id" type="hidden" value="36">
          <!-- model name like App\User -->
          <input class="form-control" name="notable_type" type="hidden" value="App\Contact">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading">Category name:*</label>
                  <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category name:*">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading">Category Code:</label>
                  <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Category Code:">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading">Description:</label>
                  <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50" id="description"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- 4- Variations -->
    <div class="modal fade" id="add_variations_model" tabindex="-1" role="dialog" aria-labelledby="add_variations_model" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="modalTitle">Add Variation</h4>
          </div>
          <div class="modal-body">
            <div class="form">
              <div class="my-3">
                <div class="input-icons">
                  <label class="">Variation Name:*</label>
                  <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="Variation Name:*">
                </div>
              </div>
              <div class="my-3">
                <div class="input-icons">
                  <div class="width_90 multi-field-wrapper">
                    <div class="row justify-content-between px-3 my-1">
                      <label class="">Add variation values:*</label>
                      <button type="button" class="btn btn-primary add_select_btn add-field">
                        <i class="fa fa-plus-circle"></i>
                      </button>
                    </div>
                    <div class="multi-fields">
                      <div class="multi-field d-flex mb-3">
                        <input type="text" class="form-control form-control-rounded" id="regular-form-2" placeholder="Variation Name:*">
                        <button type="button" class="btn btn-danger remove-field remove_btn">
                          <i class="fa fa-minus-circle"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="new_chq"></div>
                <input type="hidden" value="1" id="total_chq">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- 5-  Variations -->
    <div class="modal fade" id="add_warranties_model" tabindex="-1" role="dialog" aria-labelledby="add_warranties_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Add Warranty</h4>
          </div>
          <!-- model id like project_id, user_id -->
          <input class="form-control" name="notable_id" type="hidden" value="36">
          <!-- model name like App\User -->
          <input class="form-control" name="notable_type" type="hidden" value="App\Contact">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading">Name:</label>
                  <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder=" Name:">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading">Description:</label>
                  <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50" id="description"></textarea>
                </div>
              </div>
            </div>
            <p for="heading">Duration:*</p>
            <div class="row">
              <div class="col-md-7">
                <input class="form-control pull-left" placeholder="Duration" required="" name="duration" type="number" id="duration">
              </div>
              <div class="col-md-5">
                <select class="form-control pull-left" required="" name="duration_type">
                  <option selected="selected" value="">Please Select</option>
                  <option value="days">Days</option>
                  <option value="months">Months</option>
                  <option value="years">Years</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- 6- Units -->
    <div class="modal fade bd-example-modal-lg" id="add_units_model" tabindex="-1" role="dialog" aria-labelledby="add_units_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Add Unit</h4>
          </div>
          <!-- model id like project_id, user_id -->
          <input class="form-control" name="notable_id" type="hidden" value="36">
          <!-- model name like App\User -->
          <input class="form-control" name="notable_type" type="hidden" value="App\Contact">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading">Name:</label>
                  <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Name">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading">Short Name:</label>
                  <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Short Name:">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading">Allow decimal:*</label>
                  <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-120-0eh7" tabindex="-1" aria-hidden="true">
                    <option data-select2-id="select2-data-122-kdp7">Please Select</option>
                    <option>yes</option>
                    <option>no</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-121-b49f" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-qcr2-container" aria-controls="select2-qcr2-container"><span class="select2-selection__rendered" id="select2-qcr2-container" role="textbox" aria-readonly="true" title="Please Select">Please Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
              </div>
            </div>
            <div class="form-check my-3">
              <div class="row">
                <div class="col-md-6 col-12">
                  <label class="customcheck">
                    Manage Stock?
                    <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip" data-original-title="Enable or disable stock management for a product.Stock Management should be disable mostly for services. Example: Hair-Cutting, Repairing, etc."></span></a>
                    <input id="checkbox1" class="checkbox1" type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="col-12">
                  <div id="autoUpdate" class="autoUpdate" style="display: none">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th style="vertical-align: middle">
                            1 <span id="unit_name">Pieces</span>
                          </th>
                          <th style="vertical-align: middle">=</th>
                          <td style="vertical-align: middle">
                            <input class="form-control input_number" placeholder="times base unit" name="base_unit_multiplier" type="text" style="margin-top: 10px">
                          </td>
                          <td style="vertical-align: middle">
                            <select class="mySelect form-control select2-hidden-accessible" name="base_unit_id" data-select2-id="select2-data-123-kq41" tabindex="-1" aria-hidden="true">
                              <option selected="selected" value="" data-select2-id="select2-data-125-yw6m">
                                Select base unit
                              </option>
                              <option value="8">Pieces (Pc(s))</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-124-98my" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-base_unit_id-3n-container" aria-controls="select2-base_unit_id-3n-container"><span class="select2-selection__rendered" id="select2-base_unit_id-3n-container" role="textbox" aria-readonly="true" title="
                                Select base unit
                              ">
                                Select base unit
                              </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="4" style="padding-top: 0">
                            <p class="help-block">
                              *Editing this value will change the purchase
                              &amp; sales stocks accordingly
                            </p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- 7- Units -->
    <div class="modal fade" id="add_brand_model" tabindex="-1" role="dialog" aria-labelledby="add_brand_model" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Add Brand</h4>
          </div>
          <!-- model id like project_id, user_id -->
          <input class="form-control" name="notable_id" type="hidden" value="36">
          <!-- model name like App\User -->
          <input class="form-control" name="notable_type" type="hidden" value="App\Contact">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading">Brand name:*</label>
                  <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Brand name:*">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading">Short description:</label>
                  <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Short description::">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- 8- Selling Price Group model  -->
    <div class="modal fade" id="selling_price_group_model" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Add Selling Price Group</h4>
          </div>
          <!-- model id like project_id, user_id -->
          <input class="form-control" name="notable_id" type="hidden" value="36">
          <!-- model name like App\User -->
          <input class="form-control" name="notable_type" type="hidden" value="App\Contact">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="heading">Name:</label>
                  <input class="form-control" required="" name="heading" type="text" id="heading" aria-required="true" placeholder="Name">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="description">Description:</label><br>
                  <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50" id="description" spellcheck="false"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>


    <!-- ___________________________ company detail tab Model ______________________  -->

     <!-- 1- company details model -->
     <div class="modal in" id="edit_company_details_model" tabindex="-1" role="dialog" aria-labelledby="add_table_model" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
         <div class="modal-header dir_rtl">
           <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
           <h6 class="modal-title" id="modalTitle">Company details<br> 
           </h6>

         </div>
         <div class="modal-body">
          <form>
            <div class="form-group row justify-content-between">
              <label for="staticEmail" class="col-sm-3 col-form-label">Company name :*
              </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value=" ">
              </div>
            </div>
            <div class="form-group row justify-content-between">
              <label for="staticEmail" class="col-sm-3 col-form-label">Address :*
              </label>
              <div class="col-sm-9 ">
                <input type="text" class="form-control" value=" ">
              </div>
            </div>
            <div class="form-group row justify-content-between">
              <label for="staticEmail" class="col-sm-3 col-form-label">Country :*
              </label>
              <div class="col-sm-9 ">
                <select class="mySelect select3 form-control select2-hidden-accessible" data-select2-id="select2-data-126-1tad" tabindex="-1" aria-hidden="true">
                  <option value="" data-select2-id="select2-data-128-hgl3">Please Select</option>
                  <option value="Afganistan">Afghanistan</option>
                 
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-127-6bxh" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-lk2i-container" aria-controls="select2-lk2i-container"><span class="select2-selection__rendered" id="select2-lk2i-container" role="textbox" aria-readonly="true" title="Please Select">Please Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
              </div>
            </div>
            <div class="form-group row justify-content-between">
              <label for="staticEmail" class="col-sm-3 col-form-label">City :*
              </label>
              <div class="col-sm-9 ">
                <input type="text" class="form-control" value=" ">
              </div>
            </div>
            <div class="form-group row justify-content-between">
              <label for="staticEmail" class="col-sm-3 col-form-label">state 
              </label>
              <div class="col-sm-9 ">
                <input type="text" class="form-control" value=" ">
              </div>
            </div>
            <div class="form-group row justify-content-between">
              <label for="staticEmail" class="col-sm-3 col-form-label">Zip/postal code 
              </label>
              <div class="col-sm-9 ">
                <input type="text" class="form-control" value=" ">
              </div>
            </div>
            <div class="form-group row justify-content-between">
              <label for="staticEmail" class="col-sm-3 col-form-label">Phone number 
              </label>
              <div class="col-sm-9 ">
                <input type="text" class="form-control" value=" ">
              </div>
            </div>
            <div class="form-group row justify-content-between">
              <label for="staticEmail" class="col-sm-3 col-form-label">Email
              </label>
              <div class="col-sm-9 ">
                <input type="text" class="form-control" value=" ">
              </div>
            </div>
            <div class="form-group row justify-content-between">
              <label for="staticEmail" class="col-sm-3 col-form-label">Description
              </label>
              <div class="col-sm-9 ">
                <textarea class="form-control" rows="3" name="note" cols="50" id="note" spellcheck="false"></textarea>
              </div>
            </div>

          </form>
         
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">
             Close
           </button>
           <button type="button" class="btn btn-primary">Save</button>
         </div>
       </div>
     </div>
   </div>

    <!--End-Contents-->
  </div>   

