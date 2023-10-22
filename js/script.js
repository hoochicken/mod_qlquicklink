jQuery('.qlquicklink').find('li').on( 'mouseenter', function(el) {
  let liItem = jQuery(el.currentTarget);
  liItem.animate({ 'margin-left': -200}, 500, function () {liItem.addClass('link-visible');});
});

jQuery('.qlquicklink').find('li').on( 'mouseleave', function(el) {
  let liItem = jQuery(el.currentTarget);
  liItem.removeClass('link-visible');
  liItem.animate({ 'margin-left': 0}, 500, function () {liItem.removeClass('link-visible');});
} );