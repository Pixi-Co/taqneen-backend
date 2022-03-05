<div style="min-width: 200px" >

    @if (isset($phone))
        <a target="_blank" href="https://api.whatsapp.com/send/?phone={{ $phone }}&app_absent=0"
            style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
            class="btn w3-white w3-text-green material-shadow">
            <i style="margin-top: 4px;" class="fab fa-whatsapp"></i>
        </a>
    @endif
    @if (isset($phone))
        <a target="_blank" href="tel:{{ $phone }}"
            style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
            class="btn w3-white w3-text-indigo material-shadow">
            <i style="margin-top: 4px;" class="fas fa fa-phone"></i>
        </a>
    @endif
    @if (isset($email))
        <a target="_blank" href="mailto:{{ $email }}"
            style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
            class="btn w3-white w3-text-purple material-shadow">
            <i style="margin-top: 4px;" class="fas fa fa-envelope"></i>
        </a>
    @endif

</div>
