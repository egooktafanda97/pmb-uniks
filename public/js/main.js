async function save(config) {
    const {
        data,
        url,
        header,
        response,
        errors
    } = config;
    const post = await axios.post(url, data, header, response).catch((error) => {
        if (error?.response?.status == 501)
            swal({
                title: "Ooops fatal error!",
                text: "fatal error entry data.",
                icon: "error",
                button: "Oke!",
            });
        errors(error);
    });
    if (post) {
        response(post);
    }
}

async function getById(config) {
    const {
        id,
        url,
        header,
        response,
        errors
    } = config;
    const gett = await axios.post(url + id, header, response).catch((error) => {
        if (error?.response?.status == 501)
            swal({
                title: "Ooops fatal error!",
                text: "fatal error result data.",
                icon: "error",
                button: "Oke!",
            });
        errors(error);
    });
    if (gett) {
        response(gett);
    }
}

async function http_get(config) {
    const {
        url,
        response,
        errors
    } = config;
    const gett = await axios.get(url, response).catch((error) => {
        errors(error);
    });
    if (gett) {
        response(gett);
    }
}