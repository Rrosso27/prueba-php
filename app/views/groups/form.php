<?php
require_once BASE_PATH . "app/views/layout/header.php";
require_once BASE_PATH . "app/views/layout/navbar.php";
?>
<div class="container mt-4">

    <h2 id="formTitle">Agregar Grupo</h2>
    <div id="error-message"></div>

    <form id="groupForm">
        <input type="hidden" id="groupId">
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre">
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#groupForm').submit(function (e) {


            e.preventDefault();

            let formData = new FormData(this);
            formData.append("action", "store");

            $.ajax({
                url: "app/api.php?action=addGroup",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    data = JSON.parse(response);
                    if (data.status === "success") {
                        window.location.href = 'index.php?view=products';
                    } else {
                        $('#error-message').html('<div class="alert alert-danger">' + data.message + '</div>');

                        setTimeout(function () {
                            $('#error-message').fadeOut('slow', function () {
                                $(this).html('').show();
                            });
                        }, 5000);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error en AJAX:", xhr.responseText);
                    alert('Error en la solicitud AJAX');
                }
            });

        });
    });
</script>

<?php include BASE_PATH . "app/views/layout/footer.php"; ?>