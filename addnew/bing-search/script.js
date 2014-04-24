var response = { error: { code: 0, errors: [], message: '' } };
var item = { link: '' };

function hndlr(response) {
    var content = document.getElementById("content");
    content.innerHTML = '';

    if (response.error && response.error.code > 0) {
        content.innerHTML = '<p class="error">' + response.error.message + '</p>';
    } else {
        if (response.searchInformation && response.searchInformation.totalResults > 0) {
            for (var i = 0; i < response.items.length; i++) {
                var item = response.items[i];

                if (item.link.indexOf('youtube') < 0 || item.link.indexOf('watch') < 0)
                    continue;

                // in production code, item.htmlTitle should have the HTML entities escaped.
                document.getElementById("content").innerHTML += '<div class="article" link="' + item.link + '" text="' + item.title + '"><h2 class="title">' + item.htmlTitle + '</h2><p class="description">' + item.htmlSnippet + '</p></article>';
            }
        } else {
            content.innerHTML = '<p class="info">Not found</p>';
        }
    }

    $('.article').click(function () {
        var link = $(this).attr('link');
        var text = $(this).attr('text');

        //alert(link);
        var cont = $('#post_content', parent.document);
        
        //$('<a/>').text(text).attr('href', link)

        cont.val(cont.val() + "\n\n**************************************\n" + text + "\n--------------------------------\n" + link + "\n**************************************\n");
    });
}
