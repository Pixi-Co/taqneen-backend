$(document).ready(function () {
  var wind = $(window);

  wow = new WOW({
    boxClass: "wow",
    animateClass: "animated",
    offset: 200,
    mobile: false,
    live: false,
  });
  wow.init();





       /* ----------------------------------------------------------------
                form toggle
-----------------------------------------------------------------*/


$("#cases").on("change", function() {
  $('.payment_edit_form').hide();
  $("#" + $(this).val()).show();
}).change();


$("#cases2").on("change", function() {
  $('.payment_edit_form2').hide();
  $("#" + $(this).val()).show();
}).change();


  // nav tabs next previous

  $(".next").click(function () {
    $(".nav-pills  .active").parent().next("li").find("a").trigger("click");
  });

  $(".previous").click(function () {
    $(".nav-pills  .active").parent().prev("li").find("a").trigger("click");
  });

  // ----------- sidemenu button ---------
  $("#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4").click(function () {
    $(this).toggleClass("open");
    $(".sidemenu-links").slideToggle();
  });

  // ----------- top navbar  edit button ---------
  $(".top-nav .exp_btn").on("click", function () {
    $(this).siblings(".exp_content").toggleClass("show");
  });

  // ----------- users page edit button ---------
  $(".user-content .exp_btn").on("click", function () {
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
    dom: 'Bfrtip',
    buttons: [{
      extend: 'colvis',
      text: "toggle columns"
    }],
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

  /////////// edit search button datatable
  oTable = $("#userTable1").DataTable(); //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
  $("#myInputTextField").keyup(function () {
    oTable.search($(this).val()).draw();
  });

  /// edit downloadt buttons datatable
  oTable = $("#userTable1").DataTable(); //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
  $("#myInputTextField").keyup(function () {
    oTable.search($(this).val()).draw();
  });

  // ----------- product_table edit button ---------
  $(".product_table .exp_btn").on("click", function () {
    $(this).siblings(".exp_content").toggleClass("show");
  });

  // ----------- dark_light button ---------
  $(".dark_light #dark_light_btn").on("click", function () {
    $("body").toggleClass("dark");
  });
  //  ----------- change icon of dark mode ------
  $("#dark_light_btn").click(function () {
    $("i", this).toggleClass(" fas fa-moon far fa-lightbulb ");
  });

  // ----------- dark_light button ---------
  $("#dark-light-btn1").on("click", function () {
    $("body").toggleClass("dark");
  });

  // ----------- Change font size  ---------
  $(".font_size .font_plus").click(function (e) {
    e.stopPropagation();
    var fontSize = parseInt($("*").css("font-size"));
    fontSize = fontSize + 1 + "px";
    $("*").css({
      "font-size": fontSize,
    });
  });

  $(".font_size .font_min").click(function (e) {
    e.stopPropagation();
    var fontSize = parseInt($("*").css("font-size"));
    fontSize = fontSize - 1 + "px";
    $("*").css({
      "font-size": fontSize,
    });
  });

  /* ----------------------------------------------------------------
              Display input when checked
-----------------------------------------------------------------*/

  $("#checkbox1").click(function () {
    if ($(this).is(":checked")) {
      $("#autoUpdate").fadeIn("slow");
    } else {
      $("#autoUpdate").fadeOut("slow");
    }
  });
  /* ----------------------------------------------------------------
              File Upload
-----------------------------------------------------------------*/

  $("#upload-file").change(function () {
    var filename = $(this).val();
    $("#file-upload-name").html(filename);
    if (filename != "") {
      setTimeout(function () {
        $(".upload-wrapper").addClass("uploaded");
      }, 600);
      setTimeout(function () {
        $(".upload-wrapper").removeClass("uploaded");
        $(".upload-wrapper").addClass("success");
      }, 1600);
    }
  });




 /* ----------------------------------------------------------------
              user page change view
-----------------------------------------------------------------*/
$('#changeView').on('click',function(){
  if($('.users_grid_view').css('display')!='none'){
    $('.users_table_view').fadeIn('slow');
    $('.users_grid_view').fadeOut('slow');
  }else if($('.users_table_view').css('display')!='none'){
      $('.users_grid_view').fadeIn('slow');;
      $('.users_table_view').fadeOut('slow');
  }
});



  /* ----------------------------------------------------------------
            multi select plugin
-----------------------------------------------------------------*/

  /* ----------------------------------------------------------------
                [ sidemenu dropdown ]
-----------------------------------------------------------------*/
  var linkGroup = $(".linkGroup"),
    linkGroupHead = $(".linkGroup .linkItem-head");

  linkGroupHead.on("click", function () {
    $(this).next(".linkItem-body").slideToggle();
  });

  linkGroup.on("click", function (e) {
    e.stopPropagation();
    $(this).addClass("active").siblings().removeClass("active");
    $(this).siblings().find(".linkItem-body").slideUp();
  });

  // $('html').on('click', function() {
  //     linkGroup.removeClass("active");
  //     linkGroup.find('.linkItem-body').slideUp()
  // });

  /* ----------------------------------------------------------------
                [ sidemenu active ]
-----------------------------------------------------------------*/

  $(".sidemenu-links li").on("click", function () {
    $(this).addClass("active").siblings().removeClass("active");
  });

  /* ----------------------------------------------------------------
                [ toggelmenu ]
-----------------------------------------------------------------*/
  $(".toggelmenu").on("click", function () {
    $(this).toggleClass("arrow");
    $(".sidemenu").toggleClass("smallmenu");
    $(".top-nav").toggleClass("tallnav");
    $("main").toggleClass("fullwidth");
  });

  /* ----------------------------------------------------------------
                [ back-top ]
-----------------------------------------------------------------*/

  $(".back_top").on("click", function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      1000
    );
  });

  /* ----------------------------------------------------------------
                [ counter ]
-----------------------------------------------------------------*/

  $(".counter").countUp({
    delay: 10,
    time: 250
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

  $(".r_side_menu_btn").on("click", function (e) {
    e.stopPropagation();
    $(".r_side_menu").addClass("show");
  });

  $("main,.menu-close,.sidemenu").on("click", function () {
    $(".r_side_menu").removeClass("show");
  });

  /* ----------------------------------------------------------------
                [ tool_tip ]
-----------------------------------------------------------------*/
  $('[data-toggle="tooltip"]').tooltip({
    placement: "right",
  });




  /* ----------------------------------------------------------------
              Delete Alert
-----------------------------------------------------------------*/
$(".m-user-delete").on("click", function () {
  swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this imaginary file!",
    icon: "warning",
    // imageUrl: "../images/icons/delete.svg",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      swal("Poof! Your imaginary file has been deleted!", {
        icon: "success",
      });
    } else {
      swal("Your imaginary file is safe!");
    }
  });
});

 


  /**** JQuery *******/
  /* ----------------------------------------------------------------
                [ fullscreen toggle ]
-----------------------------------------------------------------*/

  function toggleFullscreen(elem) {
    elem = elem || document.documentElement;
    if (
      !document.fullscreenElement &&
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

  document.getElementById("expand").addEventListener("click", function () {
    toggleFullscreen();
  });

  document.getElementById("expand").addEventListener("click", function () {
    toggleFullscreen(this);
  });

  /* View last six months  */
  $("body").on("click", ".sixmonth", function () {
    var min_date = new Date("Oct 24 2019").getTime();
    var max_date = new Date("Mar 24 2020").getTime();
    chart.zoomX(min_date, max_date);

    // not sure how to implement this function:
    /*chart.zoomX({
              min: min_date,
              max: max_date,
        });*/
  });

  var groupDataArray1 = [
    {
      groupName: "User",
      groupData: [
        {
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
      groupData: [
        {
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
      groupData: [
        {
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
      groupData: [
        {
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
      groupData: [
        {
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
      groupData: [
        {
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
      groupData: [
        {
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
      groupData: [
        {
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
      groupData: [
        {
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
      groupData: [
        {
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
      groupData: [
        {
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
      groupData: [
        {
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
      groupData: [
        {
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
    callable: function (items) {
      console.dir(items);
    },
  };

  $("#transfer3").transfer(settings3);
});


