<?php

$caracteres = [
    "ABCDEFGHJKMNPQRSTUVWXYZ",
    "abcdefghjkmnpqrstuvwxyz",
    "23456456789",
    "+-.,;=_",
];

if (isset($_POST['submit'])) {
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
}

$largoSolicitado = "";
if (isset($largo)) {$largoSolicitado = "(" . $largo . ")";};
echo "<h1>Generar contraseña" . $largoSolicitado . "</h1>";

echo "<p>Patrón:<br>
            Mayúsculas: " . $caracteres[0] . "<br>
            Minúsculas: " . $caracteres[1] . "<br>
            Números: " . $caracteres[2] . "<br>
            Símbolos: " . $caracteres[3] . "<br><br>
    ";

if (isset($largo)) {
    echo "<h2>" . genera($largo, $caracteres) . "</h2>";
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <input type="number" name="largo" min="5" max="20" style="width: 180;" required placeholder="Largo de la contraseña">
   <input type="submit" name="submit" value="Genera">
</form>