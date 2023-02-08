$('.person_data_next').click(function () {
  if (__empty($('#provinsi').val())) {
    ajax_prov()
  }
})
/*
| 
| END TAB SORAGE ENTRY HNDEL
*/

//    ************************************************************
/*
| DATA PERSONAL
|
*/
$('#jenis_slta').change(function () {
  if ($(this).val() == 'lainnya') {
    $('#lainya_jenis_slta').show()
    $('#lainya_jenis_slta').prop('name', 'jenis_slta')
    $('#lainya_jenis_slta').prop('required', true)
    $(this).removeAttr('required')
    $(this).removeAttr('name')
  } else {
    $('#lainya_jenis_slta').hide()
    $('#lainya_jenis_slta').removeAttr('name', 'jenis_slta')
    $('#lainya_jenis_slta').removeAttr('required')
    $(this).prop('required', true)
    $(this).prop('name', 'jenis_slta')
  }
})
$('#data-personal').click(function () {
  if (!moment($('#from-date').val(), 'DD/MM/YYYY', true).isValid()) {
    $.toast({
      title: 'Opps!',
      subtitle: ``,
      content: `format tanggal salah, tanggal/bulan/tahun`,
      type: 'error',
      delay: 3000,
    })
    $('#from-date').focus()
    return
  }

  if (alr($("[name='nik']").val().length != 16, 'nik harus 16 digit')) {
    $("[name='nik']").focus()
    return
  }
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
  | END SIMPAN PEMBAHARUAN PRODI 
  */
