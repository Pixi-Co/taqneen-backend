<script src="https://cdn.ckeditor.com/4.16.2/full-all/ckeditor.js"></script>

<!--
<script src="<?php echo SB_URL ?>/vendor/ckeditor/ckeditor.js"></script>
-->

<div class="sb-lightbox sb-app-box ckeditor-lightbox" 
style="margin-top: -300.3px; margin-left: -350px;">
    <div class="sb-info"></div>
    <div class="sb-top-bar">
        <div>CkEditor</div> 
    </div>
    <div class="sb-main" style="padding: 0px!important" >
        <textarea name="ckeditor" data-ck-plugin="off" ></textarea> 
    </div>
    <div class="sb-main" > 
        <div class="sb-bottom">
            <button class="sb-btn sb-icon" onclick="Ckeditor.done()" >
                <i class="sb-icon-check"></i>
                Done
            </button>
        </div>
    </div>
</div>

<script>
    /*
     * ----------------------------------------------------------
     * # ckeditor
     * ----------------------------------------------------------
     */
    var Ckeditor = {

        current_element: null,


        init: function() {
            try {
                CKEDITOR.replace('ckeditor');
            } catch (e) {}
        },

        toggle: function() {
            $('.ckeditor-lightbox').toggleClass('sb-active');
        },

        show: function() {
            this.setValue(this.current_element.value);
            $('.ckeditor-lightbox').addClass('sb-active');
        },

        hide: function() { 
            $('.ckeditor-lightbox').removeClass('sb-active');
        },

        setValue :function(value){
            CKEDITOR.instances.ckeditor.setData(value);
        },

        getValue :function(){
            return CKEDITOR.instances.ckeditor.getData();
        },

        done :function(){
            var value = this.getValue();
            $(this.current_element).val(value);
            this.hide();
        },

        addToAllTextarea: function(){
            var self = this;
            $('textarea').each(function(element){
                if (this.getAttribute('data-ck-plugin') != 'off') {
                    $(this).parent().css('position', 'relative');
                    var el = this;
                    //
                    var img = document.createElement('img'); 
                    img.src = "<?php echo SB_URL ?>/media/word.png";
                    img.style = "position: absolute;top: 10px;right: 20px;cursor: pointer;width: 25px;border-radius: 5em;padding: 5px;background-color: white;box-shadow: rgb(0 0 0 / 56%) 0px 0px 1px 1px;";
                    img.onclick = function(){
                        self.current_element = el;
                        self.show();
                    };
                    $(this).parent().append(img);
                }
            });
        },


    };

    window.onload = function(){
        Ckeditor.init();
        Ckeditor.addToAllTextarea();
    };
</script>
