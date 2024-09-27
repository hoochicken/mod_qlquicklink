jQuery('.Xqlquicklink').find('a').on( 'mouseenter', function(ev) {
  slideInQuicklink(ev)
});
jQuery('.qlquicklink').find('a').on( 'click', function(ev) {
  slideInQuicklink(ev)
});

function slideInQuicklink(ev) {
  let aHref = jQuery(ev.currentTarget);
  let liItem = aHref.parent();

  if (liItem.hasClass('unfazed')) {
    ev.stopPropagation();
    ev.preventDefault();
  }

  if (!liItem.attr('data-marginLeft')) {
    liItem.attr('data-marginLeft', liItem.css('margin-left'));
  }
  liItem.animate({ 'margin-left': 0}, 500, function() {
    liItem.addClass('link-visible');
  });

  if (liItem.hasClass('unfazed')) {
    liItem.removeClass('unfazed');
    return false;
  }
}
