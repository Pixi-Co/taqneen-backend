<div  >
    <div class="dropdown">
        <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            @trans('share') <i class="fa fa-bell"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="">
            @if (isset($phone))
            <a class="dropdown-item" target="_blank" href="https://api.whatsapp.com/send/?phone=966{{ $phone }}&app_absent=0">
                @trans('whatsapp') <i class="fa fa-brands fa-whatsapp"></i>
            </a>
            @endif
            @if (isset($phone))
            <a class="dropdown-item"target="_blank" href="tel:{{ $phone }}">
                @trans('call') <i class="fas fa fa-phone"></i>
            </a>
            @endif
            @if (isset($email))
            <a class="dropdown-item" target="_blank" href="mailto:{{ $email }}">
                @trans('email') <i class="fas fa fa-envelope"></i>
            </a>
            @endif
        </div>
    </div>

    <!--

    @if (isset($phone))
        <a target="_blank" href="https://api.whatsapp.com/send/?phone=966{{ substr($phone, 1) }}&app_absent=0"
            style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
            class="btn w3-white w3-text-green material-shadow">
            <i style="margin-top: 4px;" class="fa fa-brands fa-whatsapp"></i>
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

    ->

</div>

<script>
    $('.dropdown-toggle').dropdown()
</script>
