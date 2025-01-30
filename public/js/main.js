$(function () {
    hideLoading();
});

function unLoad()
{
    $("#loadMe").modal('show');
}
window.onbeforeunload = unLoad;

function hideLoading() {
    setTimeout(function () {
        $(".modal:visible").click();
    }, 200);
    console.log('hide modal');
}

/**
 * Toggle menu search field
 * @returns {undefined}Search menu
 */
$(function () {
    $('a#menu_search_link').on('click', function () {
        if (!$('#menu_search:visible').length) {
            $('#menu_search').show();
            $('#menu_search').focus();
            $('a#menu_search_link').hide();
        }
    });
});

/*
 * Notifications
 *
 */
//window.addEventListener('load', function () {
//    Notification.requestPermission(function (status) {
//        // Cela permet d'utiliser Notification.permission avec Chrome/Safari
//        if (Notification.permission !== status) {
//            Notification.permission = status;
//        }
//    });
//});
//
//function showNotifications() {
//    return;
//    $.get('/api/js-notifications')
//            .done(function (json) {
//                json.forEach(function (e) {
//                    if (e.number) {
//                        var img = '/img/' + e.icon.replace(' ', '_') + '.png';
//                        var text = e.title + ': ' + e.number;
//                        var url = e.url;
//                        var n = new Notification('CAPEX', {body: text, icon: img, url: e.url});
//                        n.onclick = function (e) {
//                            location.href = url;
//                            e.close();
//                        };
//                    }
//                });
//            });
//}
//
//
//$(function () {
//    setInterval(function () {
//        showNotifications();
//    }, 60000);
//});


/*
 * Menus & submenus display
 */
function marginArticle() {
    $('.submenu a.nav-item').each(function () {
        $(this).html($(this).text().replace(' ', '&nbsp;'));
        $(this).css('width', $(this).outerWidth() + 'px');
    });

    if ($(window).width() > 845) {
        var zindex = 99;
        var h = 20;
        if ($('nav').length)
            h += $('nav').height();
        var width = 0;
        if (0) { //(not used anymore, but maybe one day...)
            //if ($('li.nav-item.active').length > 0) {
            width = $('li.nav-item.active').outerWidth();
            var left = Math.round($('li.nav-item.active').offset().left) + 20;
            $('.nav-item.active').each(function () {
                if ($(this).outerWidth() > width) {
                    width = $(this).outerWidth();
                }
            });
            $('.nav-item.active').css('width', width);

            $('div.submenu').each(function () {

                $(this).css('top', (h - 20) + 'px');
                $(this).css('z-index', zindex);
                zindex--;
                h += $(this).outerHeight();
                //centering submenu elements
                if ($(this).find('a.nav-item.active').length > 0) {
                    var l = 0;
                    $(this).find('a.nav-item').css('position', 'absolute');
                    $(this).find('a.nav-item.active').each(function () {
                        $(this).css('left', left + 'px');
                        l = left + $(this).outerWidth();
                    });

                }
            });
            $('div.submenu').each(function () {
                //All previous
                var opacity = 1;
                if ($(this).find('a.nav-item.active').length > 0) {
                    l = left;
                    $(this).find('a.nav-item.active').prevAll().each(function () {
                        $(this).css('left', (l - $(this).outerWidth()) + 'px');
                        $(this).css('opacity', opacity);
                        l = l - $(this).outerWidth();
                        opacity *= 0.7;
                    });
                }
                //All next
                opacity = 1;
                if ($(this).find('a.nav-item.active').length > 0) {
                    l = left + width;
                    $(this).find('a.nav-item.active').nextAll().each(function () {
                        $(this).css('left', l + 'px');
                        $(this).css('opacity', opacity);
                        l = l + $(this).outerWidth();
                        opacity *= 0.7;
                    });
                }
            });
        }

        $('div.submenu').each(function () {
            $(this).css('top', (h - 20) + 'px');
            h += $(this).outerHeight();
        });
        $('article').attr('style', 'margin-top:' + h + 'px !important');
    } else {
        $('.submenu a').removeAttr('style');
        $('article').removeAttr('style');
    }
}

/**
 * initializing default parameters
 * @returns nothing
 */

$(function () {


    marginArticle();
    marginArticle();

    $(window).on('resize', function () {
        marginArticle();
    });

    $.notify.defaults({globalPosition: "bottom right", className: 'success'});
    $('input#login').focus();
// Srtable
    if (document.getElementById('html5-sortable')) {
        new Sortable(document.getElementById('html5-sortable'), {
            animation: 150,
            ghostClass: 'blue-background-class',
            onEnd: function (evt) {
                var i = 1;
                $('input.project_priority').each(function () {
                    $(this).val(i);
                    $(this).trigger('change');
                    i++;
                });
            }
        });
    }

    var cl = 'fadeIn';
    $('li.nav-item').hover(
            function () {
                $(this).addClass(cl);
            },
            function () {
                $(this).removeClass(cl);
            }
    );
    $('[data-toggle="tooltip"]').tooltip();
    $('textarea:not(.noEditor').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['forecolor']],
            ['para', ['ul', 'ol']]
        ]
    });
    /*
     * Modal window for confirmation
     * @param {type} callback
     * @returns {undefined}
     */
    var modalConfirm = function (callback) {

        $("a.confirmAction").on("click", function () {
            $("#modal-btn-yes").attr('data-id', $(this).attr('id'));
            $("#myModalLabel").html($(this).attr('title') + '?');
            $("#mi-modal").modal('show');
        });
        $("#modal-btn-yes").on("click", function () {
            callback($("#modal-btn-yes").attr('data-id'));
            $("#mi-modal").modal('hide');
        });
        $("#modal-btn-no").on("click", function () {
            callback(false);
            $("#mi-modal").modal('hide');
        });
    };
    modalConfirm(function (id) {
        if (id) {
            $('#' + id).closest('form').submit();
        }
    });
    /*
     * Modal loading
     * @returns {undefined}
     */
    $('form').submit(function () {
        $("#loadMe").modal({
            backdrop: "static", //remove ability to close modal with click
            keyboard: true, //remove option to close with keyboard
            show: true //Display loader!
        });
    });
//    $('a:not(.no-event):not([target])').on('click', function () {
//        $("#avoidClick").modal({backdrop: "static"});
//    });
    /*
     * Filterings
     */

    $('select.select-filter').on('change', function () {

        var filter = '';
        $('select.select-filter').each(function () {
            var name = $(this).attr('name');
            var v = $(this).val();
            if (v && v != 0) {
                filter += '[data-' + name + '=' + v + ']';
            }
        });
        if (filter) {
            $('tbody').hide();
        }
        $('tbody' + filter).show();
        reColorizeTable();
    });
    $('select.select-filter').trigger('change');

    /**
     * Update CSS for percent values
     */
    $('input[type="range"].pc100').on('input change', function () {
        $(this).next('label').text($(this).val() + '%');
        pc100();
    });

    /**
     * Update visible tags according to selected value
     */
    $('select[data-event]').on('change', function () {
        /**
         * Data Visible-If
         */
        var fields = $('*[data-visibleif^="' + $(this).attr('data-event') + '|"]');
        if (fields.prop('tagName') == 'INPUT' || fields.prop('tagName') == 'SELECT') {
            fields.parent().hide();
            fields = $('*[data-visibleif="' + $(this).attr('data-event') + '|' + $(this).val() + '"]');
            fields.parent().show();
        } else {
            fields.hide();
            if ($(this).val() !== '') {
                fields = $('*[data-visibleif="' + $(this).attr('data-event') + '|' + $(this).val() + '"]');
                fields.show();

                fields = $('*[data-visibleif="' + $(this).attr('data-event') + '|' + '"]');
                fields.show();
            }
        }
        /**
         * Data ReadOnly-If
         */
        var fields = $('*[data-readonlyif^="' + $(this).attr('data-event') + '|"]');
    });

    /**
     * Recalculation of sums and percentages
     */
    $('input[class]').on('change', function () {
        recalcFromInput($(this));
    });

    setTimeout(function () {
        var l = $('[data-percentof],[data-sumof]').length;
        if (l > 0 && l < 100) {
            $('input[class]:visible').each(function () {
                recalcFromInput($(this));
            });
        }
    }, 100);

    reColorizeTable();
    pc100();

}
);

function recalcFromInput(input) {
    var classes = input.attr('class').trim().split(' ');

    if ($('[data-percentof]').length) {
        classes.forEach(function (c) {


            /*
             * Data Percent-Of
             * Use: add attr "data-percentof=XXX" on the total field
             *      and a class="XXX" on initial field
             *      and a class="XXX_pc" on percent field (between 0 and 100)
             */
            $('[data-percentof="' + c.replace('_pc', '') + '"]:visible').each(function () {
                var total = 0;
                var c2 = c.replace('_pc', '');
                for (index = 0; index < $('input.' + c).length; index++) {
                    total += (parseFloat(getTagValue('.' + c2 + ':eq(' + index + ')')) * parseFloat(getTagValue('.' + c2 + '_pc:eq(' + index + ')')) / 100);
                }
                if ($(this).prop('tagName') == 'INPUT')
                    $(this).val(total);
                else
                    $(this).text(total.toLocaleString('fr-FR'));
            });
        });

    }
    if ($('[data-sumof]').length) {
        classes.forEach(function (c) {

            /*
             * Data Sum-Of
             * Use: add attr "data-sumof=XXX" on the sum field
             *      and a class="XXX" on fields to sum
             */
            $('[data-sumof="' + c + '"]:visible').each(function () {
                var c = $(this).attr('data-sumof');
                var sum = 0;
                $('input.' + c).each(function () {
                    sum += parseFloat($(this).val());
                });
                setTagValue(this, sum);
            });


        });

    }

}

/**
 * Returns tag content or input value
 * @param string tag
 * @returns value
 */
function getTagValue(tag) {
    if ($(tag).prop('tagName') == 'INPUT')
        return $(tag).val();
    else
        return $(tag).text();
}
/**
 * Sets tag content or input value
 * @param string tag
 * @returns value
 */
function setTagValue(tag, value) {
    if ($(tag).prop('tagName') == 'INPUT')
        return $(tag).val(value);
    else
        return $(tag).text(value);
}

function pc100() {

    var sum = 0;
    $('#pc100sum').removeClass('standard-green');
    $('#pc100sum').removeClass('standard-orange');
    $('#pc100sum').removeClass('standard-red');
    $('input[type=range].pc100:visible').each(function () {
        sum += parseFloat($(this).val());
    });
    $('#pc100sum').val(sum);
    if (sum < 100) {
        $('#pc100sum').addClass('standard-orange');
    } else if (sum > 100) {
        $('#pc100sum').addClass('standard-red');
    } else {
        $('#pc100sum').addClass('standard-green');
    }
}

/**
 * Sort select field
 * @param {select input} selElem
 * @returns nothing
 */
function sortSelect(selElem) {
    var tmpAry = new Array();
    for (var i = 0; i < selElem.options.length; i++) {
        tmpAry[i] = new Array();
        tmpAry[i][0] = selElem.options[i].text + ' ';
        tmpAry[i][1] = selElem.options[i].value;
    }
    tmpAry.sort();
    while (selElem.options.length > 0) {
        selElem.options[0] = null;
    }
    for (var i = 0; i < tmpAry.length; i++) {
        var op = new Option(tmpAry[i][0], tmpAry[i][1]);
        selElem.options[i] = op;
    }
    return;
}

/*
 * Ajax save 1 field, with prompt
 * @returns {undefined}
 */
function setOneField(entity, id, field) {
    var value = prompt('Set a value for ' + field + ':');
    if (!value)
        return;
    $.get('/api/save/' + entity + '/' + id + '/' + field + '/' + value);
    $('#' + entity + '_' + id + '_' + field).text(value);
    $.notify(field + " set to '" + value + "'.");
}

/*
 * ReColorize Tables on filter appliance
 */
function reColorizeTable() {
    setTimeout(function () {
        $('table:not(.no-filtering)').each(function () {
            var i = 0;
            $(this).find('tbody:visible').each(function () {
                $(this).removeClass('standard-bg-white');
                $(this).removeClass('standard-bg-lightgrey');
                if (i % 2) {
                    $(this).addClass('standard-bg-lightgrey');
                    $(this).addClass('standard-black');
                } else {
                    $(this).addClass('standard-bg-white');
                    $(this).addClass('standard-black');
                }
                i++;
            });
        });
    }, 100);
}


/**
 * Create unique ID
 * @param (integer) length
 * @returns (string) Unique ID
 */
function makeid(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

/**
 * Save specific property
 * Switch editable field
 */

function rollbackValue(link) {
    var input = $(link).next();
    var rollback = input.attr('data-rollback');
    if (rollback) {
        input.val(rollback);
        if (!input.val() && input.find('option').length) {
            input.val(input.find('option:contains("' + rollback + '")').attr('value'));
        }
        input.trigger('change');
    }
}
$(function () {

    $('span.editable-value > a').on('click', function () {
        var value = $(this).parent();
        var field = $(this).parent().next();
        value.hide();
        field.show();
        field.find('input, select').focus();
    });
    $('span.editable-field > a').on('click', function () {
        var value = $(this).parent().prev();
        var field = $(this).parent();
        value.show();
        field.hide();
    });

//    $('select[data-rollback]').each(function () {
//        var rollback = $(this).attr('data-rollback');
//        $(this).find('option[selected]').removeAttr('selected');
//        $(this).find('option[value=' + rollback + '], option:contains("' + rollback + ")").attr('selected', 'selected');
//    });



    $('div.note-editable').on('DOMSubtreeModified', function () {
        var html = $(this).html();
        $(this).closest('div.note-editor').prev('textarea').val(html);
    });
    $('div.note-editable').on('blur', function () {
        $(this).closest('div.note-editor').prev('textarea').trigger('change');
    });

    $(function () {
        $('select[value]').each(function () {
            var v = $(this).attr('value');
            $(this).find('option[selected]').removeAttr('selected');
            if (v)
                $(this).find('option:contains("' + v + '")').attr('selected', 'selected');
        });
    });

    $('input[data-field], select[data-field], textarea[data-field], div.note-editable').on('change', function () {
        console.log('data-field');

        var input = $(this);
//        if (input.has('.note-editable')) {
//            console.log(input.attr('data-id'));
//            input = input.closest('div.note-editor.note-frame').prev('textarea');
//            console.log(input.attr('data-id'));
//        }
//        console.log(parseInt(input.attr('data-id')));
        if (!parseInt(input.attr('data-id')))
            return;

        var value = input.val();


        if (input.is(':checkbox') && input.prop('checked')) {
            value = 1;
        }
        if (input.is(':checkbox') && !input.prop('checked')) {
            value = 0;
        }

        console.log(value);
        if (!value && value !== 0)
            value = '[null]';

        console.log(btoa(value));

        var position = "right bottom";
        if (input.offset().left > $(window).width() / 2)
            position = "left bottom";
        if (input.width() / $(window).width() > 0.8)
            position = "bottom";

        position = "left bottom";

        var t = input.attr('data-field').split('.');
        input.prev('a').remove();
        $.ajax({
            type: 'GET',
            url: '/api/save/' + t[0] + '/' + input.attr('data-id') + '/' + t[1] + '/' + btoa(value),
//            data: {
//                field: input.attr('data-field'),
//                id: input.attr('data-id'),
//                value: value
//            },
            async: false
        }
        ).done(function (e) {

            if (typeof e == 'string') {
                $.notify('You\'re logged out, please refresh pasge to authentify. Changes have not been applied.', {position: 'left bottom', className: 'error'});
                return;
            }
            $.notify(e.message, e.status);

            console.log(e.status);

            var rollback = input.attr('data-rollback');
            input.css('width', '');
            if (e.status == 'success' && ((input.find('option').length == 0 && input.val() != rollback) || input.find('option[value=' + value + ']').text().trim() != rollback)) {
                input.before('<a href="javascript:void(0);" onclick="rollbackValue(this)"><i class="fas fa-undo-alt"></i></a> ');
                input.css('width', (input.outerWidth() - 24) + 'px');
            }

            if (input.next('a'))
                input.next('a').trigger('click');
            if (input.parent().prev('span.editable-value')) {
                input.parent().prev('span.editable-value').find('span').text(input.val());
                if (parseInt(input.val()) && input.find('option[value=' + input.val() + ']').length)
                    input.parent().prev('span.editable-value').find('span').text(input.find('option[value=' + input.val() + ']').text());

            }
        }).fail(function () {
            $.notify('Value [' + value + '] not saved.', {position: position, className: 'error'});
        });
    }
    );
});

/**
 * Color for 100%
 */
$(function () {
    $('body').on('DOMSubtreeModified', '.valid-if-100', function () {
        setValidIf100($(this));
    });

    $('.valid-if-100:visible').each(function () {
        setValidIf100($(this));
    });
});

function setValidIf100(input) {
    input.removeClass('standard-green');
    input.removeClass('standard-red');
    input.removeClass('standard-orange');
    if (getTagValue(input) == 100) {
        input.addClass('standard-green');
    } else {
        input.addClass('standard-red');
    }
}

/**
 * Export table as Excel
 */
$(function () {
    $('article table.allow-export').each(function () {
        $(this).closest('table').after('<form method="post" action="/export-excel">' +
                '<input type="hidden" name="html" value=""/>' +
                '<input type="hidden" name="title" value=""/>' +
                '<a class="table-export-excel" href="javascript:void(0);"><i class="small fas fa-file-excel standard-grey standard-hover-red"></i></a>' +
                '</form>');
    });

    $('a.table-export-excel').on('click', function () {
        console.log('Export Excel');
        var form = $(this).parent();
        var table = form.prev('table');
        form.find('[name="html"]').val(table[0].outerHTML);
        form.find('[name="title"]').val($('title').text().trim());
        form.submit();
    });
});
