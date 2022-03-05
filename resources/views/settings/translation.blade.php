@extends('layouts.app')
@section('title', 'translation page')

@section('content')
    <div class="app" id="app">


        <!-- Main content -->
        <section class="full-content setting_page">


            <section class="sale_report">

                <ul class="nav nav-pills mb-3 setting-tabs" id="pills-tab" role="tablist">
                    <li class="nav-item" id="englishTabLink" onclick="loadTranslation('en')">
                        <a class="nav-link" id="englishTab" data-toggle="pill" href="#tab_1" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            English
                        </a>
                    </li>
                    <li class="nav-item" onclick="loadTranslation('ar')">
                        <a class="nav-link" id="arabicTab" data-toggle="pill" href="#tab_1" role="tab"
                            aria-controls="pills-home" aria-selected="false">
                            Arabic
                        </a>
                    </li>

                </ul>

                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade w3-padding" id="tab_1" role="tabpanel" aria-labelledby="pills-home-tab">

                        <button class="add_btn" onclick="update()" >
                            <i class="fa fa-plus"></i> 
                            Save
                        </button>
                        <br>

                        <div class="table-responsive w3-light-gray">
                            <table data-title="translation" id="transTable" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>key</th>
                                        <th>word</th>
                                        <th>filename</th>
                                    </tr>
                                </thead>
                                <tbody  id="transContent"> 

                                </tbody>
                            </table> 
                        </div>
                        
                    </div>

                </div>

            </section>
        </section>
    </div>

@stop
@section('javascript') 
    <script>
        var app = {};
        var words = {};
        var lang = 'en';
        var transTable = {};

        function drawTable(res) {
            var container = document.getElementById('transContent');
            var html = "";

            for(var i = 0; i < Object.keys(res).length; i ++) {
                var key = Object.keys(res)[i];
                var item = res[key];

                if (Object.prototype.toString.call(item.value) === "[object String]") {  
                    html += 
                    "<tr>"+
                        "<td style='width: 5%' >"+ (i + 1) +"</td>" +
                        "<td style='width: 20%'>"+ key +"</td>" +
                        "<td style='width: 75%' ><textarea data-key='"+key+"' style='min-width: 200px;padding: 3px!important' onkeyup='listenToEdits(this)' data-filename='"+item.filename+"' cols='3' rows='4' class='w3-input w3-round w3-block' >"+ item.value +"</textarea></td>" +
                        "<td style='width: 20%'>"+ item.filename +"</td>" +
                    "</tr>";
                }
            }

            container.innerHTML = html; 
        }

        function listenToEdits(input) {
            var key = $(input).attr('data-key');
            var filename = $(input).attr('data-filename');
            var value = input.value;

            words[key] = {
                filename: filename,
                value: value
            };
        }

        function update() {
            var data = {
                _token: '{{ csrf_token() }}',
                words: JSON.stringify(words),
                lang: lang
            };
            $.post('{{ url('/trans/update') }}', data, function(r){
                if (r.success == true) {
                    toastr.success('done');
                } else {
                    toastr.error('error');
                }
            });
        }
        

        function loadTranslation(lang) {
            $('#tab_1').hide();
            try {
                transTable.destroy();
            }catch(e){}

            $.get('{{ url('/trans/get') }}?lang=' + lang, function(r) {

                //app.words = r;
                drawTable(r);
                setTimeout(function(){
                    setDatatable();
                }, 100);

                // show 
                $('#tab_1').show();
            });
        }

        function setDatatable() {
            transTable = $('#transTable').DataTable({ 
                pageLength: 25,
                @include("layouts.partials.datatable_plugin")
            });
            editDatatable();
        }

        $(document).ready(function(){ 
            setDatatable();
 
            $('#englishTabLink a').click();
        });

    </script>

@endsection
