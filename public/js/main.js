async function save(config) {
  const { data, url, header, response, errors } = config
  const post = await axios.post(url, data, header, response).catch((error) => {
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'fatal error entry data.',
        icon: 'error',
        button: 'Oke!',
      })
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'pastikan proses dilakukan dengan benar.',
        icon: 'error',
        button: 'Oke!',
      })
    errors(error)
  })
  if (post) {
    response(post)
  }
}
async function save_inheader(config) {
  const { data, url, response, errors } = config
  const post = await axios.post(url, data).catch((error) => {
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'fatal error entry data.',
        icon: 'error',
        button: 'Oke!',
      })
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'pastikan proses dilakukan dengan benar.',
        icon: 'error',
        button: 'Oke!',
      })
    errors(error)
  })
  response(post)
}
async function getById(config) {
  const { id, url, header, response, errors } = config
  const gett = await axios.get(url + id, header, response).catch((error) => {
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'fatal error result data.',
        icon: 'error',
        button: 'Oke!',
      })
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'pastikan proses dilakukan dengan benar.',
        icon: 'error',
        button: 'Oke!',
      })
    errors(error)
  })
  if (gett) {
    response(gett)
  }
}
async function http_get_header(config) {
  const { url, header, response, errors } = config
  const gett = await axios.get(url, header, response).catch((error) => {
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'fatal error result data.',
        icon: 'error',
        button: 'Oke!',
      })
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'pastikan proses dilakukan dengan benar.',
        icon: 'error',
        button: 'Oke!',
      })
    errors(error)
  })
  if (gett) {
    response(gett)
  }
}

async function http_get(config) {
  const { url, response, errors } = config
  const gett = await axios.get(url, response).catch((error) => {
    errors(error)
  })
  if (gett) {
    response(gett)
  }
}
async function request_get(config) {
  const { url, header, response, errors } = config
  const gett = await axios.get(url, header).catch((error) => {
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'fatal error result data.',
        icon: 'error',
        button: 'Oke!',
      })
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'pastikan proses dilakukan dengan benar.',
        icon: 'error',
        button: 'Oke!',
      })
    errors(error)
  })
  if (gett) {
    response(gett)
  }
}

async function request_post(config) {
  const { url, data, header, response, errors } = config
  const gett = await axios.post(url, data, header).catch((error) => {
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'fatal error result data.',
        icon: 'error',
        button: 'Oke!',
      })
    if (error?.response?.status == 501)
      swal({
        title: 'Ooops fatal error!',
        text: 'pastikan proses dilakukan dengan benar.',
        icon: 'error',
        button: 'Oke!',
      })
    errors(error)
  })
  if (gett) {
    response(gett)
  }
}

$.fn.getType = function () {
  return this[0].tagName == 'INPUT'
    ? this[0].type.toLowerCase()
    : this[0].tagName.toLowerCase()
}

function __empty(args) {
  if (args == 'null') return true
  if (args == '') return true
  if (args == ' ') return true
  if (args == 'undefined') return true
  if (args == null) return true
  if (args == undefined) return true
  if (args == false) return true
  return false
}

// $(".button--loader").each(function () {
//     $(this).click(function () {
//         $(this).toggleClass("button--loading");
//         $(this).attr("disabled", true);
//     })
// })

function deleted(config) {
  const { url, header, msg = null, errors, result } = config
  swal({
    title: 'Yakin?',
    text: msg != null ? msg : 'anda akan menghapus data ini!',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      async function deleted() {
        const del = await axios.delete(url, header).catch((error) => {
          const { response } = error
          const { request, ...errorObject } = response
          if (errorObject?.status != 200) {
            const err = errorObject?.data?.error ?? {}
            errors(err)
          }
        })
        if (del) {
          result(del)
        }
      }
      deleted()
    }
  })
}
