
 
<script>
    
    $(document).ready(function(){ 
        if (contact_table) {
            contact_table.ajax.url('/sub/member');
            contact_table.ajax.reload();
        }
        @if(request()->action == 'create')
            $('.add_btn').click(); 
        @endif
    });
</script> 
