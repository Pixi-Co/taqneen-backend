<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rate Trainer</title>
    <link rel="stylesheet" href="{{ asset('css/vendor.css?v='.$asset_v) }}">
    <link rel="stylesheet" href="{{ asset('css/app.css?v='.$asset_v) }}">
    <style>
        * { box-sizing: border-box; }

        html, body { 
          background-image: url("https://www.toptal.com/designers/subtlepatterns/patterns/concrete-texture.png");
        }

        .btn {
          box-shadow: 0 1px 1px rgb(0 0 0 / 12%);
          background-color: #41bc85!important;
          display: inline-block;
          padding: 6px 12px;
          margin-bottom: 0;
          font-size: 14px;
          font-weight: 400;
          line-height: 1.42857143;
          text-align: center;
          white-space: nowrap;
          vertical-align: middle;
          -ms-touch-action: manipulation;
          touch-action: manipulation;
          cursor: pointer;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
          background-image: none;
          border: 1px solid transparent;
          border-radius: 4px;
          color: white;
        }

.container {
  display: flex;
  flex-wrap: wrap;
  margin-top: 100px;
  height: auto;
  align-items: center;
  justify-content: center;
  padding: 0 20px;
}

.rating {
  display: flex;
  width: 100%;
  justify-content: center;
  overflow: hidden;
  flex-direction: row-reverse;
  height: 150px;
  position: relative;
}

.rating-0 {
  filter: grayscale(100%);
}

.rating > input {
  display: none;
}

.rating > label {
  cursor: pointer;
  width: 40px;
  height: 40px;
  margin-top: auto;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: center;
  background-size: 76%;
  transition: .3s;
}

.rating > input:checked ~ label,
.rating > input:checked ~ label ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}


.rating > input:not(:checked) ~ label:hover,
.rating > input:not(:checked) ~ label:hover ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}

.emoji-wrapper {
  width: 100%;
  text-align: center;
  height: 100px;
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 0;
}

.emoji-wrapper:before,
.emoji-wrapper:after{
  content: "";
  height: 15px;
  width: 100%;
  position: absolute;
  left: 0;
  z-index: 1;
}

.emoji-wrapper:before {
  top: 0;
  background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(255,255,255,1) 35%,rgba(255,255,255,0) 100%);
}

.emoji-wrapper:after{
  bottom: 0;
  background: linear-gradient(to top, rgba(255,255,255,1) 0%,rgba(255,255,255,1) 35%,rgba(255,255,255,0) 100%);
}

.emoji {
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: .3s;
}

.emoji > svg {
  margin: 15px 0; 
  width: 70px;
  height: 70px;
  flex-shrink: 0;
}

#rating-1:checked ~ .emoji-wrapper > .emoji { transform: translateY(-100px); }
#rating-2:checked ~ .emoji-wrapper > .emoji { transform: translateY(-200px); }
#rating-3:checked ~ .emoji-wrapper > .emoji { transform: translateY(-300px); }
#rating-4:checked ~ .emoji-wrapper > .emoji { transform: translateY(-400px); }
#rating-5:checked ~ .emoji-wrapper > .emoji { transform: translateY(-500px); }

.feedback {
  max-width: 700px;
  background-color: #fff;
  width: 100%;
  padding: 20px;
  border-radius: 8px; 
  flex-direction: column;
  flex-wrap: wrap;
  align-items: center;
  box-shadow: 0 4px 30px rgba(0,0,0,.05);
}

.fa {
    font-size: 20px;
}

    </style>
</head>
<body> 
  <a href="{{ url('/') }}" style="margin: 30px">
    <img src="{{ url('/images/logo2.png') }}" width="100px" alt="">
  </a>

    <div class="container">

        <div class="feedback"> 
           

          <div class="row">

            @foreach(Modules\Subscription\Entities\Rate::active()->where('active', '1')->get() as $item)
            <div class="col-md-4 w3-padding">
                <h3 for="">
                    {{ $item->name }}
                </h3>
                <h5>
                    @if ($item->description)
                    {{ $item->description }}
                    @else
                    ---
                    @endif
                </h5>
                <div id="rate{{ $item->id }}" class="w3-large" ></div>
                <br>
                <input type="text" class="form-control" 
                value="{{ optional($item->getUserRate())->comment }}"
                onkeyup="addRate('{{ $item->id }}', null, this.value)" style="border-radius: 7px" placeholder="@trans('Tell Me Why If You Want ?')" >
          
            </div>
            @endforeach


          </div>
 
          <br>
          <button class="btn rate-btn" >@trans("submit")</button>
        </div>
      </div>
 
      <![endif]-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="{{ url('/js/rate.js') }}"></script>
        
      <script src="{{ asset('js/vendor.js?v=' . $asset_v) }}"></script> 
      
      @if(file_exists(public_path('js/lang/' . session()->get('user.language', config('app.locale')) . '.js')))
      <script src="{{ asset('js/lang/' . session()->get('user.language', config('app.locale')) . '.js?v=' . $asset_v) }}">
      </script>
      @else
      <script src="{{ asset('js/lang/en.js?v=' . $asset_v) }}"></script>
      @endif

      <script>
        var rates = {}; 

        function addRate(id, rate, comment) {
            if (!rates[id])
                rates[id] = {rate: null, comment: ''};

            if (rate)
                rates[id].rate = rate;
            if (comment)
                rates[id].comment = comment;
        }

        
        @foreach(Modules\Subscription\Entities\Rate::active()->where('active', '1')->get() as $item)
        var rate{{ $item->id }} = new Ratebar(document.getElementById('rate{{ $item->id }}'));
        @if (optional($item->getUserRate())->rate)
            rate{{ $item->id }}.rate({{ optional($item->getUserRate())->rate }});
            addRate('{{ $item->id }}', {{ optional($item->getUserRate())->rate }}, '{{ optional($item->getUserRate())->comment }}');
        @endif

        rate{{ $item->id }}.onrate(function(){
            addRate('{{ $item->id }}', rate{{ $item->id }}.value, null); 
        });
        @endforeach

        $('.rate-btn').click(function(){
          var btn = this;
          var rate = $("#rateValue").val();
          if (rate <= 0)
            return toastr.error('@trans("please rate trainer")');
          
          var html = this.innerHTML;
          $(this).attr('disabled', 'disabled');

          var data = {
            rates: JSON.stringify(rates),
            _token: '{{ csrf_token() }}' 
          };
          $.post("{{ url('/multi-rate') }}?", $.param(data), function(r){
            if (r.status == 1) {
              toastr.success(r.message);
            }
            else  
              toastr.error(r.message);
            
            btn.innerHTML = html;
            $(btn).removeAttr('disabled');
          });
        });


        
      </script>
</body>
</html>

