
           
            "lengthMenu": [ [10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "All"] ], 
            dom: 'RlBfrtip',  
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'colvis'
            ],
            "autoWidth": false,
            @if(isRtl())
            "oLanguage": {
                "sUrl": "/js/ar.json"
            }, 
            @endif
