<script>
    $('#{{ $id }}').jstree({
        "core": {
            "animation": 0,
            "check_callback": true,
            'force_text': true,
            "themes": {
                "stripes": true
            },
            'data': {
                'url': '{{ url('/chart-accounts') }}?selected_id={{ $selectedId }}',
                /*'data': function(node) {
                    return {
                        'id': node.id
                    };
                }*/
            },
            "types": {
                "#": {
                    "max_children": 1,
                    "valid_children": ["root"]
                },
                "root": {
                    "icon": "fa  fa-folder-o",
                    "valid_children": ["default"]
                },
                "default": {
                    "valid_children": ["default", "file"],
                    "icon": "fa fa-folder w3-text-green"
                },
                "file": {
                    "icon": "fa fa-file-o",
                    "valid_children": []
                }
            },
            "plugins": ["search", "state", "types", "wholerow", 'dnd']
        },

    });

    function createTree(selector) {
        var ref = $(selector).jstree(true),
            sel = ref.get_selected();
        if (!sel.length) {
            return false;
        }
        sel = sel[0];
        sel = ref.create_node(sel, {
            "type": "default",
            "icon": "fa fa-folder w3-text-green",
        });
        if (sel) {
            ref.edit(sel);
        }
    };

    function renameTree(selector) {
        var ref = $(selector).jstree(true),
            sel = ref.get_selected();
        if (!sel.length) {
            return false;
        }
        sel = sel[0];
        ref.edit(sel);
    };

    function deleteTree(selector) { 
        swal({
            title: LANG.sure,
            text: LANG.confirm_delete_brand,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var ref = $(selector).jstree(true),
                    sel = ref.get_selected();
                if ($(selector).jstree(true).get_parent(sel) == '#')
                    return false;
                if (!sel.length) {
                    return false;
                }
                ref.delete_node(sel);
            }
        }); 
    };
    $('#{{ $id }}').on('rename_node.jstree', function(e, node) {
        var id = node['node']['id'];
        var text = node['text']
        $.ajax({
            type: 'post',
            url: "{{ url('/chart-accounts/update') }}",
            data: {
                id: id,
                text: text
            },
            success: function(data) {
                console.log(data);
                ///$('#{{ $id }}').jstree('refresh');
            },
            error: function(err) {
                console.log(err)
            }
        })
    });
    $('#{{ $id }}').on('delete_node.jstree', function(e, node, parent) {
        var id = node.node.id;
        var ch = $('#{{ $id }}').jstree(true).get_json(node.node, {
            flat: true,
            no_state: true,
            no_id: false,
            no_children: false,
            no_li_attr: true,
            no_a_attr: true,
            no_data: true
        })
        var ids = ch.map(function(node) {
            return node = node.id
        })

        $.ajax({
            type: 'post',
            url: "{{ url('/chart-accounts/destroy') }}",
            data: {
                ids: ids
            },
            success: function(data) {
                console.log(data);
                ///$('#{{ $id }}').jstree('refresh');
            },
            error: function(err) {
                console.log(err)
            }
        })
    });
    $('#{{ $id }}').on('create_node.jstree', function(e, data) {
        var t = $('#{{ $id }}').jstree(true).get_json(data.node, {
            flat: true,
            no_state: true,
            no_id: false,
            no_children: false,
            no_li_attr: true,
            no_a_attr: true,
            no_data: false
        })
        var item = t[0]
        $.ajax({
            type: 'post',
            url: "{{ url('/chart-accounts/store') }}",
            data: {
                item: item
            },
            success: function(data) {
                ///$('#{{ $id }}').jstree('refresh');
            },
            error: function(err) {
                console.log(err)
            }
        })
    });
    $('#{{ $id }}').on('select_node.jstree', function(e, data) {
        
        var id = data['node']['id'];
         $('.account_type_id').val(id);
    });

    //account_type_id
</script>
