

function calcSize() {
  var height_screen = $(window).height();
  var height_header = $('header').outerHeight();
  $(".container").css({ "height": height_screen });
  $(".slide").css({ "height": height_screen - height_header });
  $(".content").css({ "height": height_screen - height_header });
}
