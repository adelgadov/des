<?php
include "paso1.php";
include "paso2.php";

$password = "0123456789ABCDEF";
$texto = "FEDCBA9876543210";

$clave = new paso1();
$k = $clave -> heca_binario($password);
$password_binario = $clave ->pc1();

$mensaje = new paso2();
$mensaje_binario = $mensaje ->binary($texto);


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cifrado con Des</title>
</head>
<body>
<h1>Paso 1</h1>
<?php
    print_r("K = ".$clave -> getK());
    echo "<br>";

    print_r("K+ = ".$clave -> getKMas());
    echo "<br>";
    echo "<br>";



    echo "<br>";
?>
<table>
<?php
    for ($i = 0; $i <= 16; $i++) {
        echo "<tr>";
        echo "<td>C<sub>".$i."</sub> = ".$clave -> getCMas()["c".$i]."</td>";
        echo "<td>D<sub>".$i."</sub> = ".$clave -> getDMas()["d".$i]."</td>";
        echo "</tr>";
    }
    ?>

</table>
<br>
<table>
    <?php
    for ($i = 0; $i <= 16; $i++) {
        echo "<tr>";
        echo "<td>Ki<sub>".$i."</sub> = ".$clave -> getKiArray()["ki".$i]."</td>";

        echo "</tr>";
    }
    ?>

</table>
<h1>Paso 2</h1>
<?php
print_r("M = ".$mensaje -> getM());
echo "<br>";
print_r("IP = ".$mensaje -> getIp());
echo "<br>";
print_r("L = ".$mensaje -> getL());
echo "<br>";
print_r("R = ".$mensaje -> getR());
echo "<br>";
echo "<br>";
echo "<br>";

for ($i = 0;$i <= 16;$i++) {
    echo "R<sub>".$i."</sub> = ".$mensaje -> getRArray()[$i]."<br>";
}
$xor = $mensaje -> xorf($clave -> getKiArray());
echo "<br>";
echo "<br>";
for ($i = 0;$i <= 16;$i++) {
    echo "KiR<sub>".$i."</sub> = ".$mensaje -> getRArray()[$i]."<br>";
}
?>
</body>
</html>
