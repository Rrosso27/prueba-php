$(document).ready(function () {
    $('#productForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append("action", "store");
        $.ajax({
            url: "router/api.php?action=addProduct",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (typeof response === 'string') {
                    response = JSON.parse(response);
                }
                if (response.status === "success") {
                    window.location.href = 'index.php?view=products';
                } else {
                    $('#error-message').html('<div class="alert alert-danger">' + response.message + '</div>');

                    setTimeout(function () {
                        $('#error-message').fadeOut('slow', function () {
                            $(this).html('').show();
                        });
                    }, 5000);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                $('#error-message').html('<div class="alert alert-danger">Error al guardar el grupo</div>');
            }
        });

    });
});