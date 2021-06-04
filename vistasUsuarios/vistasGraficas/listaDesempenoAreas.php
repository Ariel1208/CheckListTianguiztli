<?php

session_start();
require_once "../../clases/conexion.php";


$c = new conectar();
$conexion = $c->conexion();

$sql = "SELECT c.sector, avg(a.calificacion) AS calificacion FROM reporte a INNER JOIN plantilla b ON a.id_plantilla = b.id_plantilla INNER JOIN sectores c ON b.id_sector=c.id_sector GROUP BY c.sector";

$result = mysqli_query($conexion, $sql);

$colores = [
    "primary",
    "secondary",
    "info",
    "warning",
    "dark",
    "danger"
];

?>

<ul class="list-group list-group-flush">
    <?php

    while ($mostrar = mysqli_fetch_array($result)) {
        $val = $mostrar['calificacion'] * 2 * 10;
        $cal = $mostrar['calificacion'] * 2;


        if ($cal < 4) {
            $i = 5;
        } else if ($cal >= 4 && $cal < 9) {
            $i = 3;
        } else if ($cal >= 9) {
            $i = 2;
        };

    ?>
        <li class="list-group-item">
            <?php echo $mostrar['sector'] ?>
            <p>Promedio de desempeño: <?php echo $cal ?></p>

            <div class="progress">
                <div class="progress-bar progress-bar-striped <?php echo "bg-" . $colores[$i] ?>" role=" progressbar" style="width: <?php echo $val ?>%; color:black" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> </div>
            </div>
        </li>
    <?php

    }
    ?>

</ul>