@extends('layouts.app')
@section('title', __('edit permission of ') . $resource->name)

@section('css')
    <style>
        .category-col {
            padding: 5px;
        }

        .category-ul {
            height: 400px;
            overflow: auto;
        }

        .category-title {
            border-bottom: 1px solid lightgray;
        }

    </style>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('edit permission of ') . $resource->name }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content w3-padding">
        <div class="w3-padding">
            <div class="row">

                {!! Form::open(['url' => action('BussinessTypeController@updatePackagePermission', [$resource->id]), 'method' => 'POST', 'id' => 'edit_permission_form', 'class' => 'form']) !!}

                @foreach (App\BusinessType::permissionCategorys() as $category)

                    <div class="col-sm-3 category-col">
                        <div class="w3-white w3-round material-shadow category-content">
                            <div class="text-center w3-large category-title w3-padding w3-display-container">
                                <label class="category-label w3-left" style="margin-left: 22px">
                                    {!! Form::checkbox('category[]', 0, false, ['class' => 'category-input toggler category-checkbox', 'data-toggle_id' => 'category-' . $category]) !!} 
                                </label>
                                <b class="w3-display-topmiddle w3-padding">{{ __($category) }}</b>
                                <br>
                            </div>
                            <ul class="w3-ul category-ul">

                                @foreach (App\BusinessType::permissions()->where('category', $category)->get() as $p)
                                    <li>
                                        <div>
                                            <label class="checkbox checkbox-{{ $category }} category-{{ $category }}">
                                                @php
                                                    $attrs = ['class' => 'toggler', 'data-toggle_id' => 'p_div' . $p->id];
                                                    $resource->getPermissions()->where('permission_id', $p->id)->exists()? $attrs[] = "checked" : '';
                                                    $value = $resource->getPermissions()->where('permission_id', $p->id)->exists()? 1 : 0;
                                                @endphp
                                                {!! Form::checkbox('permission_' . $p->id, $value, false, $attrs) !!}
                                                {{ $p->title }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                @endforeach

                <div class="col-sm-3 category-col">
                    <div class="w3-white w3-round material-shadow category-content">
                        <div class="text-center w3-large category-title w3-padding w3-display-container">
                            <label class="category-label w3-left" style="margin-left: 22px">
                                {!! Form::checkbox('category[]', 0, false, ['class' => 'category-input toggler category-chart_account', 'data-toggle_id' => 'category-chart_account']) !!} 
                            </label>
                            <b class="w3-display-topmiddle w3-padding">{{ __("chart of acocunt") }}</b>
                            <br>
                        </div>
                        <ul class="w3-ul category-ul">

                            @foreach (DB::table('chart_account')->get() as $item)
                                <li>
                                    <div>
                                        <input type="hidden"  value="{{ $item->id }}"> 
                                        @php
                                            $attrs = ['class' => 'toggler', 'data-toggle_id' => 'p_div' . $item->id];
                                            $resource->chartAccounts()->where('chart_account_id', $item->id)->exists()? $attrs[] = "checked" : '';
                                        @endphp
                                        <label class="checkbox checkbox- category-chart_account">
                                            {!! Form::checkbox('chart_account_' . $item->id, 1, false, $attrs) !!}
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-sm-12 text-center"> 
                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary">@trans( 'messages.update' )</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
@section('javascript')

    @include("layouts.js.icheck")
    <script type="text/javascript">
        $(document).ready(function() {
            formAjax(true);

            $('.category-input').on('ifClicked', function(){
                //alert($(this).data('toggle_id'));
                $('.' + $(this).data('toggle_id')).click();
            });
        });
    </script>

@endsection
