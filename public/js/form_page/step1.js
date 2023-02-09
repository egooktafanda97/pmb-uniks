//    ************************************************************
/*
| HNDEL ALIH JENJANG
|
*/
$('#jalur_pendaftaran').change(function () {
  if ($(this).val() == 'alih_jenjang') {
    $('.form_alih_jenjang').show()
  } else if ($(this).val() == 'kip-k') {
    $('.form_kip').show()
  } else {
    $('.form_alih_jenjang').hide()
    $('.form_kip').hide()
    const _ls = localStorage.getItem('entry')
    if (localStorage.hasOwnProperty('entry') || !__empty(_ls)) {
      const localStorageItems = { ...JSON.parse(localStorage.getItem('entry')) }
      delete localStorageItems?.jml_sks
      delete localStorageItems?.kategori_pt
      delete localStorageItems?.pt_sebelumnya
      delete localStorageItems?.memiliki_kartu
      delete localStorageItems?.ijazah_diperolah
      $("[name='jml_sks']").val('')
      $("[name='kategori_pt']").val('')
      $("[name='pt_sebelumnya']").val('')
      $("[name='memiliki_kartu']").val('')
      $("[name='ijazah_diperolah']").val('')
      localStorage.setItem('entry', JSON.stringify(localStorageItems))
    }
  }
})
/*
 | 
 | END HNDEL ALIH JENJANG
 */
//    ************************************************************
/*
| SIMPAN PEMBAHARUAN PRODI
|
*/
$('#card-program-studi').click(function () {
  $(this).addClass('btn-loader--loading')
  const _prod = $('#p1').val()
  const form_data = new FormData()
  if (__empty($('#jalur_pendaftaran').val())) {
    $.toast({
      title: 'Opps!',
      subtitle: '',
      content: 'Pilih jalur pendafataran!',
      type: 'error',
      delay: 2000,
    })
    return
  }
  if (__empty(_prod)) {
    $.toast({
      title: 'Opps!',
      subtitle: '',
      content: 'Paling tidak pilih 1 program studi!',
      type: 'error',
      delay: 2000,
    })
    return
  }

  if (!__empty($('#p1').val())) form_data.append('prodi_1', $('#p1').val())
  if (!__empty($('#p2').val())) form_data.append('prodi_2', $('#p2').val())
  // ||||||||||||||||||||||||||||||||||||
  if ($('#jalur_pendaftaran').val() == 'alih_jenjang') {
    if (
      alr(
        __empty($("[name='pt_sebelumnya']").val()),
        'nama perguruan tinggi tidak boleh kosong',
      )
    ) {
      $("[name='pt_sebelumnya']").focus()
      return
    }
    if (
      alr(
        __empty($("[name='kategori_pt']").val()),
        'kategori perguruan tinggi tidak boleh kosong',
      )
    ) {
      $("[name='kategori_pt']").focus()
      return
    }
    if (
      alr(__empty($("[name='jml_sks']").val()), 'jumlah sks tidak boleh kosong')
    ) {
      $("[name='jml_sks']").focus()
      return
    }
  }

  const http_configure = {
    data: form_data,
    url: `${window.uri}/mahasiswa/register-prodi-update`,
    header: {
      headers: {
        Authorization: token,
      },
    },
    errors: (error) => {
      const { response } = error
      const { request, ...errorObject } = response
      if (errorObject?.status != 200) {
        const err = errorObject?.data?.error ?? {}
        if (Object.keys(err).length > 0) {
          for (const key in err) {
            if (err.hasOwnProperty(key)) {
              $(`[name='${key}']`).addClass('is-invalid')
            }
          }
        }
        $.toast({
          title: 'Opps!',
          subtitle: '',
          content: 'Proses gagal !',
          type: 'error',
          delay: 2000,
        })
      }
    },
    response: (res) => {
      const next = $(this).data('next-id')
      const this_card = $(this).data('card-id')
      $('#' + this_card)
        .addClass('id-hide')
        .removeClass('id-show')
      $(`#${next}`).addClass('id-show').removeClass('id-hide')
      sessionStorage.setItem('card-active', next)
      $(this).removeClass('btn-loader--loading')
      $.toast({
        title: 'Berhasil!',
        subtitle: '',
        content: 'Progrm studi berhasil di ubah!',
        type: 'success',
        delay: 2000,
      })
    },
  }
  save(http_configure)
  if ($('.single-select') == '') $('#info-prodi').hide()
  else $('#info-prodi').show()
})
/*
| 
| END SIMPAN PEMBAHARUAN PRODI 
*/

//    ************************************************************
/*
| SELECT PRODI
|
*/
$('.single-select').change(function () {
  if ($(this).val() == '')
    $('#info-prodi').addClass('id-hide').removeClass('id-show')
  else $('#info-prodi').addClass('id-show').removeClass('id-hide')
  $('#card-info-syarat').html('')
  ajax_getProdi($(this).val(), (res) => {
    const data = res?.data
    const loops = data?.persyaratan_prodi
    const biaya = data?.biaya_kuliah
    component_prodi_syarat(loops, data)
    component_prodi_biaya_kuliah(biaya, data)
  })
})

/*
| 
| END SIMPAN PEMBAHARUAN PRODI 
*/
//    ************************************************************
/*
| COMPONENT SYARAT PRODI
|
*/
function component_prodi_syarat(loops, data) {
  let __loop_html = ``
  let __html = ``
  if (loops.length > 0) {
    loops?.map((x, io) => {
      __loop_html += `<li class="list-group-item bg-transparent text-dark w-100 d-flex">
                                <div
                                     style="width: 3%; display: flex;justify-content: center;align-content: center">
                                    <strong>${io + 1}</strong>
                                </div>
                                <div>
                                    <strong>
                                        ${x?.persyaratan}
                                    </strong>
                                    <br>
                                    <small> ${x?.keterangan}</small>
                                </div>
                            </li>`
    })
    __html = `
                        <div class="">
                            <ul class="list-group list-group-flush">
                               ${__loop_html}    
                            </ul>
                        </div>
                        `
  } else {
    __html = `<div class="alert bg-white border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-info"><i
                                           class="bx bx-info-circle"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0 text-info">Info!</h6>
                                        Tidak ada persyaratan khusus pada prodi
                                        ${data?.nama_prodi}
                                    </div>
                                </div>
                                <button aria-label="Close"
                                        class="btn-close"
                                        data-bs-dismiss="alert"
                                        type="button"></button>
                            </div>`
  }
  $('#card-info-syarat').html(__html)
}
/*
| 
| END COMPONENT SYARAT PRODI 
*/
//    ************************************************************
/*
| COMPONENT SYARAT PRODI
|
*/
function component_prodi_biaya_kuliah(loops) {
  let __loop_html = ``
  let __html = ``
  if (loops.length > 0) {
    loops?.map((x, io) => {
      __loop_html += ` <li
                                class="list-group-item bg-transparent text-dark w-100 d-flex">
                                    <div
                                        style="width: 3%; display: flex;justify-content: center;align-content: center">
                                        <strong>${io + 1}</strong>
                                    </div>
                                    <div>
                                        <strong>
                                            ${x?.keterangan}
                                        </strong>
                                        <br>
                                        <strong>
                                            ${x?.jumlah}
                                        </strong>
                                        <br>
                                        <small>${x?.deskripsi}</small>
                                    </div>
                                </li>`
    })
    __html = ` <div class="">
                        <ul class="list-group list-group-flush">
                           ${__loop_html}    
                        </ul>
                    </div>`
  } else {
    __html = `<div class="alert bg-white border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-info"><i
                                           class="bx bx-info-circle"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0 text-info">Info!</h6>
                                        Tidak ada persyaratan khusus pada prodi
                                        ${data?.nama_prodi}
                                    </div>
                                </div>
                                <button aria-label="Close"
                                        class="btn-close"
                                        data-bs-dismiss="alert"
                                        type="button"></button>
                            </div>`
  }
  $('#card-info-biaya').html(__html)
}
/*
| 
| END COMPONENT SYARAT PRODI 
*/
