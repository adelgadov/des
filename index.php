<?php
include "clases.php";

$conversion = new clases();
$k = $conversion -> heca_binario("0123456789ABCDEF");
$contar = $conversion ->pc1();


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cifrado con Des</title>
</head>
<body>
<?php print_r("K = ".$conversion -> getK());
echo "<br>";

print_r("K+ = ".$conversion -> getKMas()); ?>

</body>
</html>
