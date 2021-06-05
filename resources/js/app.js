require('./bootstrap');

require('alpinejs');

require('../../node_modules/flickity/js/flickity');

$('.like').click(function () {
  $(this).toggleClass('far')
  $(this).toggleClass('fas')
})

if ($('.textarea')) {
  $('.textarea').on('input', function () {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
  });
}