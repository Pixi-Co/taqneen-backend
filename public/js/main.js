$(document).ready(function() {
    var wind = $(window);
    var toggleFlag = false;

    wow = new WOW({
        boxClass: "wow",
        animateClass: "animated",
        offset: 200,
        mobile: false,
        live: false,
    });
    wow.init();

    /* ----------------------------------------------------------------
              Display input when checked
-----------------------------------------------------------------*/

    $(".checkbox1").click(function() {
        if ($(this).is(":checked")) {
            $(".autoUpdate").fadeIn("slow");
        } else {
            $(".autoUpdate").fadeOut("slow");
        }
    });

    /* ----------------------------------------------------------------
            check all 
-----------------------------------------------------------------*/
    $('#select-all').click(function() {
        var checked = this.checked;
        $('.select_all_inner_checks input[type="checkbox"]').each(function() {
            this.checked = checked;
        });
    })

    $("#product_type_cases3")
        .on("change", function() {
            $(".product_table_type3").hide();
            $("#" + $(this).val()).show();
        })
        .change();

    $("#togglebutton").click(function() {
        toggleFlag = !toggleFlag;

        $(".sidemenu").toggleClass("width8");
        $(".main").toggleClass("widthAll");
        $(".menu_text").toggleClass("d-none");
        $(".sidemenu .logo ").toggleClass("d-none");
        $(".sidemenu-links ").toggleClass("mt-5");
        $(".sidemenu-links .linkItem-body").css("padding", "5px");
        $(".sidemenu-links .linkItem-body li::before").css(
            "margin",
            "0 !important"
        );
        $(".sidemenu-links li .linkItem-body a").css("font-size", "10px ");
        $(".sidemenu").toggleClass("pl-2");
        $(".sidemenu-links .side_link").css({ padding: "16px ", width: "102%" });

        $(".linkGroup .linkItem-head").mouseenter(function() {
            if (toggleFlag) {
                $(".linkItem-body").hide();

                let menu = $(this).next(".linkItem-body");

                var pos = $(this).offset();

                var width = $(this).outerWidth();

                var scroll = $(window).scrollTop();

                $(window).scroll(function() {
                    $(".linkItem-body").hide();
                });

                $(menu).css({
                    "background-color": "#41bc85",
                    position: "fixed",
                    top: pos.top - scroll - 12 + "px",
                    left: pos.left + width + "px",
                    width: "150px",
                });

                menu.fadeIn(250);

                $(this)
                    .parent()
                    .mouseleave(function() {
                        $(menu).fadeOut(250);
                    });
            } else {
                $(".linkGroup .linkItem-head").mouseenter(function() {
                    $(".linkItem-body").css({
                        "background-color": "#0001",
                        position: "relative",
                        top: 0,
                        left: 0,
                        width: "90%",
                        display: "none",
                    });
                });
            }
        });
    });


    //  dark image
    $(".register_dark_btn").click(function() {
        $(".login_page").toggleClass("login_page2");
    });

    // nav tabs next previous

    $(".next").click(function() {
        $(".nav-pills  .active").parent().next("li").find("a").trigger("click");
    });

    $(".previous").click(function() {
        $(".nav-pills  .active").parent().prev("li").find("a").trigger("click");
    });

    /* ----------------------------------------------------------------
                [ tool_tip ]
-----------------------------------------------------------------*/
    $('[data-toggle="tooltip"]').tooltip({
        placement: "right",
    });
    $('[data-toggle="tooltip2"]').tooltip({
        placement: "bottom",
    });

    /* ----------------------------------------------------------------
               operation page model
-----------------------------------------------------------------*/

    $(".view_payment_operation").click(function() {
        $(".view_operation_content").fadeToggle();
    });

    $(".edit_payment_operation").click(function() {
        $(".edit_operation_content").fadeToggle();
    });
    $(".operation_send_payment").click(function() {
        $(".send_operation_content").fadeToggle();
    });
    /* ----------------------------------------------------------------
              user page change view
-----------------------------------------------------------------*/
    $("#changeView").on("click", function() {
        if ($(".users_grid_view").css("display") != "none") {
            $(".users_table_view").fadeIn("slow");
            $(".users_grid_view").fadeOut("slow");
        } else if ($(".users_table_view").css("display") != "none") {
            $(".users_grid_view").fadeIn("slow");
            $(".users_table_view").fadeOut("slow");
        }
    });



    var first = true;
    $(".checkbox2").change(function() {
        var $target = $("#sb" + this.id.replace("chk", "")).toggle(this.checked);
        if (first) {
            $("div[id^=sb]").not($target).hide();
            first = false;
        }
    });


    /* ----------------------------------------------------------------
              Display Export model data when checked
-----------------------------------------------------------------*/
    $('.exportChecks input[type="radio"]').click(function() {
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });

    // radio button
    $("#test2").click(function() {
        $(".radioCheck").fadeIn("slow");
    });
    $("#test1").click(function() {
        $(".radioCheck").fadeOut();
    });



    //  order counter

    $(".add_order").on("click", function() {
        var $qty = $(this).closest("p").find(".qty");
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
        }
    });
    $(".minus_order").on("click", function() {
        var $qty = $(this).closest("p").find(".qty");
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal) && currentVal > 0) {
            $qty.val(currentVal - 1);
        }
    });

    $(".checkModel").on("change", function(e) {
        if (e.target.checked) {
            $("#checkModel").modal();
        }
    });

    // add new form row
    $(".add_production_step").click(function() {
        $(".diabled_panel").fadeIn("slow");
    });
    $(".remove_ingredient_group").click(function() {
        $(".diabled_panel").fadeOut();
    });

    /* ----------------------------------------------------------------
                form toggle
-----------------------------------------------------------------*/

    $("#cases")
        .on("change", function() {
            $(".payment_edit_form").hide();
            $("#" + $(this).val()).show();
        })
        .change();

    $("#cases2")
        .on("change", function() {
            $(".payment_edit_form2").hide();
            $("#" + $(this).val()).show();
        })
        .change();

    $("#cases3")
        .on("change", function() {
            $(".payment_edit_form").hide();
            $("#" + $(this).val()).show();
        })
        .change();

    // add product page
    $("#cases3")
        .on("change", function() {
            $(".product_edit_form").hide();
            $("#" + $(this).val()).show();
        })
        .change();

    $("#cases4")
        .on("change", function() {
            $(".product_table_form").hide();
            $("#" + $(this).val()).show();
        })
        .change();

    $("#product_type_cases1")
        .on("change", function() {
            $(".product_table_type").hide();
            $("#" + $(this).val()).show();
        })
        .change();

    $("#product_type_cases2")
        .on("change", function() {
            $(".product_table_type2").hide();
            $("#" + $(this).val()).show();
        })
        .change();

    $("#cases5")
        .on("change", function() {
            $(".date_edit_form").hide();
            $("#" + $(this).val()).show();
        })
        .change();

    // add active class to inner navbar

    // var url = window.location;
    //         $('.inner_header .navbar a[href="'+ url +'"]').parent().addClass('active');
    //         $('.inner_header .navbar a').filter(function() {
    //              return this.href == url;
    //  }).parent().addClass('active');

    $(".inner_header .navbar a")
        .filter(function() {
            return this.href == location.href;
        })
        .parent()
        .addClass("active")
        .siblings()
        .removeClass("active");
    $(".inner_header .navbar a").click(function() {
        $(this).parent().addClass("active").siblings().removeClass("active");
    });

    // add new form row

    // ----------- sidemenu button ---------
    $("#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4").click(function() {
        $(this).toggleClass("open");
        $(".sidemenu-links").slideToggle();
    });

    // ----------- top navbar  edit button ---------
    $(".top-nav .exp_btn").on("click", function() {
        $(this).siblings(".exp_content").toggleClass("show");
    });

    // ----------- users page edit button ---------
    $(".user-content .exp_btn").on("click", function() {
        $(this).siblings(".exp_content").toggleClass("show");
    });

    $("#product_table1").DataTable({
        paging: false,
        bInfo: false,
        bFilter: false,
    });
    $("#product2").DataTable({
        paging: false,
        bInfo: false,
        bFilter: false,
    });
    $("#userTable1").DataTable({
        dom: "Bfrtip",
        buttons: [{
            extend: "colvis",
            text: "toggle columns",
        }, ],
        bInfo: false,
        bPaginate: false,
        bLengthChange: false,
        bFilter: false,
        searching: true,
        language: {
            paginate: {
                next: "&#8594;", // or '→'
                previous: "&#8592;", // or '←'
            },
        },
    });

    $(".check_table").DataTable({
        bInfo: false,
        bPaginate: false,
        bLengthChange: false,
        bFilter: false,
        searching: true,
        columnDefs: [{
            orderable: false,
            className: "select-checkbox",
            targets: 0,
        }, ],
        select: {
            style: "os",
            selector: "td:first-child",
        },
        order: [
            [1, "asc"]
        ],
    });

    var check_table = $(".check_table").DataTable();
    $(".selectAll").on("click", function(e) {
        if ($(this).is(":checked")) {
            check_table.rows().select();
        } else {
            check_table.rows().deselect();
        }
    });

    /////////// edit search button datatable
    oTable = $("#userTable1").DataTable(); //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
    $("#myInputTextField").keyup(function() {
        oTable.search($(this).val()).draw();
    });

    /// edit downloadt buttons datatable
    oTable = $("#userTable1").DataTable(); //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
    $("#myInputTextField").keyup(function() {
        oTable.search($(this).val()).draw();
    });

    // ----------- product_table edit button ---------
    $(".product_table .exp_btn").on("click", function() {
        $(this).siblings(".exp_content").toggleClass("show");
    });

    // ----------- dark_light button ---------
    $(".dark_light #dark_light_btn").on("click", function() {
        $("body").toggleClass("dark");
    });
    //  ----------- change icon of dark mode ------
    $("#dark_light_btn").click(function() {
        $("i", this).toggleClass(" fas fa-moon far fa-lightbulb ");
    });

    // ----------- dark_light button ---------
    $("#dark-light-btn1").on("click", function() {
        $("body").toggleClass("dark");
    });


    /* ----------------------------------------------------------------
              File Upload
-----------------------------------------------------------------*/

    $("#upload-file").change(function() {
        var filename = $(this).val();
        $("#file-upload-name").html(filename);
        if (filename != "") {
            setTimeout(function() {
                $(".upload-wrapper").addClass("uploaded");
            }, 600);
            setTimeout(function() {
                $(".upload-wrapper").removeClass("uploaded");
                $(".upload-wrapper").addClass("success");
            }, 1600);
        }
    });

    // add new input group

    // $(function () {

    //   var start = moment().subtract(29, 'days');
    //   var end = moment();

    //   function cb(start, end) {
    //       $('.reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    //   }

    //   $('.reportrange').daterangepicker({
    //       startDate: start,
    //       endDate: end,
    //       ranges: {
    //           'Today': [moment(), moment()],
    //           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    //           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //           'This Month': [moment().startOf('month'), moment().endOf('month')],
    //           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //       }
    //   }, cb);

    //   cb(start, end);

    //   });

    /* ----------------------------------------------------------------
                [slide effect to  dropdown ]
-----------------------------------------------------------------*/
    $(".dropdown").on("show.bs.dropdown", function() {
        $(this).find(".dropdown-menu").first().stop(true, true).slideDown();
    });

    // Add slideUp animation to Bootstrap dropdown when collapsing.
    $(".dropdown").on("hide.bs.dropdown", function() {
        $(this).find(".dropdown-menu").first().stop(true, true).slideUp();
    });

    /* ----------------------------------------------------------------
                [ sidemenu dropdown ]
-----------------------------------------------------------------*/
    var linkGroup = $(".linkGroup"),
        linkGroupHead = $(".linkGroup .linkItem-head");

    linkGroupHead.on("click", function() {
        $(this).next(".linkItem-body").slideToggle();
    });

    linkGroup.on("click", function(e) {
        e.stopPropagation();
        $(this).addClass("active").siblings().removeClass("active");
        $(this).siblings().find(".linkItem-body").slideUp();
    });

    /* ----------------------------------------------------------------
                [ sidemenu active ]
-----------------------------------------------------------------*/

    $(".sidemenu-links li").on("click", function() {
        $(this).addClass("active").siblings().removeClass("active");
    });

    var slideMenu = $(".sidemenu");

    // Toggle Sidebar
    $(document).on("click", '[data-toggle="sidebar"]', function(event) {
        event.preventDefault();
        $(".app").toggleClass("sidenav-toggled");
    });

    /* ----------------------------------------------------------------
                [ toggelmenu ]
-----------------------------------------------------------------*/
    $(".toggelmenu").on("click", function() {
        $(this).toggleClass("arrow");
        $(".sidemenu").toggleClass("smallmenu");
        $(".top-nav").toggleClass("tallnav");
        $("main").toggleClass("fullwidth");
    });

    /* ----------------------------------------------------------------
                [ back-top ]
-----------------------------------------------------------------*/

    $(".back_top").on("click", function() {
        $("html, body").animate({
                scrollTop: 0,
            },
            1000
        );
    });

    /* ----------------------------------------------------------------
               change view from table to chart
-----------------------------------------------------------------*/

    //
    /* ----------------------------------------------------------------
                [ counter ]
-----------------------------------------------------------------*/

    $(".counter").countUp({
        delay: 10,
        time: 250,
    });

    if ($(".notes")[0]) {
        $(".notes").slick({});
    }

    if ($(".profile_slider1")[0]) {
        $(".profile_slider1").slick({});
    }

    if ($(".profile_slider2")[0]) {
        $(".profile_slider2").slick({});
    }
    /* ----------------------------------------------------------------
                [ r_side_menu ]
-----------------------------------------------------------------*/

    $(".r_side_menu_btn").on("click", function(e) {
        e.stopPropagation();
        $(".r_side_menu").addClass("show");
    });

    $("main,.menu-close,.sidemenu").on("click", function() {
        $(".r_side_menu").removeClass("show");
    });

    /* ----------------------------------------------------------------
              Delete Alert
-----------------------------------------------------------------*/
    $(".m-user-delete").on("click", function() {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            // imageUrl: "../images/icons/delete.svg",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    });

    /* ----------------------------------------------------------------
              Delete Alert
-----------------------------------------------------------------*/
    $(".m-update-button").on("click", function() {
        swal({
            title: "No Row Selected",
            icon: "error",
            // imageUrl: "../images/icons/delete.svg",

            dangerMode: false,
        });
    });

    // multi field

    $(".multi-field-wrapper").each(function() {
        var $wrapper = $(".multi-fields", this);
        $(".add-field", $(this)).click(function(e) {
            $(".multi-field:first-child", $wrapper)
                .clone(true)
                .appendTo($wrapper)
                .find("input")
                .val("")
                .focus();
        });
        $(".multi-field .remove-field", $wrapper).click(function() {
            if ($(".multi-field", $wrapper).length > 1)
                $(this).parent(".multi-field").remove();
        });
    });

    // hold onto the drop down menu
    var dropdownMenu;

    // and when you show it, move it to the body
    $(window).on("show.bs.dropdown", function(e) {
        if ($(e.target).hasClass("custom_table_dropDown")) {
            // grab the menu
            dropdownMenu = $(e.target).find(".dropdown-menu");

            // detach it and append it to the body
            $("body").append(dropdownMenu.detach());

            // grab the new offset position
            var eOffset = $(e.target).offset();

            // make sure to place it where it would normally go (this could be improved)
            dropdownMenu.css({
                display: "block",
                top: eOffset.top + $(e.target).outerHeight(),
                left: eOffset.left,
            });
        }
    });

    // and when you hide it, reattach the drop down, and hide it normally
    $(window).on("hide.bs.dropdown", function(e) {
        if ($(e.target).hasClass("custom_table_dropDown")) {
            $(e.target).append(dropdownMenu.detach());
            dropdownMenu.hide();
        }
    });

    /**** JQuery *******/
    /* ----------------------------------------------------------------
                [ fullscreen toggle ]
-----------------------------------------------------------------*/

    function toggleFullscreen(elem) {
        elem = elem || document.documentElement;
        if (!document.fullscreenElement &&
            !document.mozFullScreenElement &&
            !document.webkitFullscreenElement &&
            !document.msFullscreenElement
        ) {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            } else if (elem.mozRequestFullScreen) {
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }
    }

    document.getElementById("expand").addEventListener("click", function() {
        toggleFullscreen();
    });

    document.getElementById("expand").addEventListener("click", function() {
        toggleFullscreen(this);
    });

    /* View last six months  */
    $("body").on("click", ".sixmonth", function() {
        var min_date = new Date("Oct 24 2019").getTime();
        var max_date = new Date("Mar 24 2020").getTime();
        chart.zoomX(min_date, max_date);

        // not sure how to implement this function:
        /*chart.zoomX({
                  min: min_date,
                  max: max_date,
            });*/
    });

    // table dropdown

    var groupDataArray1 = [{
            groupName: "User",
            groupData: [{
                    city: "View user",
                    value: 122,
                },
                {
                    city: "Add user",
                    value: 643,
                },
                {
                    city: " Edit user",
                    value: 422,
                },
                {
                    city: "Delete user",
                    value: 622,
                },
            ],
        },
        {
            groupName: "Roles",
            groupData: [{
                    city: "View role",
                    value: 132,
                },
                {
                    city: "Add Role",
                    value: 112,
                },
                {
                    city: "Edit Role",
                    value: 191,
                },
                {
                    city: "Delete user",
                    value: 623,
                },
            ],
        },
        {
            groupName: "Supplier",
            groupData: [{
                    city: " View all supplier",
                    value: 132,
                },
                {
                    city: "View own supplier",
                    value: 112,
                },
                {
                    city: "Add supplier",
                    value: 191,
                },
                {
                    city: "Edit supplier",
                    value: 623,
                },
                {
                    city: "Delete supplier",
                    value: 623,
                },
            ],
        },
        {
            groupName: "Customer",
            groupData: [{
                    city: "  View all customer",
                    value: 132,
                },
                {
                    city: "View own customer",
                    value: 112,
                },
                {
                    city: "Add customer",
                    value: 191,
                },
                {
                    city: "Edit customer",
                    value: 623,
                },
                {
                    city: "Delete customer",
                    value: 623,
                },
            ],
        },
        {
            groupName: "Product",
            groupData: [{
                    city: "  View product",
                    value: 132,
                },
                {
                    city: "Add product",
                    value: 112,
                },
                {
                    city: " Edit product",
                    value: 191,
                },
                {
                    city: " Delete product",
                    value: 623,
                },
                {
                    city: "Add Opening Stock",
                    value: 623,
                },
                {
                    city: " View Purchase Price ",
                    value: 623,
                },
            ],
        },
        {
            groupName: "Purchase & Stock Adjustment",
            groupData: [{
                    city: " View purchase & Stock Adjustment",
                    value: 132,
                },
                {
                    city: " Add purchase & Stock Adjustment",
                    value: 112,
                },
                {
                    city: " Edit purchase & Stock Adjustment",
                    value: 191,
                },
                {
                    city: "Delete purchase & Stock Adjustment",
                    value: 623,
                },
                {
                    city: " Add/Edit/Delete Payments ",
                    value: 623,
                },
                {
                    city: "  Update Status ",
                    value: 623,
                },
                {
                    city: "  View own purchase only ",
                    value: 623,
                },
            ],
        },
        {
            groupName: "Sell",
            groupData: [{
                    city: "  View POS sell",
                    value: 132,
                },
                {
                    city: " Add POS sell",
                    value: 112,
                },
                {
                    city: "  Edit POS sell",
                    value: 191,
                },
                {
                    city: " Delete POS sell",
                    value: 623,
                },
                {
                    city: " Access sell ",
                    value: 623,
                },
                {
                    city: "  List Drafts",
                    value: 623,
                },
                {
                    city: "  List quotations ",
                    value: 623,
                },
                {
                    city: "   View own sell only",
                    value: 191,
                },
                {
                    city: " Add/Edit/Delete Payments ",
                    value: 623,
                },
                {
                    city: " Edit product price from sales screen",
                    value: 623,
                },
                {
                    city: "  Edit product price from POS screen",
                    value: 623,
                },
                {
                    city: "  Edit product discount from Sale screen ",
                    value: 623,
                },
                {
                    city: " Edit product discount from POS screen",
                    value: 191,
                },
                {
                    city: "  Add/Edit/Delete Discount",
                    value: 623,
                },
                {
                    city: " Access Shipments",
                    value: 623,
                },
                {
                    city: "  Access sell return",
                    value: 623,
                },
            ],
        },
        {
            groupName: "Cash Register  ",
            groupData: [{
                    city: "  View cash register",
                    value: 132,
                },
                {
                    city: " Close cash register",
                    value: 112,
                },
            ],
        },
        {
            groupName: "Brand  ",
            groupData: [{
                    city: "  View brand",
                    value: 132,
                },
                {
                    city: "  Add brand",
                    value: 112,
                },
                {
                    city: "Edit brand",
                    value: 191,
                },
                {
                    city: "Delete brand",
                    value: 623,
                },
            ],
        },
        {
            groupName: "Tax rate  ",
            groupData: [{
                    city: "  View tax rate",
                    value: 132,
                },
                {
                    city: "  Add tax rate",
                    value: 112,
                },
                {
                    city: "Edit tax rate",
                    value: 191,
                },
                {
                    city: "Delete tax rate",
                    value: 623,
                },
            ],
        },
        {
            groupName: "Unit  ",
            groupData: [{
                    city: "  View Unit",
                    value: 132,
                },
                {
                    city: "  Add Unit",
                    value: 112,
                },
                {
                    city: "Edit Unit",
                    value: 191,
                },
                {
                    city: "Delete Unit",
                    value: 623,
                },
            ],
        },
        {
            groupName: "Category  ",
            groupData: [{
                    city: "  View Category",
                    value: 132,
                },
                {
                    city: "  Add Category",
                    value: 112,
                },
                {
                    city: "Edit Category",
                    value: 191,
                },
                {
                    city: "Delete Category",
                    value: 623,
                },
            ],
        },
        {
            groupName: "Report  ",
            groupData: [{
                    city: "   View purchase & sell report",
                    value: 132,
                },
                {
                    city: "   View Tax report",
                    value: 112,
                },
                {
                    city: " View Supplier & Customer report",
                    value: 191,
                },
                {
                    city: " View expense report",
                    value: 623,
                },
                {
                    city: "  View profit/loss report",
                    value: 132,
                },
                {
                    city: "   View stock report, stock adjustment report & stock expiry report",
                    value: 112,
                },
                {
                    city: "View trending product report",
                    value: 191,
                },
                {
                    city: "View register report",
                    value: 623,
                },
                {
                    city: "   View sales representative report",
                    value: 132,
                },
                {
                    city: "   View product stock value",
                    value: 112,
                },
            ],
        },
    ];

    var settings3 = {
        groupDataArray: groupDataArray1,
        groupItemName: "groupName",
        groupArrayName: "groupData",
        itemName: "city",
        valueName: "value",
        callable: function(items) {
            console.dir(items);
        },
    };

    $("#transfer3").transfer(settings3);

    $(".div-toggle").trigger("change");
});

$(document).on("change", ".div-toggle", function() {
    var target = $(this).data("target");
    var show = $("option:selected", this).data("show");
    $(target).children().addClass("hide");
    $(show).removeClass("hide");
});

// calculator
("use strict");

var input = document.getElementById("input"), // input/output button
    number = document.querySelectorAll(".numbers div"), // number buttons
    operator = document.querySelectorAll(".operators div"), // operator buttons
    result = document.getElementById("result"), // equal button
    clear = document.getElementById("clear"), // clear button
    resultDisplayed = false; // flag to keep an eye on what output is displayed

// adding click handlers to number buttons
for (var i = 0; i < number.length; i++) {
    number[i].addEventListener("click", function(e) {
        // storing current input string and its last character in variables - used later
        var currentString = input.innerHTML;
        var lastChar = currentString[currentString.length - 1];

        // if result is not diplayed, just keep adding
        if (resultDisplayed === false) {
            input.innerHTML += e.target.innerHTML;
        } else if (
            (resultDisplayed === true && lastChar === "+") ||
            lastChar === "-" ||
            lastChar === "×" ||
            lastChar === "÷"
        ) {
            // if result is currently displayed and user pressed an operator
            // we need to keep on adding to the string for next operation
            resultDisplayed = false;
            input.innerHTML += e.target.innerHTML;
        } else {
            // if result is currently displayed and user pressed a number
            // we need clear the input string and add the new input to start the new opration
            resultDisplayed = false;
            input.innerHTML = "";
            input.innerHTML += e.target.innerHTML;
        }
    });
}

// adding click handlers to number buttons
for (var i = 0; i < operator.length; i++) {
    operator[i].addEventListener("click", function(e) {
        // storing current input string and its last character in variables - used later
        var currentString = input.innerHTML;
        var lastChar = currentString[currentString.length - 1];

        // if last character entered is an operator, replace it with the currently pressed one
        if (
            lastChar === "+" ||
            lastChar === "-" ||
            lastChar === "×" ||
            lastChar === "÷"
        ) {
            var newString =
                currentString.substring(0, currentString.length - 1) +
                e.target.innerHTML;
            input.innerHTML = newString;
        } else if (currentString.length == 0) {
            // if first key pressed is an opearator, don't do anything
            console.log("enter a number first");
        } else {
            // else just add the operator pressed to the input
            input.innerHTML += e.target.innerHTML;
        }
    });
}

// on click of 'equal' button
result.addEventListener("click", function() {
    // this is the string that we will be processing eg. -10+26+33-56*34/23
    var inputString = input.innerHTML;

    // forming an array of numbers. eg for above string it will be: numbers = ["10", "26", "33", "56", "34", "23"]
    var numbers = inputString.split(/\+|\-|\×|\÷/g);

    // forming an array of operators. for above string it will be: operators = ["+", "+", "-", "*", "/"]
    // first we replace all the numbers and dot with empty string and then split
    var operators = inputString.replace(/[0-9]|\./g, "").split("");

    console.log(inputString);
    console.log(operators);
    console.log(numbers);
    console.log("----------------------------");

    // now we are looping through the array and doing one operation at a time.
    // first divide, then multiply, then subtraction and then addition
    // as we move we are alterning the original numbers and operators array
    // the final element remaining in the array will be the output

    var divide = operators.indexOf("÷");
    while (divide != -1) {
        numbers.splice(divide, 2, numbers[divide] / numbers[divide + 1]);
        operators.splice(divide, 1);
        divide = operators.indexOf("÷");
    }

    var multiply = operators.indexOf("×");
    while (multiply != -1) {
        numbers.splice(multiply, 2, numbers[multiply] * numbers[multiply + 1]);
        operators.splice(multiply, 1);
        multiply = operators.indexOf("×");
    }

    var subtract = operators.indexOf("-");
    while (subtract != -1) {
        numbers.splice(subtract, 2, numbers[subtract] - numbers[subtract + 1]);
        operators.splice(subtract, 1);
        subtract = operators.indexOf("-");
    }

    var add = operators.indexOf("+");
    while (add != -1) {
        // using parseFloat is necessary, otherwise it will result in string concatenation :)
        numbers.splice(
            add,
            2,
            parseFloat(numbers[add]) + parseFloat(numbers[add + 1])
        );
        operators.splice(add, 1);
        add = operators.indexOf("+");
    }

    input.innerHTML = numbers[0]; // displaying the output

    resultDisplayed = true; // turning flag if result is displayed
});

// clearing the input on press of clear
clear.addEventListener("click", function() {
    input.innerHTML = "";
});