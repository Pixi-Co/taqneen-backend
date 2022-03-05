@extends("layouts.app")

@section('css')
    <style>
    </style>
@endsection

@section('content')
    <div class="container">

        <form action="{{ url('/sub/rate-trainer') }}/{{ $trainer->id }}" class="form" id="form" >
            @csrf
            <br>
            <div class="w3-center w3-round-xlarge w3-white sb-shadow w3-padding w3-animate-top" style="width: 300px;margin: auto">
                <img src="{{ url('/images/sub/trainer.png') }}" width="100px" alt="">
                <h3>{{ $trainer->full_name }}</h3>
                <br>
                <div class="text-center w3-center w3-display-container">

                    <div class="rate2 w3-xxlarge" id="rate2"></div>
                    <input type="hidden" name="rate" id="rate"  >
                    <br>
                    <br>
                    <button type="button" onclick="rateTrainer()" class="btn w3-green">@trans("submit")</button>
                </div>
            </div>
        </form>


    </div>
@endsection

@section('javascript')
    <script src="{{ url('/js/rate.js') }}"></script>

    <script>
        formAjax();

        function rateTrainer() {
            if ($('#rate').val() <= 0)
                return toastr.error('@trans("please rate trainer")');

            $('#form').submit();
        }


        var r = new Ratebar(document.getElementById('rate2'));

        r.setOnRate(function(){
            $('#rate').val(r.value);
        });
        @if ($rate)
            r.rate({{ $rate->rate }});
        @endif
    </script>
@endsection
