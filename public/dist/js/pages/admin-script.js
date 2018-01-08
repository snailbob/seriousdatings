/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

  'use strict';

  $('.table-datatable').DataTable();
  $('#example1').DataTable();
  $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  });

  $(".form-control-number").keypress(function (e) {
      //if the letter is not digit then display error and don't type anything
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          return false;
      }
  });

  $('#event_form').validate({
    ignore: [],
    rules: {
    },
    messages: {
    },
    highlight: function (element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function (error, element) {
        // $(element).closest('.col*').append(error);
    },
    // submitHandler: function(form) { 
    //   var d = $(form).serialize();
    //   console.log(d, $(form).serializeArray());
    // }
    

  });

  // //Date picker
  // $('.datepicker').datepicker({
  //   autoclose: true
  // })


  // //Timepicker
  // $('.timepicker').timepicker({
  //   showInputs: false
  // })

  $(".input-geolocation").geocomplete({
    details: ".geo-details",
    detailsAttribute: "data-geo"
  }).bind("geocode:result", function(event, result){
    var $self = $(this);
    console.log($self, result, result.geometry.location.lat(), result.geometry.location.lng());
    $self.closest('form').append('<input type="hidden" name="lat" value="'+result.geometry.location.lat()+'">');
    $self.closest('form').append('<input type="hidden" name="lng" value="'+result.geometry.location.lng()+'">');
  });



  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.box-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  });
  $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999
  });

  // bootstrap WYSIHTML5 - text editor
  $('.textarea').wysihtml5();

  $('.daterange').daterangepicker({
    ranges   : {
      'Today'       : [moment(), moment()],
      'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month'  : [moment().startOf('month'), moment().endOf('month')],
      'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate  : moment()
  }, function (start, end) {
    window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  });

  /* jQueryKnob */
  $('.knob').knob();

  // jvectormap data
  var visitorsData = {
    US: 398, // USA
    SA: 400, // Saudi Arabia
    CA: 1000, // Canada
    DE: 500, // Germany
    FR: 760, // France
    CN: 300, // China
    AU: 700, // Australia
    BR: 600, // Brazil
    IN: 800, // India
    GB: 320, // Great Britain
    RU: 3000 // Russia
  };
  // World map by jvectormap
  $('#world-map').vectorMap({
    map              : 'world_mill_en',
    backgroundColor  : 'transparent',
    regionStyle      : {
      initial: {
        fill            : '#e4e4e4',
        'fill-opacity'  : 1,
        stroke          : 'none',
        'stroke-width'  : 0,
        'stroke-opacity': 1
      }
    },
    series           : {
      regions: [
        {
          values           : visitorsData,
          scale            : ['#92c1dc', '#ebf4f9'],
          normalizeFunction: 'polynomial'
        }
      ]
    },
    onRegionLabelShow: function (e, el, code) {
      if (typeof visitorsData[code] != 'undefined')
        el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
    }
  });

  // Sparkline charts
  var myvalues = [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021];
  $('#sparkline-1').sparkline(myvalues, {
    type     : 'line',
    lineColor: '#92c1dc',
    fillColor: '#ebf4f9',
    height   : '50',
    width    : '80'
  });
  myvalues = [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921];
  $('#sparkline-2').sparkline(myvalues, {
    type     : 'line',
    lineColor: '#92c1dc',
    fillColor: '#ebf4f9',
    height   : '50',
    width    : '80'
  });
  myvalues = [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21];
  $('#sparkline-3').sparkline(myvalues, {
    type     : 'line',
    lineColor: '#92c1dc',
    fillColor: '#ebf4f9',
    height   : '50',
    width    : '80'
  });

  // The Calender
  $('#calendar').datepicker();

  // SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '250px'
  });


  if(uri_2 == ''){

    /* Morris.js Charts */
    // Sales chart
    var area = new Morris.Area({
      element   : 'revenue-chart',
      resize    : true,
      data      : [{ y: '2011 Q1', item1: 2666, item2: 2666 }],
      // [
      //   { y: '2011 Q1', item1: 2666, item2: 2666 },
      //   { y: '2011 Q2', item1: 2778, item2: 2294 },
      //   { y: '2011 Q3', item1: 4912, item2: 1969 },
      //   { y: '2011 Q4', item1: 3767, item2: 3597 },
      //   { y: '2012 Q1', item1: 6810, item2: 1914 },
      //   { y: '2012 Q2', item1: 5670, item2: 4293 },
      //   { y: '2012 Q3', item1: 4820, item2: 3795 },
      //   { y: '2012 Q4', item1: 15073, item2: 5967 },
      //   { y: '2013 Q1', item1: 10687, item2: 4460 },
      //   { y: '2013 Q2', item1: 8432, item2: 5713 }
      // ],
      xkey      : 'y',
      ykeys     : ['item1', 'item2'],
      labels    : ['Item 1', 'Item 2'],
      lineColors: ['#a0d0e0', '#3c8dbc'],
      hideHover : 'auto'
    });
    var line = new Morris.Line({
      element          : 'line-chart',
      resize           : true,
      data             : [{ y: '2011 Q1', item1: 2666 }],
      // [
      //   { y: '2011 Q1', item1: 2666 },
      //   { y: '2011 Q2', item1: 2778 },
      //   { y: '2011 Q3', item1: 4912 },
      //   { y: '2011 Q4', item1: 3767 },
      //   { y: '2012 Q1', item1: 6810 },
      //   { y: '2012 Q2', item1: 5670 },
      //   { y: '2012 Q3', item1: 4820 },
      //   { y: '2012 Q4', item1: 15073 },
      //   { y: '2013 Q1', item1: 10687 },
      //   { y: '2013 Q2', item1: 8432 }
      // ],
      xkey             : 'y',
      ykeys            : ['item1'],
      labels           : ['Item 1'],
      lineColors       : ['#efefef'],
      lineWidth        : 2,
      hideHover        : 'auto',
      gridTextColor    : '#fff',
      gridStrokeWidth  : 0.4,
      pointSize        : 4,
      pointStrokeColors: ['#efefef'],
      gridLineColor    : '#efefef',
      gridTextFamily   : 'Open Sans',
      gridTextSize     : 10
    });

    // Donut Chart
    // var donut = new Morris.Donut({
    //   element  : 'sales-chart',
    //   resize   : true,
    //   colors   : ['#3c8dbc', '#f56954', '#00a65a'],
    //   data     : [
    //     { label: 'Download Sales', value: 12 },
    //     { label: 'In-Store Sales', value: 30 },
    //     { label: 'Mail-Order Sales', value: 20 }
    //   ],
    //   hideHover: 'auto'
    // });

  }

  // Fix for charts under tabs
  $('.box ul.nav a').on('shown.bs.tab', function () {
    area.redraw();
    donut.redraw();
    line.redraw();
  });

  /* The todo list plugin */
  $('.todo-list').todoList({
    onCheck  : function () {
      window.console.log($(this), 'The element has been checked');
    },
    onUnCheck: function () {
      window.console.log($(this), 'The element has been unchecked');
    }
  });

  //video page
  $(document).find('.video-primary-btn').on('click', function(){
    var $self = $(this);
    var id = $(this).data('id');
    $.post(
      base_url+'/api/change_primary_video',
      {id: id, _token: window.csrf_token},
      function(res){
        console.log(res);
        window.location.reload(true);
      },
      'json'
    );
  });

  //events page
  $(document).find('.send_event_invite').on('click', function(){
    var $self = $(this);
    var info = $(this).data('info');
    var type = $self.data('type');
    var message = (type == 'paid') ? 'Send invite to paid users?' : 'Send invite to non-paid users?';
    bootbox.confirm(message, function(r){
      if(r){
        console.log(r, type);

        var dialog = bootbox.dialog({
          message: '<p class="text-center lead"> <i class="fa fa-spinner fa-spin"></i> Please wait...</p>',
          closeButton: false
        });

        $.post(
          base_url+'/api/send_event_invite',
          {type: type, id: info.id, _token: window.csrf_token},
          function(res){
            console.log(res);
            dialog.modal('hide');
            bootbox.alert("Invite successfully sent.");
          },
          'json'
        );


      }
    });
    console.log($(this).data('info'));
  });

  //toggle contents
  $('.toggle-hide').on('click', function(){
    console.log($(this).data());
    var tohide = $(this).data('tohide');
    var toshow = $(this).data('toshow');

    $('.'+tohide).addClass('hidden');
    $('.'+toshow).removeClass('hidden');
  });

  //non user page
  var nonu_table = $('.table-dt-search').DataTable({
    'paging'      : false,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : false,
    'info'        : false,
    'autoWidth'   : false
  });

  nonu_table.rows().every( function () {
    this.child( 'Row details for row: '+this.index() );
    console.log(this, this.index(), "Csdf");
    this.hide(true);
} );
});
