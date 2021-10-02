<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    
    $caminho = './atividades.json';
    $conteudo = file_get_contents($caminho);

    $json = json_decode($conteudo, true);


    $page = 0;
    if (isset($_REQUEST['page']))
        $page = $_REQUEST['page'] * 5;

    echo json_encode(array_splice($json, $page, 5));

?>