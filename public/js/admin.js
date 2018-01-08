var siteDashBoard = function () {

var runSideMenu = function() {
	$('#side-menu').metisMenu();
};
//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
var runLoadResizef = function() {
	$(window).bind("load resize", function() {
		topOffset = 50;
		width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
		if (width < 768) {
			$('.navbar-collapse').addClass('collapse');
			topOffset = 100; // 2-row-menu
		} else {
			$('.navbar-collapse').removeClass('collapse');
		}
	
		height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
		height = height - topOffset;
		if (height < 1) height = 1;
		if (height > topOffset) {
			$("#page-wrapper").css("min-height", (height) + "px");
		}
   });
};

var runImageReadUrl = function(){
	function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();            
		reader.onload = function (e) {
			$('.targetImage').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	  }
    }
    $(".ImgeInput").change(function(){
        readURL(this);
    });
};
var runSelectAlls = function() {
$('#selectAll').click(function (e) {
		$(this).closest('.admin-table').find('td input:checkbox').prop('checked', this.checked);
	});
};

var runPanelClose = function() {
// panel close
	$('body').on('click', '.panel-close', function(e) {
		$(this).parents(".HideSection").fadeOut();
		e.preventDefault();
	});
	// panel refresh
	$('body').on('click', '.panel-refresh', function(e) {
		var el = $(this).parents(".panel");
		el.block({
			overlayCSS: {
				backgroundColor: '#fff'
			},
			message: '<i class="fa fa-spinner fa-spin"></i>',
			css: {
				border: 'none',
				color: '#333',
				background: 'none'
			}
		});
		window.setTimeout(function() {
			el.unblock();
		}, 1000);
		e.preventDefault();
	});
};

var runPanelScroll = function() {
	$('.panel-scroll').perfectScrollbar({
		wheelSpeed: 40,
		minScrollbarLength: 8,
		suppressScrollX: true
	});
	$('.table-description').perfectScrollbar({
		wheelSpeed: 50,
		minScrollbarLength: 10,
		suppressScrollX: true
	});
};
var runGoTop = function(e) {
	$('.goto-top').on('click', function(e) {
		$("html, body").animate({
			scrollTop: 0
		}, "slow");
		e.preventDefault();
	});
};
	
var runTooltips = function() {
	if($(".tooltips").length) {
		$('.tooltips').tooltip();
	}
};
var runPopovers = function() {
	if($(".popovers").length) {
		$('.popovers').popover();
	}
};
//function to activate the panel tools
var runModuleTools = function() {
		// fullscreen
		$('body').on('click', '.panel-expand', function(e) {
			e.preventDefault();
			$('.panel-tools > a, .panel-tools .dropdown').hide();

			if($('.full-white-backdrop').length == 0) {
				$body.append('<div class="full-white-backdrop"></div>');
			}
			var backdrop = $('.full-white-backdrop');
			var wbox = $(this).parent().parents('.panel');
			wbox.attr('style', '');
			if(wbox.hasClass('panel-full-screen')) {
				backdrop.fadeIn(200, function() {
					$('.panel-tools > .tmp-tool').remove();
					$('.panel-tools > a, .panel-tools .dropdown').show();
					wbox.removeClass('panel-full-screen');
					backdrop.fadeOut(200, function() {
						backdrop.remove();
						$(window).trigger('resize');
					});
				});
			} else {

				backdrop.fadeIn(200, function() {

					$('.panel-tools').append("<a class='panel-expand tmp-tool' href='#'><i class='fa fa-compress'></i></a>");
					backdrop.fadeOut(200, function() {
						backdrop.hide();
					});
					wbox.addClass('panel-full-screen').css({
						'max-height': $windowHeight,
						'overflow': 'auto'
					});
					$(window).trigger('resize');
				});
			}
		});
		// panel close
		$('body').on('click', '.panel-close', function(e) {
			$(this).parents(".panel").fadeOut();
			e.preventDefault();
		});
		// panel refresh
		$('body').on('click', '.panel-refresh', function(e) {
			var el = $(this).parents(".panel");
			el.block({
				overlayCSS: {
					backgroundColor: '#fff'
				},
				message: '<i class="fa fa-spinner fa-spin"></i>',
				css: {
					border: 'none',
					color: '#333',
					background: 'none'
				}
			});
			window.setTimeout(function() {
				el.unblock();
			}, 1000);
			e.preventDefault();
		});
		// panel collapse
		$('body').on('click', '.panel-collapse', function(e) {
			e.preventDefault();
			var el = $(this);
			var bodyPanel = jQuery(this).parent().closest(".panel").children(".panel-body");
			if($(this).hasClass("collapses")) {
				bodyPanel.slideUp(200, function() {
					el.addClass("expand").removeClass("collapses").children("span").text("Expand").end().children("i").addClass("fa-rotate-180");
				});
			} else {
				bodyPanel.slideDown(200, function() {
					el.addClass("collapses").removeClass("expand").children("span").text("Collapse").end().children("i").removeClass("fa-rotate-180");
				});
			}
		});
	};

// function to activate the ToDo list, if present
var runActionToDo = function() {
	if($(".todo-actions").length) {
		$(".todo-actions > i").click(function() {
			if($(this).hasClass("fa-square-o") || $(this).hasClass("icon-check-empty")) {

				$(this).removeClass("fa-square-o").addClass("fa-check-square-o").parent().find("span").css({
					opacity: .25
				}).end().find(".todo-tools").hide().end().parent().find(".desc").css("text-decoration", "line-through");
			} else {
				$(this).removeClass("fa-check-square-o").addClass("fa-square-o").parent().find("span").css({
					opacity: 1
				}).end().find(".todo-tools").show().end().parent().find(".desc").css("text-decoration", "none");
			}
			return !1;
		});
	}
};

 return {
        init: function () {
			runSideMenu();
			runLoadResizef();
			runImageReadUrl();
			runSelectAlls();
			runPanelScroll();
			runPanelClose();
			runGoTop();
			runTooltips();
			runPopovers();
			runActionToDo();
        }
    };
}();