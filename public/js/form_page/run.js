if ($('#jalur_pendaftaran').val() == '') {
  sessionStorage.setItem('card-active', 'card-prodi')
}
/*
| TAB CARD ENTRY
|
*/
if (sessionStorage.getItem('card-active') != undefined) {
  $(`#${sessionStorage.getItem('card-active')}`)
    .addClass('id-show')
    .removeClass('id-hide')
} else {
  $('#card-prodi').addClass('id-show').removeClass('id-hide')
}
$('.next-card').click(function () {
  $(this).addClass('btn-loader--loading')
  const next = $(this).data('next-id')
  const this_card = $(this).data('card-id')
  $('#' + this_card)
    .addClass('id-hide')
    .removeClass('id-show')
  $(`#${next}`).addClass('id-show').removeClass('id-hide')
  sessionStorage.setItem('card-active', next)
  $(this).removeClass('btn-loader--loading')
})
/*
| 
| END TAB CARD ENTRY
*/
