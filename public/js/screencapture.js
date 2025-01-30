

/**
 * Screen capture functions
 */
$(function () {

    /**
     * Sets an ID to tables without one
     */
    $('table').each(function () {
        if (!$(this).attr('id'))
            $(this).attr('id', makeid(8));
    });

    /**
     * Shortcuts to take capture:
     * - Ctrl+Alt+P = whole page
     * - Ctrel+Alt+Shift+P : select a part of the page
     * - Esscape = cancel part capture
     */
    var mouseCurrDiv = false;
    $(document).keydown(function (e) {
        if (e.keyCode == 27 && !e.ctrlKey && !e.altKey && !e.shiftKey) {
            e.preventDefault();
            $('#divCapture').hide();
            $('*').removeClass('divCapture');
            mouseCurrDiv = false;
            return;
        } else if (e.keyCode == 80 && e.ctrlKey && e.altKey && e.shiftKey) {
            e.preventDefault();
            mouseCurrDiv = true;
            return;
        } else if (e.keyCode == 80 && e.ctrlKey && e.altKey && !e.shiftKey) {
            e.preventDefault();
            saveCapture('article');
            return;
        }
        return;
    });

    /**
     * Validates part capture by clicking on it.
     */
    $(document).on('mousedown', function (e) {
        if (!mouseCurrDiv)
            return;
        e.preventDefault();
        $('#divCapture').hide();
        var o = $('.divCapture');
        $('.divCapture').removeClass('divCapture');
        mouseCurrDiv = false;
        saveCapture(o.attr('id'));
        return;

    });

    /**
     * Mouse over to find capturable parts
     */
    $('*').on('mouseover', document, function (e) {
        if (!mouseCurrDiv)
            return;
        var o = $(event.target);
        while (
                !$(o).attr('id')
                || $(o).attr('id') == 'divCapture') {

            if (o.prop("tagName") === undefined)
                return;
            o = $(o).parent();
        }

        if (o.prop("tagName") === undefined)
            return;

        $('.divCapture').removeClass('divCapture');
        $(o).addClass('divCapture');
        $('#divCapture').show();
        $('#divCapture').css('left', $(o).offset().left);
        $('#divCapture').css('top', $(o).offset().top);
        $('#divCapture').css('width', $(o).width());
        $('#divCapture').css('height', $(o).height());

    });
});

/**
 * Capture saving, using Canvas (HTML5 component) 
 * & link to an octet-streamed image
 * and download PNG image.
 * Uses html2canvas.js class.
 * @param {string} id of the element to capture
 * @returns nothing
 */
function saveCapture(id) {
    $("#screenCaptureInProgress").modal('show');
    var top = $(window).scrollTop();
    $(window).scrollTop(0);
    html2canvas(document.querySelector("#" + id)).then(canvas => {
        //document.body.appendChild(canvas);
        var img = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
        var link = document.getElementById('savePagePNGLink');
        var d = new Date();
        link.setAttribute('download', 'ScreenCapture-' + d.toISOString() + '.png');
        link.setAttribute('href', img);
        hideLoading();
        link.click();
        $(window).scrollTop(top);
        return;
    });
}