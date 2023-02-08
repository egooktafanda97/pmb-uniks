function ajax_getProdi(id, result) {
  const optProv = {
    url: `${window.uri}/mahasiswa/get-prodi-id/${id}`,
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
          content: 'Progrm studi gagal di ubah!',
          type: 'error',
          delay: 2000,
        })
      }
    },
    response: (res) => {
      result(res)
    },
  }
  http_get_header(optProv)
}
