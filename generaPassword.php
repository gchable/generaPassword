<?php


if (!empty($_POST['largo'])) {

    $caracteres = [
        "ABCDEFGHJKMNPQRSTUVWXYZ",
        "abcdefghjkmnpqrstuvwxyz",
        "23456456789",
        "+-.*,/;=_",
    ];

    $largo = $_POST['largo'];

    function genera($largo, $caracteres)
    {
        $contador = 0;
        $pass = "";

        for ($i = 1; $i <= $largo; $i++) {
            if ($contador == count($caracteres)) {
                $contador = 0;
            }
            $aleatorio = rand(0, strlen($caracteres[$contador]) - 1);
            $pass .= $caracteres[$contador][$aleatorio];
            $contador++;
        }
        return str_shuffle($pass);
    }
    
    $pass = genera($largo, $caracteres);
    echo json_encode("
        <div class='col s12 m6 section'>
            {$pass}
        </div>
    ");
}
