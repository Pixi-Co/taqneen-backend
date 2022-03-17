<script>
    toastr.success = function(text='@trans('done')'){
        // play sound
        //document.getElementById('success-audio').play();

        iziToast.success({
            title: text,
            position: 'topRight',
            //message: 'Successfully inserted record!',
        });
    };

    toastr.error = function(text='@trans('error')'){
        // play sound
        ///document.getElementById('error-audio').play();

        iziToast.error({
            title: text,
            position: 'topRight',
            //message: 'Successfully inserted record!',
        });
    };

    toastr.warning = function(text='@trans('warning')'){
        // play sound
        //document.getElementById('warning-audio').play();

        iziToast.warning({
            title: text,
            position: 'topRight',
            //message: 'Successfully inserted record!',
        });
    };
</script>
