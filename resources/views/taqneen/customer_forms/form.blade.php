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
        @php
            $users = App\User::where('user_type','user')->where('business_id', session('business.id'))
            ->get()
            ->pluck('user_full_name', 'user_full_name')
            ->toArray();
 
 
        @endphp
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

@section("script")

<script>
    var resource = <?php echo json_encode($resource) ?>;
    $(".related").each(function(){
        var self = this;
        var related = $(self).attr('data-related');
        $("." + related).val(self.value);

        $(this).change(function(){
            $("." + related).val(self.value);
        });
        $(this).keyup(function(){
            $("." + related).val(self.value);
        });
    });

    Date.prototype.addDays = function(days) {
        var date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
    }


    function setOtherUserTemplate(count) {
        var container = document.getElementById('muqeem_edit_other');

        container.innerHTML = "";
        for(var index = 1; index <= count; index ++) {
            var usernameField = "other_users_name_" + index;
            var identityField = "other_users_identity_" + index;
            var hiddenField = "other_users_checkbox_remove_" + index;
            var username = resource[usernameField]? resource[usernameField] : '';
            var identity = resource[identityField]? resource[identityField] : '';
            var template = ` 
                <div class="col-md-6 ">
                    <label class="gfield_label pb-1" for="">
                        اسم المستخدم - ${index} 
                        <span class="gfield_required">
                            <span class="gfield_required gfield_required_custom">*</span>
                        </span>
                    </label>
                    <input type="text" name="form[${usernameField}]" value="${username}" class="form-control" required  >
                </div> 
                <div class="col-md-6 ">
                    <label class="gfield_label pb-1" for="">
                        رقم الهوية / الإقامة - ${index} 
                        <span class="gfield_required">
                            <span class="gfield_required gfield_required_custom">*</span>
                        </span>
                    </label>
                    <input type="text" name="form[${identityField}]" value="${identity}" class="form-control" maxlength="10" required  >
                </div>
                <input type="hidden" name="form[${hiddenField}]" value="1" >
            `;

            container.innerHTML += template;
        }
    }

    setOtherUserTemplate({{ $resource->other_user_count?? 0 }});
    //muqeem_edit_other

    @if ($resource->id)
    $('.courier_name').val(resource['courier_name']);
    $('.user_triger_email').val(resource['user_triger_email']);
    @endif
</script>
@endsection
 
