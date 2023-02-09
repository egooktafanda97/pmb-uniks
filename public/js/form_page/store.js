//    ************************************************************
/*
| STORE ENTRY DATA
|
*/
function validate() {
  if (alr(__empty($("[name='nama_ayah']").val()), 'nama ayah harus di isi')) {
    $("[name='nama_ayah']").addClass('is-invalid')
    return true
  }
  if (
    alr(
      __empty($("[name='tempat_lahir_ayah']").val()),
      'tempat lahir ayah harus di isi',
    )
  ) {
    $("[name='tempat_lahir_ayah']").addClass('is-invalid')
    return true
  }
  if (
    alr(
      __empty($("[name='tanggal_lahir_ayah']").val()),
      'tanggal lahir ayah harus di isi',
    )
  ) {
    $("[name='tanggal_lahir_ayah']").addClass('is-invalid')
    return true
  }

  if (alr(__empty($("[name='nama_ibu']").val()), 'nama ibu harus di isi')) {
    $("[name='nama_ibu']").addClass('is-invalid')
    return true
  }
  if (
    alr(
      __empty($("[name='tempat_lahir_ibu']").val()),
      'tempat lahir ibu harus di isi',
    )
  ) {
    $("[name='tempat_lahir_ibu']").addClass('is-invalid')
    return true
  }
  if (
    alr(
      __empty($("[name='tanggal_lahir_ibu']").val()),
      'tanggal lahir ibu harus di isi',
    )
  ) {
    $("[name='tanggal_lahir_ibu']").addClass('is-invalid')
    return true
  }
  if (
    alr(
      __empty($("[name='jenis_kelamin']").val()),
      'jenis kelamin wajib di isi',
    )
  ) {
    $("[name='jenis_kelamin']").addClass('is-invalid')
    return true
  }
  if (
    alr(__empty($("[name='no_ijazah']").val()), 'No Ijazah tidak boleh kosong')
  ) {
    $("[name='no_ijazah']").addClass('is-invalid')
    return true
  }
  return false
}
$('#form-done').click(function () {
  if (validate()) {
    return
  }
  const Btn = $(this)
  Btn.addClass('btn-loader--loading')
  store(Btn, (r) => {
    // localStorage.removeItem('entry')
  })
})
function store(load, callback) {
  const data = JSON.parse(localStorage.getItem('entry'))
  if (alr(__empty(pendaftaran_id), 'Kesalalhan fatal.')) {
    return
  }
  data['pendaftaran_id'] = pendaftaran_id
  data['nik'] = $("[name='nik']").val() ?? ''
  data['tanggal_lahir'] = moment(data['tanggal_lahir'], 'DD/MM/YYYY').format(
    'YYYY-MM-DD',
  )
  console.log(data['tanggal_lahir'])
  const http_configure = {
    data: data,
    url: `${window.uri}/mahasiswa/register`,
    header: {
      headers: {
        Authorization: token,
      },
    },
    errors: (error) => {
      const { response } = error
      const { request, ...errorObject } = response
      if (errorObject?.status != 200 && errorObject?.status < 500) {
        const err = errorObject?.data?.error ?? {}
        if (Object.keys(err).length > 0) {
          for (const key in err) {
            if (err.hasOwnProperty(key)) {
              $(`[name='${key}']`).addClass('is-invalid')
              $.toast({
                title: 'Opps!',
                subtitle: ``,
                content: `${err[key][0]}`,
                type: 'error',
                delay: 3000,
              })
            }
          }
          load.removeClass('btn-loader--loading')
        }
      } else {
        swal({
          title: 'Ooops fatal error!',
          text: 'pastikan proses dilakukan dengan benar.',
          icon: 'error',
          button: 'Oke!',
        })
        load.removeClass('btn-loader--loading')
      }
    },
    response: (res) => {
      callback(res)
      let msg = ''
      if (res?.status == 200) {
        msg = 'Data anda berhasil di simpan, next step!'
      } else if (res?.status == 201) {
        msg = 'data berhasil di update!'
      }
      load.removeClass('btn-loader--loading')
      swal({
        title: 'Selesai!',
        text: msg,
        icon: 'success',
        button: 'Oke!',
      }).then((willDelete) => {
        if (willDelete) {
          window.location.href = `${window.base_url}/mahasiswa/form`
        }
      })
    },
  }

  save(http_configure)
}
/*
  | 
  | END STORE ENTRY DATA
  */
