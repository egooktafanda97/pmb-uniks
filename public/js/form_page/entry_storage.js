//    **************************************************************************************
/*
    | TAB SORAGE ENTRY HNDEL
    |
    */

async function _readedCmhs() {
  const main = await axios.get(`${window.uri}/mahasiswa/read`, {
    headers: {
      Authorization: token,
    },
  })
  if (main) {
    if (!__empty(main?.data?.calon_mahasiswa)) {
      const cmhs = main.data?.calon_mahasiswa
      const ortu = main.data?.calon_mahasiswa?.orangtua
      delete cmhs.orangtua
      const data_ready = {
        ...cmhs,
        ...ortu,
      }
      $('input, select, textarea').each(function (index) {
        $(this).val(data_ready[$(this).attr('name')])
        localStorage.setItem('entry', JSON.stringify(data_ready))
      })
      _init_alamat_ready()
    } else if (
      __empty(main?.data?.calon_mahasiswa) &&
      localStorage.hasOwnProperty('entry')
    ) {
      const data_ready = JSON.parse(localStorage.getItem('entry'))
      $('input, select, textarea').each(function (index) {
        if (__empty($(this).val())) {
          $(this).val(data_ready[$(this).attr('name')])
        }
      })
      _init_alamat_ready()
    } else {
      const _ls = localStorage.getItem('entry')
      if (!localStorage.hasOwnProperty('entry') || __empty(_ls)) {
        const init_obj = main.data?.calon_mahasiswa ?? {}
        init_obj.token = init_token
        $('input, select, textarea').each(function (index) {
          if (!__empty($(this).val())) {
            init_obj[$(this).attr('name')] = $(this).val()
          }
        })
        localStorage.setItem('entry', JSON.stringify(init_obj))
      }
    }
    if (!__empty(main?.data?.pilihan_prodi)) {
      main?.data?.pilihan_prodi?.map((easy) => {
        if (easy?.no_pilihan == '1') $('#p1').val(easy?.prodi_id).select2()
        if (easy?.no_pilihan == '2') $('#p2').val(easy?.prodi_id).select2()
      })
    }
  }
}
_readedCmhs()

//    **************************************************************************************
$('input,select,textarea').change(function () {
  const data_ready = JSON.parse(localStorage.getItem('entry'))
  if (!__empty($(this).val()) && !__empty(data_ready)) {
    data_ready[$(this).attr('name')] = $(this).val()
    localStorage.setItem('entry', JSON.stringify(data_ready))
  }
})
