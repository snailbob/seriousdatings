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
 
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': csrf_token
          }
      });
        var activeUsers = [];
        var TotalactiveUsers = [];
        var values = {};
        var area;
        var markersData =  [];
       $.ajax({

            url: base_url+"/api/populateStatisticsReport",
            type: "GET",
            contentType: false,
            cache: false,
            processData: false,
            respond: 'json',
            success: function (data) {
              $.each(data.demoGraph,function(i,k){
                  activeUsers.push(data.demoGraph[i].state);
                  TotalactiveUsers.push(data.demoGraph[i].counts);
              });

                  $.each(activeUsers, function(idx, value){
                      values[value] = TotalactiveUsers[idx];
                   
                  })

                  $.each(data.demoGraphMarkers,function(i,k){
                       markersData.push({latLng: [data.demoGraphMarkers[i].lat,data.demoGraphMarkers[i].long], name:data.demoGraphMarkers[i].nameFull ,style: {fill: 'yellow'}});
                  })
              

                  $('#world-map').vectorMap({
                    map              : 'world_mill_en',
                    normalizeFunction: 'polynomial',
                    hoverOpacity     : 0.7,
                    hoverColor       : false,
                    backgroundColor  : 'transparent',
                    regionStyle      : {
                      initial      : {
                        fill            : 'rgba(210, 214, 222, 1)',
                        'fill-opacity'  : 1,
                        stroke          : 'none',
                        'stroke-width'  : 0,
                        'stroke-opacity': 1
                      },
                      hover        : {
                        'fill-opacity': 0.7,
                        cursor        : 'pointer'
                      },
                      selected     : {
                        fill: 'yellow'
                      },
                      selectedHover: {}
                    },
                       series           : {
                      regions: [
                        {
                          values           : values,
                          scale            : ['#b71031', '#ef1c46'],
                          normalizeFunction: 'polynomial'
                        }
                      ],
                       markers: [{
                              attribute: 'fill',
                              min: 125,
                              max: 400
                            },{
                              attribute: 'r',
                              scale: [25, 35],
                              values:markersData,
                              min: 5,
                              max: 15
                            }]
                    },
                    onRegionLabelShow: function (e, el, code) {
                      if (typeof values[code] != 'undefined')
                        el.html(el.html() + ': ' + values[code] + ' active users');
                    },
                    markerStyle      : {
                      initial: {
                         fill  : '#00a65a',
                         stroke: '#111',
                         min: 25,
                         max: 45,
                      }
                    },
                    onMarkerTipShow: function(event, label, index){
                       console.log(markersData[index].name);
                        label.html(
                          '<b>'+markersData[index].name+'</b><br/>'+
                          '<b>Population: </b>'+markersData[index].name+'</br>'+
                          '<b>Unemployment rate: </b>'+markersData[index].name+'%'
                        );
                      },
                    markers          : markersData,

                  });

               
                  var dataReveneu = [];
                  $.each(data.datingSales,function(index,key){
                    var moneyValue = data.datingSales[index].price;
                    var payDate = data.datingSales[index].payDate;
                    var gateWayMethod = data.datingSales[index].gateWayMethod;
;
                      dataReveneu.push({ year: payDate, item: parseFloat(moneyValue)});
                  });

                    area = new Morris.Area({
                    element   : 'revenue-chart',
                    resize    : true,
                   
                       data: dataReveneu,
                            lineColors       : ['#d71818'],
                            // The name of the data record attribute that contains x-values.
                            xkey: 'year',
                            // A list of names of data record attributes that contain y-values.
                            ykeys: ['item'],
                            // Labels for the ykeys -- will be displayed when you hover over the
                            // chart.
                            labels: ['Value'],
                            hideHover: 'auto',
                            pointSize:2,

                  });
                  var eventsReveneu = [];
                  $.each(data.eventsSales,function(index,key){
                    var moneyValue = data.eventsSales[index].price.eventPrice;
                    var payDate = data.eventsSales[index].payDate;

                      eventsReveneu.push({ year: payDate, item: parseFloat(moneyValue) });
                  });
    
                    area = new Morris.Area({
                              element          : 'events-chart',
                              resize           : true,
                              data             : eventsReveneu,
                              xkey             : 'year',
                              ykeys            : ['item'],
                              labels           : ['Value'],
                              lineColors       : ['#71dbdb'],
                              lineWidth        : 2,
                              hideHover        : 'auto',
                              gridTextColor    : '#000000',
                              gridStrokeWidth  : 0.4,
                              pointSize        : 4,
                              pointStrokeColors: ['#efefef'],
                              gridLineColor    : '#d71818',
                              gridTextFamily   : 'Open Sans',
                              gridTextSize     : 10


                  });

                      var virtualReveneu = [];
                  $.each(data.virtualSales,function(index,key){
                    var moneyValue = data.virtualSales[index].price;
                    var payDate = data.virtualSales[index].payDate;

                      virtualReveneu.push({ year: payDate, item: parseFloat(moneyValue) });
                  });
 
                    area = new Morris.Area({
                              element          : 'virtual-chart',
                              resize           : true,
                              data             : virtualReveneu,
                              xkey             : 'year',
                              ykeys            : ['item'],
                              labels           : ['Value'],
                              lineColors       : ['#7ddd2e'],
                              lineWidth        : 2,
                              hideHover        : 'auto',
                              gridTextColor    : '#000000',
                              gridStrokeWidth  : 0.4,
                              pointSize        : 4,
                              pointStrokeColors: ['#efefef'],
                              gridLineColor    : '#d71818',
                              gridTextFamily   : 'Open Sans',
                              gridTextSize     : 10


                  });

                        var adsReveneu = [];
                  $.each(data.adsReveneu,function(index,key){
                    var moneyValue = data.adsReveneu[index].price;
                    var payDate = data.adsReveneu[index].payDate;

                      adsReveneu.push({ year: payDate, item: parseFloat(moneyValue) });
                  });
 
                    area = new Morris.Area({
                              element          : 'ads-chart',
                              resize           : true,
                              data             : adsReveneu,
                              xkey             : 'year',
                              ykeys            : ['item'],
                              labels           : ['Value'],
                              lineColors       : ['#e8ce09'],
                              lineWidth        : 2,
                              hideHover        : 'auto',
                              gridTextColor    : '#000000',
                              gridStrokeWidth  : 0.4,
                              pointSize        : 4,
                              pointStrokeColors: ['#efefef'],
                              gridLineColor    : '#d71818',
                              gridTextFamily   : 'Open Sans',
                              gridTextSize     : 10


                  });


                  var totatlReveneu = [];
                  $.each(dataReveneu,function(index,key){
                      totatlReveneu.push(key.item);   
                  });
                   $.each(eventsReveneu,function(index,key){
                      totatlReveneu.push(key.item);       
                  });
                    $.each(virtualReveneu,function(index,key){
                      totatlReveneu.push(key.item);       
                  });
                    $.each(adsReveneu,function(index,key){
                      totatlReveneu.push(key.item);       
                  });
                    $(".total-reveneu").html(totatlReveneu.reduce(add, 0));
                         
            },
            error: function (err) {
                console.log(err);
                
            }
        });
        function add(a, b) {
            return a + b;
        }
      



  // Sparkline charts

var  myvalues = [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921];
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
  $('body').on('click', '.video-primary-btn', function(){
    console.log('')
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
