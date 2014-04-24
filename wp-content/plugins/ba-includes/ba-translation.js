function tranpopup(id, e) {
    var trans = prompt('Translation for: ' + $(e).parent().text(), '');
    var url = 'http://ads.parap.am/wp-admin/admin.php?page=ba-includes/ba-translation.php';

    //alert('ID = ' + id);
    if (trans) {
        $.ajax({
            type: 'POST',
            url: url,
            data: { updateById: id, text: trans }
        });
    }
}

function trankey(id, key, e, r, a) {
    var trans = prompt('Translation for: ' + $(e).parent().text(), '');
    var url = 'http://ads.parap.am/wp-admin/admin.php?page=ba-includes/ba-translation.php';

    //alert('ID = ' + id);
    if (trans) {
        $.ajax({
            type: 'POST',
            url: url,
            data: { updateById: id, text: trans }
        });
    }
}


function trankey(id, key, e, r, a) {
    var trans = prompt('Translation for: ' + $(e).parent().text(), '');
    var url = 'http://ads.parap.am/wp-admin/admin.php?page=ba-includes/ba-translation.php';

    if (trans) {
        $.ajax({
            type: 'POST',
            url: url,
            data: { updateById: id, text: trans }
        });
    }
}

function SubmitInIFrame(e) {
    var url = 'http://ads.parap.am/wp-admin/admin.php?page=ba-includes/ba-translation.php';
    var form = jQuery('#' + e)[0];

    jQuery.ajax({
            type: 'POST',
            url: url,
            data: { exit: 1, update: 'update', input_key: form.input_key, input_id: form.input_id, input_key: form.input_key, input_en_EN: form.input_en_EN, input_ru_RU: form.input_ru_RU, input_am_HY: form.input_am_HY }
        });

}