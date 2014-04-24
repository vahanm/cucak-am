$(document).ready(function () {
    $('#contactText, #contactName, #contactEmail').on('change, keypress', function () {
        $('.errorHint').hide();
    });

    $('#sendButton').click(function () {
    	var userId = $('#contactId').val();
    	var name = $('#contactName').val();
        var email = $('#contactEmail').val();
        var text = $('#contactText').val();

        if (name.trim().length < 2) {
            $('#errorName').show();
            return;
        } else {
            $('#errorName').hide();
        }

        if (email.trim().length < 6 || email.indexOf('@') < 0 || email.indexOf('.') < 0 || email.indexOf(' ') > -1) {
            $('#errorEmail').show();
            return;
        } else {
            $('#errorEmail').hide();
        }

        if (text.trim().length < 10) {
            $('#errorText').show();
            return;
        } else {
            $('#errorText').hide();
        }

        $.ajax({
            type: 'GET',
            url: '/contacts/send_email.php',
            dataType: 'html',
            data: { userId: userId, name: name, email: email, text: text },
            success: function (data) {
                if (data.indexOf('true') > -1) {
                    $('#errorSent').show();
                    $('#errorNotSent').hide();
                    $('#errorServer').hide();

                    $('#contactText').text('');
                } else if (data.indexOf('false') > -1) {
                    $('#errorSent').hide();
                    $('#errorNotSent').show();
                    $('#errorServer').hide();
                } else {
                    $('#errorSent').hide();
                    $('#errorNotSent').hide();
                    $('#errorServer').show();
                }
            },
            fail: function () {
                $('#errorSent').hide();
                $('#errorNotSent').hide();
                $('#errorServer').show();
            }
        });
    });
});
