/*|*/
//    ==========================
/*
| AJAX 
|
*/
function ajax_prov(result = null) {
  const optProv = {
    url: window.api_wilayah,
    response: (res) => {
      // if (res?.data.lnght)
      if (res?.data?.length > 0) {
        const prov = res?.data?.map(
          (x) => `<option value="${x?.id}">${x?.nama}</option>`,
        )
        $('#provinsi').append(`<option value="">PILIH PROVINSI</option>`)
        $('#provinsi').append(prov)
        if (result != null) {
          result(res?.data)
        }
      }
    },
    errors: (err) => {},
  }
  http_get(optProv)
}

function ajax_kab(prov_id, elemet, result = null) {
  const optKab = {
    url: `${window.api_wilayah}?provinsi_id=${prov_id}`,
    response: (res) => {
      // if (res?.data.lnght)
      if (res?.data?.length > 0) {
        elemet.html(``)
        const kab = res?.data?.map(
          (x) => `<option value="${x?.id}">${x?.nama}</option>`,
        )
        elemet.append(`<option value="">PILIH KABUPATEN</option>`)
        elemet.append(kab)
        if (result != null) result()
      }
    },
    errors: (err) => {},
  }
  http_get(optKab)
}

function ajax_kec(kab_id, elemet, result = null) {
  const optKab = {
    url: `${window.api_wilayah}?kabupaten_id=${kab_id}`,
    response: (res) => {
      // if (res?.data.lnght)
      if (res?.data?.length > 0) {
        elemet.html(``)
        const kab = res?.data?.map(
          (x) => `<option value="${x?.id}">${x?.nama}</option>`,
        )
        elemet.append(`<option value="">PILIH KECAMATAN</option>`)
        elemet.append(kab)
        if (result != null) result()
      }
    },
    errors: (err) => {},
  }
  http_get(optKab)
}

function ajax_kel(kec_id, elemet, result = null) {
  const optKab = {
    url: `${window.api_wilayah}?kecamatan_id=${kec_id}`,
    response: (res) => {
      // if (res?.data.lnght)
      if (res?.data?.length > 0) {
        elemet.html(``)
        const kab = res?.data?.map(
          (x) => `<option value="${x?.id}">${x?.nama}</option>`,
        )
        elemet.append(`<option value="">PILIH KELURAHAN</option>`)
        elemet.append(kab)
        if (result != null) result()
      }
    },
    errors: (err) => {},
  }
  http_get(optKab)
}

function _init_alamat_ready() {
  ajax_prov(function () {
    const data_ready = JSON.parse(localStorage.getItem('entry'))
    if (__empty(data_ready?.provinsi)) return
    $('#provinsi').val(data_ready?.provinsi)
    ajax_kab(data_ready?.provinsi, $('#kabupaten'), function () {
      $('#kabupaten').val(data_ready?.kabupaten)
      console.log(data_ready?.kecamatan)
      ajax_kec(data_ready?.kabupaten, $('#kecamatan'), function (res) {
        $('#kecamatan').val(data_ready?.kecamatan)
        ajax_kel(data_ready?.kecamatan, $('#kelurahan'), function () {
          $('#kelurahan').val(data_ready?.kelurahan)
        })
      })
    })
  })
}

/*
| 
| END 
*/
//    **************************************************************************************
/*
| FUNCTION SELECTED ALAMAT
|
*/
ajax_prov()
$('#provinsi').change(function () {
  ajax_kab($(this).val(), $('#kabupaten'))
})
$('#kabupaten').change(function () {
  ajax_kec($(this).val(), $('#kecamatan'))
})
$('#kecamatan').change(function () {
  ajax_kel($(this).val(), $('#kelurahan'))
})
/*
| 
| END FUNCTION SELECTED ALAMAT
*/
$('#data-address').click(function () {
  if (alr(__empty($("[name='provinsi']").val()), 'provinsi harus di isi')) {
    return
  }
  if (alr(__empty($("[name='kabupaten']").val()), 'kabupaten harus di isi')) {
    return
  }
  if (alr(__empty($("[name='kecamatan']").val()), 'kecamatan harus di isi')) {
    return
  }
  if (alr(__empty($("[name='kelurahan']").val()), 'kelurahan harus di isi')) {
    return
  }
  if (
    alr(
      __empty($("[name='alamat_lengkap']").val()),
      'alamat lengkap harus di isi',
    )
  ) {
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
