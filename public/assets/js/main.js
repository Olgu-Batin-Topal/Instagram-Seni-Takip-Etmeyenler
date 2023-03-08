$(document).ready(function () {

    $('#file').change(function () {
        $.ajax({
            url: 'data/uploads.php',
            type: 'POST',
            data: new FormData($('#uploadForm')[0]),
            contentType: false,
            cache: false,
            processData: false,
            enytpe: 'multipart/form-data',
            success: function (data) {
                $('#uploadForm')[0].reset();
                let msg = JSON.parse(data);

                new swal({
                    title: msg.title,
                    text: msg.text,
                    icon: msg.icon
                });

                if (msg.icon == 'success') {
                    $('#progressBar').val(33);
                    $('#file').remove();

                    $.ajax({
                        url: 'data/extracts.php',
                        type: 'POST',
                        data: {
                            extract: 'extract'
                        },
                        success: function (data) {
                            let msg = JSON.parse(data);

                            new swal({
                                title: msg.title,
                                text: msg.text,
                                icon: msg.icon
                            });

                            if (msg.icon == 'success') {
                                $('#progressBar').val(66);
                                $.ajax({
                                    url: 'api/unfollowing.php',
                                    type: 'POST',
                                    data: {
                                        unfollowing: 'start'
                                    },
                                    success: function (data) {
                                        console.log(data);
                                        let msg = JSON.parse(data);

                                        new swal({
                                            title: msg.title,
                                            text: msg.text,
                                            icon: msg.icon
                                        });

                                        if (msg.icon == 'success') {
                                            $('#progressBar').val(100);

                                            setTimeout(function () {
                                                location.reload();
                                            }, 1000);
                                        }
                                    }
                                });
                            }
                        }
                    });
                }
            }
        });
    });

});