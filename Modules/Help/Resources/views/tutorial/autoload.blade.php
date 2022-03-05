
<div class="tutorial-container">

</div>


<script>
    var canShowTutorial = true;

    function gotoTutorial(id) {
        $('.tutorial-modal').slideUp();
        $('.tutorial-modal-' + step).slideDown(300);
    }

    function loadTourJs(data) {
        // remove active class
        $('.sidebar-menu li').removeClass('active');
        setTimeout(function(){
            introJs().setOptions({
                steps: [ 
                {
                  element: document.querySelector(data.selector),
                  
                }]
              }).start();
        }, 100);
    }

    function preLoader(html) {
        try {
        var div = document.createElement('div');
        div.innerHTML = html;

        var selector = $(div).find('.tutorial-modal').data('selector');
        var id = $(div).find('.tutorial-modal').data('id');
        var page = $(div).find('.tutorial-modal').data('page');
        var link = window.location.href
            .replace(window.location.origin, '')
            .replace('#', '')
            .replace('/', '');

        if (selector) {
            
            var page = $(div).find('.tutorial-modal').data('page');
            var prePage = page.replace('#', '')
                        .replace('/', '');

            if (prePage == link) {
                var data = {
                    selector: selector
                };
                loadTourJs(data);
            } else {
                canShowTutorial = false;
                window.location.href = page;
            }
        } else {
            if (page) {
                var page = $(div).find('.tutorial-modal').data('page');
                var prePage = page.replace('#', '')
                            .replace('/', '');
                            
                if (prePage == link) {
                    // 
                } else {
                    canShowTutorial = false;
                    window.location.href = page;
                }
            }
        }
        }catch(e){}
    }

    function loadTutorial(id) {
        if (id.length <= 0)
            return;

        $('.tutorial-modal').remove();
        $('.tutorial-container .modal').slideUp(300);
        $.get('{{ url("/tutorial/load") }}/' + id, function (res) {
            preLoader(res);
            if (canShowTutorial) { 
                $('.tutorial-container').html(res); 
                setTimeout(function(){
                    setDontShowAgainListner();
                    setCurrentTutorial(id);
                $('.tutorial-modal .modal-fullscreen, .tutorial-modal .modal-fullscreen .modal-content').css('height', window.innerHeight + "px");
                }, 3000); 
            }
        });
    }

    function closeTutorial() {
        $('.tutorial-modal').slideUp(300);
        $('.tutorial-container').html('');
        $('.tutorial-container *').remove();
    }

    function setDontShowAgainListner() {
        $('.dont_show_again').on('ifChecked', function(){
            completeTutorial($(this).data('id'), 1);
        });
        $('.dont_show_again').on('ifUnchecked', function(){
            completeTutorial($(this).data('id'), 0);
        });
    }

    function setCurrentTutorial(id) {
        data = {
            _token: '{{ csrf_token() }}' 
        };
        $.post('{{ url("tutorial/set-current/") }}/' + id, $.param(data), function(r){
            //
        });
    }

    function endTutorial() {
        closeTutorial();
        data = {
            _token: '{{ csrf_token() }}' 
        };
        $.post('{{ url("tutorial/end") }}', $.param(data), function(r){
            //
        });
    }

    function completeTutorial(id, is_done) {
        data = {
            _token: '{{ csrf_token() }}', 
            is_done: is_done
        };
        $.post('{{ url("tutorial/complete/") }}/' + id, $.param(data), function(r){
            //
        });
    }
    //loadSettingWithoutPreview('http://127.0.0.1:8000/business-location', function(){ setTimeout(function(){$('#business_location_table_wrapper .edit-button').first().click();}, 2000); })

    // load first tutorial
   
    @if (Tutorial::getActive()->orderBy('step')->first())
    @php 
        $t = Tutorial::find(Tutorial::getCurrentTutorial());

        $id = $t->id;
    @endphp
    // current step is {{ Tutorial::getCurrentTutorial() }}
    loadTutorial('{{ $id }}');
    @endif
</script>
