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
                                $.ajax({
                                    url: 'api/unfollowing.php',
                                    type: 'POST',
                                    data: {
                                        unfollowing: 'start'
                                    },
                                    success: function (data) {
                                        let msg = JSON.parse(data);

                                        new swal({
                                            title: msg.title,
                                            text: msg.text,
                                            icon: msg.icon
                                        });

                                        if (msg.icon == 'success') {
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
            },
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var pct = evt.loaded / evt.total;

                        $("#progressBar").val(pct * 100);
                    }
                }, false);

                xhr.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var pct = evt.loaded / evt.total;

                        $("#progressBar").val(pct * 100);
                        if (pct === 1) {
                            $('#progressBar').addClass('hide');
                        }
                    }
                }, false);
                return xhr;
            },
        });
    });

});