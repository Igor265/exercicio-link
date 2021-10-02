<?php
$url = "https://apiintranet.kryptonbpo.com.br/test-dev/exercise-1";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = json_decode(curl_exec($ch), true);
curl_close($ch);

$response = (object) $response;

$cars = $response->carros;
$motores = $response->motores;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <table id="cars" class="table table-striped table-bordered">
        <thead class="bg-success text-white">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Cor</th>
                <th>Motor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car) : ?>
                <tr>
                    <td>
                        <?php echo $car['id']; ?>
                    </td>
                    <td>
                        <?php echo $car['marca']; ?>

                    </td>
                    <td>
                        <?php echo $car['modelo']; ?>
                    </td>
                    <td>
                        <?php echo $car['cor']; ?>
                    </td>
                    <td class="text-center">
                        <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $car['motor_id']; ?>">
                            <i class="la la-plus-circle"></i>
                        </a>
                        <a type="button" class="btn btn-sm btn-danger remover">
                            <i class="la la-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <td class="text-center" colspan="5">
                <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModa2" data-whatever="@mdo">
                    Adicionar veiculo
                </a>
            </td>
        </tfoot>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Caracteristicas do motor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModa2" tabindex="-1" role="dialog" aria-labelledby="exampleModa2Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModa2Label">Novo veiculo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Marca:</label>
                            <input type="text" class="form-control" id="marca">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Modelo:</label>
                            <input type="text" class="form-control" id="modelo">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Cor:</label>
                            <input type="text" class="form-control" id="cor">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Motor_id:</label>
                            <input type="text" class="form-control" id="motor_id">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="salvar">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script>
    var motores = <?php echo json_encode($motores) ?>;
    $('#exampleModal').on('shown.bs.modal', function(e) {
        var motorId = $(e.relatedTarget).data('id');
        console.log(motorId);
        $.each(motores, function(index, value) {
            if (motorId == value.id) {
                $('#exampleModal .modal-body').html('<b>Posição dos cilindros: </b>' + value.posicionamento_cilindros + '<br><b>Quantidade de cilindros: </b>' + value.cilindros + '<br><b>Litragem: </b>' + value.litragem + '<br><b>Observações: </b>' + value.observacao);
            }
        });
    })

    $('body').on('click', '.remover', function() {
        $(this).closest('tr').remove();
    });

    $('#salvar').on('click', function() {
        $("#cars").find('tbody')
            .append('<tr><td>' + 1 + '</td><td>' + $('#marca').val() + '</td><td>' + $('#modelo').val() + '</td><td>' + $('#cor').val() + '</td>' + '<td class="text-center">' +
                '<a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" data-id="' + $('#motor_id').val() + '">' +
                '<i class="la la-plus-circle"></i>' +
                '</a>' +
                '<a type="button" class="btn btn-sm btn-danger remover">' +
                '<i class="la la-trash"></i>' +
                '</a>' +
                '</td>');
        $('#exampleModa2').modal('hide');
    });
</script>

</html>