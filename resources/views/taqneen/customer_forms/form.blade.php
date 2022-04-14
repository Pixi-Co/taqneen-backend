@extends("taqneen.layouts.master")

@section("content")
<div class="w3-block card">
    <br>
    <style>
        * {
            font-family: 'Tajawal', sans-serif;
            direction: rtl;
        }
    
        .gfield_checkbox{
            display: grid;
            -ms-grid-columns: (1fr) [ 3 ];
            grid-template-columns: repeat(5,1fr);
            grid-column-gap: 32px;
        }
        
        input[type='text'],input[type="text"]:focus{
            border-color: #ebebeb;
            background-color: #f8f8f8;
            color: #969696;
        }
        input[type="text"]:focus{
            box-shadow: 0px 0px 2px 0px rgb(0 0 0 / 20%);
        }
        
        label {
            font-weight: bold;
            font-size: 0.92em;
        }
        .gform_wrapper.gravity-theme .ginput_container_date {
            display: flex;
            align-items: center;
            align-content: flex-start;
        }
        html[dir=rtl] .gform_wrapper.gravity-theme .ginput_container_date img.ui-datepicker-trigger {
            margin-right: 12.8px
        px
        ;
            margin-left: 0;
            order: 1;
        }
        
        input[type=submit] {
            color: #FFFFFF;
            background: #d45b24;
            font-size: 19px;
            letter-spacing: 1px;
            text-transform: uppercase;
            float: right;
            height: 50px;
            border: none;
            border-radius: 5px;
            margin-left: 12px;
            transition: 0.3s;
            }
        input[type=submit]:hover{
            background: #134474;
            color: #FFFFFF
        }
        
        .subscribe-model{
            background: #fff;
        }

        checkbox, input[type=checkbox] {
            width: 24px;
            height: 24px;
            position: relative;
            top: 6px;
        }
        </style>
    <div class="container" id="form" >
        <form action="{{ url('/customer-form') }}" method="post">
            <input type="hidden" name="key" value="{{ $key }}"> 
            <input type="hidden" name="id" value="{{ $resource->id }}"> 
            <input type="hidden" name="form[token]" value="{{ rand(1111111111, 9999999999) }}"> 
            @csrf
    
            @include("taqneen.customer_forms.forms." . $key)
            <br>
            <input type="submit" class=" btn gform_button button" value="أشترك الأن">
            <br>
        </form>
    </div>
    <br>
    <br>
    
</div>
@endsection
