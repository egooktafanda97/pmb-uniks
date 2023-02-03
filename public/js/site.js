function btn_load(classes, load) {
    if (load)
        $(classes).addClass('btn-loader--loading');
    else
        $(classes).removeClass('btn-loader--loading');
}