<?php
error_reporting(0);
date_default_timezone_set("America/Mexico_City");

header('Access-Control-Allow-Origin: *');
ini_set('max_execution_time', 600);
ini_set('memory_limit', '256M'); //mover los megas en medida que sea necesario

include_once("../lib/utils.php");
require_once "../application/Model.php";

$model = new Model();
$action = $_POST['action'];
$model->execute("SET NAMES 'UTF8'");

switch ($action) {
	case 'login':
		$user = $_POST['user'];
		$password = $_POST['password'];

		$model->execute("SELECT count(*) as cantidad FROM usuario WHERE correo='$user'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {

			$model->execute("SELECT count(*) as cantidad FROM usuario WHERE correo='$user' and contrasena ='$password'");
			$cantidad2 = $model->fetch();
			if ($cantidad2['cantidad'] == "0") {
				echo 2;
			} else {
				$model->execute("SELECT * FROM usuario WHERE correo = '$user' AND contrasena = '$password'");
				$userA = $model->fetch();

				$ID_US = $userA['id_usuario'];



				ini_set('session.cookie_domain', '.tianguiztli.com');

				session_start();
				$_SESSION['ID_US'] = $userA['id_usuario'];
				$_SESSION['ROL'] = $userA['id_rol'];

				$model->execute("SELECT * FROM lista_servicio_cocina WHERE correo = '$user'");
				$user2 = $model->fetch();

				$_SESSION['ID_CO'] = $user2['id_usuario'];
				echo json_encode($userA);
				die();
			}
		} else if ($cantidad['cantidad'] == "0") {
			echo  1;
		}
		break;
	case 'salir':
		session_start();
		session_destroy();

		echo 1;

		break;
	case 'agregarUsuario':
		$nombre = $_POST['nombre'];
		$area = $_POST['area'];
		$correo = $_POST['correo'];
		$pass = $_POST['pass'];
		$tipo = 2;

		$model->execute("SELECT count(*) as cantidad FROM t_usuario WHERE email='$correo'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 0;
		} else {
			$model->execute("INSERT INTO t_usuario (nombre, email, pass, id_area,id_tipo) VALUES ('$nombre', '$correo', '$pass', '$area', '$tipo')");

			echo 1;
		}
		break;
	case 'obtenerDatosUsuario':
		$id = $_POST['id'];

		$model->execute("SELECT* FROM usuario WHERE id_usuario = '$id'");
		$user = $model->fetch();

		echo json_encode($user);
		die();
		break;
	case 'editarUsuario':
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$area = $_POST['area'];
		$correo = $_POST['correo'];
		$pass = $_POST['pass'];

		$model->execute("SELECT count(*) as cantidad FROM t_usuario WHERE email='$correo' and id_usuario != '$id'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 0;
		} else if ($cantidad['cantidad'] == 0) {
			$model->execute("UPDATE t_usuario SET nombre = '$nombre', id_area='$area', email='$correo', pass='$pass' WHERE id_usuario='$id'");
			echo 1;
		}
		break;
	case 'eliminarUsuario':
		$respuesta = $model->execute("DELETE FROM usuario  WHERE id_usuario='$id'");
		echo $respuesta;
		break;
	case 'agregarSector':
		$nombre = $_POST['nombre'];

		$model->execute("SELECT count(*) as cantidad FROM sectores WHERE sector='$nombre'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 0;
		} else {
			$model->execute("INSERT INTO sectores (sector) VALUES ('$nombre')");
			echo 1;
		}
		break;
	case 'obtenerInfoSector':
		$id = $_POST['id'];

		$model->execute("SELECT* FROM sectores WHERE id_sector = '$id'");
		$user = $model->fetch();

		echo json_encode($user);
		die();
		break;
	case 'editarSector':
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];

		$model->execute("SELECT count(*) as cantidad FROM sectores WHERE sector='$nombre' and id_sector != '$id'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 0;
			print_r($_POST);
		} else if ($cantidad['cantidad'] == 0) {
			$model->execute("UPDATE sectores SET sector = '$nombre' WHERE id_sector='$id'");
			echo 1;
		}
		break;
	case 'eliminarSector':
		$id = $_POST['id'];

		$model->execute("SELECT count(*) as cantidad FROM plantilla WHERE id_sector='$id'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 0;
		} else if ($cantidad['cantidad'] == 0) {
			$respuesta = $model->execute("DELETE FROM sectores WHERE id_sector='$id'");
			echo 1;
		} else {
			print_r($cantidad);
		}

		break;
	case 'cosultarActividades':
		$id = $_POST['id'];

		$model->execute("SELECT* FROM detalle_plantilla WHERE id_plantilla = '$id'");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;
	case 'obtenerInfoPlantilla':
		$id = $_POST['id'];

		$model->execute("SELECT* FROM plantilla WHERE id_plantilla = '$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'eliminarPlantilla':
		$id = $_POST['id'];

		$model->execute("DELETE FROM detalle_plantilla WHERE id_plantilla = '$id'");
		$model->execute("DELETE FROM plantilla WHERE id_plantilla = '$id'");

		echo 1;
		break;
	case 'cosultarActividadesReporte':
		$id = $_POST['id'];

		$model->execute("SELECT* FROM detalle_reporte WHERE id_reporte = '$id'");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;
	case 'obtenerDatosReporte':
		$id = $_POST['id'];

		$model->execute("SELECT a.nombre_responsable, a.id_reporte,c.id_sector,a.nombre_reporte,a.fecha_inicial,a.fecha_final,a.fecha_creacion,a.fecha_limite,a.observaciones FROM reporte a inner join plantilla b on a.id_plantilla=b.id_plantilla inner join sectores c on b.id_sector=c.id_sector WHERE id_reporte = '$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'actualizarReporte':
		$nombre = $_POST['nomRep'];
		$fechI = $_POST['fechInicio'];
		$fechF = $_POST['fecha_final'];
		$fechL = $_POST['fecha_limite'];
		$resp = $_POST['responsable'];
		$id = $_POST['id'];

		$model->execute("UPDATE reporte SET nombre_reporte = '$nombre', nombre_responsable='$resp',fecha_inicial = '$fechI', fecha_final='$fechF', fecha_limite = '$fechL' WHERE id_reporte='$id'");
		echo 1;
		break;
	case 'eliminarReporte':
		$id = $_POST['id'];
		$model->execute("DELETE FROM detalle_reporte WHERE id_reporte='$id'");
		$model->execute("DELETE FROM evidencias_reporte WHERE id_reporte='$id'");
		$model->execute("DELETE FROM reporte WHERE id_reporte='$id'");
		echo 1;
		break;
	case 'obtenerEvidenciasReporte':
		$id = $_POST['id'];

		$model->execute("SELECT* FROM evidencias_reporte WHERE id_reporte = '$id'");
		$consult = $model->fetchAll();

		echo json_encode($consult);
		die();
		break;
	case 'actividadesReporte':
		$id = $_POST['id'];

		$model->execute("SELECT * FROM reporte a inner join detalle_reporte b on a.id_reporte=b.id_reporte where a.id_reporte='$id'");
		$consulta = $model->fetchAll();
		echo json_encode($consulta);
		die();
		break;
	case 'agregarCategoriaInsumos':
		$nombre = $_POST['nombre'];

		$model->execute("SELECT count(*) as cantidad FROM categorias_inventario WHERE categoria='$nombre'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 0;
		} else if ($cantidad['cantidad'] == 0) {
			$model->execute("INSERT INTO categorias_inventario (categoria) values ('$nombre')");
			echo 1;
		}
		break;
	case 'agregarInsumo':
		$nombre = $_POST['nombre'];
		$cantidadP = $_POST['cantidad'];
		$categoria = $_POST['categoria'];

		$model->execute("SELECT count(*) as cantidad FROM inventario_cocina WHERE producto='$nombre'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 0;
		} else if ($cantidad['cantidad'] == 0) {
			$model->execute("INSERT INTO inventario_cocina (producto,cantidad,id_categoria) values ('$nombre','$cantidadP','$categoria')");
			echo 1;
		}
		break;
	case 'obtenerDatosInsumos':
		$id = $_POST['id'];

		$model->execute("SELECT * FROM inventario_cocina WHERE id_producto = '$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'editarInsumo':
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$cantidadP = $_POST['cantidad'];
		$categoria = $_POST['categoria'];


		$model->execute("SELECT count(*) as cantidad FROM inventario_cocina WHERE producto='$nombre' and id_producto != '$id'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 0;
		} else if ($cantidad['cantidad'] == 0) {
			$model->execute("UPDATE inventario_cocina SET producto='$nombre',cantidad='$cantidadP', id_categoria='$categoria' WHERE id_producto='$id'");
			echo 1;
		}
		break;
	case 'eliminarInsumo':
		$id = $_POST['id'];

		$model->execute("DELETE FROM inventario_cocina WHERE id_producto = '$id'");
		echo 1;

		break;
	case 'obtenerDatosCategoria':
		$id = $_POST['id'];

		$model->execute("SELECT * FROM categorias_inventario WHERE id_categoria = '$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'editarCategoriasInsumos':
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];

		$model->execute("SELECT count(*) as cantidad FROM categorias_inventario WHERE categoria='$nombre' and id_categoria !='$id'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 0;
		} else if ($cantidad['cantidad'] == 0) {
			$model->execute("UPDATE categorias_inventario SET categoria='$nombre' WHERE id_categoria='$id'");
			echo 1;
		}
		break;
	case 'eliminarCategoriaInsumo':
		$id = $_POST['id'];

		$model->execute("SELECT count(*) as cantidad FROM inventario_cocina WHERE id_categoria ='$id'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 0;
		} else if ($cantidad['cantidad'] == 0) {
			$model->execute("DELETE FROM categorias_inventario WHERE id_categoria='$id'");
			echo 1;
		}
		break;
	case 'agregarUsuarioscCocina':
		$nombre = $_POST['nombre'];
		$correo = $_POST['correo'];
		$pass = $_POST['pass'];

		$model->execute("SELECT count(*) as cantidad FROM lista_servicio_cocina WHERE correo='$correo' or nombre='$nombre'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 2;
		} else {
			$model->execute("INSERT INTO lista_servicio_cocina (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$pass')");

			echo 1;
		}
		break;
	case 'obtenerDatosUsuarioCocina':
		$id = $_POST['id'];

		$model->execute("SELECT * FROM lista_servicio_cocina WHERE id_usuario = '$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'editarUsuarioscCocina':
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$correo = $_POST['correo'];
		$pass = $_POST['pass'];
		$tipo = $_POST['tipo'];

		$model->execute("SELECT count(*) as cantidad FROM lista_servicio_cocina WHERE correo='$correo' and id_usuario != '$id'");
		$cantidad = $model->fetch();
		if ($cantidad['cantidad'] > 0) {
			echo 2;
		} else {
			$model->execute("UPDATE lista_servicio_cocina SET nombre='$nombre',correo='$correo',contrasena='$pass',id_tipo='$tipo' WHERE id_usuario = '$id'");
			echo 1;
		}
		break;
	case 'eliminarUsuarioscCocina':
		$id = $_POST['id'];
		$model->execute("DELETE FROM seguimiento_pagos  WHERE id_usuario='$id'");
		$model->execute("DELETE FROM lista_servicio_cocina  WHERE id_usuario='$id'");
		echo 1;
		break;
	case 'agregarRegistroPago':
		$id = $_POST['id'];
		$inicial = $_POST['fechaI'];
		$final = $_POST['fechaF'];
		$dias = $_POST['dias'];
		$total = $_POST['total'];

		$model->execute("INSERT INTO seguimiento_pagos (id_usuario,fecha_inicial,fecha_final) VALUES ('$id','$inicial','$final')");
		$model->execute("INSERT INTO historial_pagos_cocina (id_usuario,dias_pagados,fecha_inicial,fecha_final,total) VALUES ('$id','$dias','$inicial','$final','$total')");
		echo 1;

		break;
	case 'agregarRegistroPagoGeneral':
		$array = json_decode($_POST['array']);
		$inicial = $_POST['fechaI'];
		$final = $_POST['fechaF'];
		$dias = $_POST['dias'];
		$total = $_POST['total'];


		for ($i = 0; $i < count($array); $i++) {
			$id= $array[$i];

			$model->execute("INSERT INTO seguimiento_pagos (id_usuario,fecha_inicial,fecha_final) VALUES ('$id','$inicial','$final')");
			$model->execute("INSERT INTO historial_pagos_cocina (id_usuario,dias_pagados,fecha_inicial,fecha_final,total) VALUES ('$id','$dias','$inicial','$final','$total')");
		}

		echo 1;

		break;
	
	case 'obtenerDatosPagos':
		$id = $_POST['id'];

		$model->execute("SELECT * FROM historial_pagos_cocina WHERE id_usuario = '$id'");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;
	case 'obtenerDatosSeguimientoServicio':
		$id = $_POST['id'];

		$model->execute("SELECT * FROM seguimiento_pagos WHERE id_usuario = '$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'crearRegistrosAsistencia':

		$model->execute("SELECT max(fecha) as fecha FROM lista_asistencia_cocina");
		$consulta = $model->fetch();

		$fechaBase = strtotime($consulta['fecha']);

		$model->execute("SELECT date(now()) as fecha");
		$consulta = $model->fetch();

		$fechaHoy = strtotime($consulta['fecha']);

		if ($fechaBase < $fechaHoy) {

			$model->execute("SELECT count(*) as cantidad FROM confirmacion_asistencia WHERE fecha_validacion = date(now())");
			$consulta = $model->fetch();


			if ($consulta['cantidad'] > 0) {
				$model->execute("INSERT INTO lista_asistencia_cocina (id_usuario,fecha) SELECT id_usuario,fecha_validacion FROM confirmacion_asistencia WHERE fecha_validacion = date(now())");
				echo 1;
			} else {
				echo 4;
			}
		} else if ($fechaBase == $fechaHoy) {
			echo 2;
		} else {
			echo 3;
		}
		break;
	case 'marcarAsistenciaUsuario':
		$id = $_POST['id'];

		$model->execute("UPDATE lista_asistencia_cocina SET confirmacion=1 WHERE id_usuario=$id and fecha=date(now())");

		$model->execute("UPDATE seguimiento_pagos SET dias=dias-1 WHERE id_usuario=$id");

		echo 1;
		break;
	case 'GraficaReportesAreas':

		$model->execute("SELECT c.sector, COUNT(a.id_reporte) AS cantidad FROM reporte a INNER JOIN plantilla b ON a.id_plantilla = b.id_plantilla INNER JOIN sectores c ON b.id_sector = c.id_sector GROUP BY c.sector ORDER BY cantidad");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;
	case 'seguimientoReportesInsumos':
		$id = $_POST['id'];
		$model->execute("SELECT* FROM detalle_reporte_insumos WHERE id_reporte='$id'");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;
	case 'obtenerQueja':
		$id = $_POST['id'];
		$model->execute("SELECT* FROM reporte_quejas a inner join area b On a.id_area=b.id_area inner join lista_servicio_cocina c on a.id_usuario=c.id_usuario  WHERE id_reporte='$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'marcarQuejaLeido':
		$id = $_POST['id'];
		$model->execute("UPDATE reporte_quejas SET estatus=1 WHERE id_reporte='$id'");
		echo 1;
		break;
	case 'marcarQuejaInvalido':
		$id = $_POST['id'];
		$model->execute("UPDATE reporte_quejas SET estatus=2 WHERE id_reporte='$id'");
		echo 1;
		break;
	case 'marcarQuejaNoLeido':
		$id = $_POST['id'];
		$model->execute("UPDATE reporte_quejas SET estatus=0 WHERE id_reporte='$id'");
		echo 1;
		break;
	case 'obtenerReportesQuejas':

		$model->execute("SELECT area, COUNT(*) AS CANTIDAD FROM reporte_quejas a INNER JOIN area b ON a.id_area=b.id_area WHERE estatus=1 GROUP BY AREA");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;
	case 'eliminarReportesIrrelevantes':
		$model->execute("DELETE FROM reporte_quejas WHERE status = 2");
		$consulta = $model->fetchAll();

		echo 1;
		break;
	case 'eliminarReporteQueja':
		$id = $_POST['id'];

		$model->execute("DELETE FROM reporte_quejas WHERE id_reporte='$id'");

		echo 1;
		break;
	case 'validacionModalFechas':
		$id = $_POST['id'];
		$model->execute("SELECT* FROM seguimiento_pagos WHERE id_usuario='$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'obtenerDatosPlatillo':
		$idD = $_POST['idDesayuno'];
		$idC = $_POST['idComida'];
		$model->execute("SELECT* FROM platillos_cocina WHERE id_platillo='$idD' or id_platillo='$idC'");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;
	case 'obtenerDatosPlatilloEdit':
		$id = $_POST['id'];
		$model->execute("SELECT* FROM platillos_cocina WHERE id_platillo='$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'eliminarPlatillo':
		$id = $_POST['id'];
		$model->execute("DELETE FROM platillos_cocina WHERE id_platillo='$id'");
		echo 1;
		break;
	case 'obtenerDatosMenu':
		$id = $_POST['id'];
		$model->execute("SELECT* FROM menu_cocina WHERE id_menu='$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'obtenerDatosDetalleMenu':
		$id = $_POST['id'];
		$model->execute("SELECT a.id_platillo,b.nombre_platillo,a.tipo FROM detalle_menu_cocina a INNER JOIN platillos_cocina b on a.id_platillo=b.id_platillo WHERE id_menu='$id'");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;
	case 'eliminarMenu':
		$id = $_POST['id'];
		$model->execute("DELETE FROM detalle_menu_cocina WHERE id_menu='$id'");
		$model->execute("DELETE FROM menu_cocina WHERE id_menu='$id'");
		echo 1;
		break;
	case 'obtenerDatosEncuesta':
		$id = $_POST['id'];
		$model->execute("SELECT* FROM encuesta_cocina WHERE id_encuesta='$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'editarEncuesta':
		$id = $_POST['id'];
		$fecha = $_POST['fecha'];
		$model->execute("UPDATE encuesta_cocina SET fecha_limite = '$fecha' WHERE id_encuesta='$id'");

		echo 1;
		break;
	case 'eliminarEncuesta':
		$id = $_POST['id'];



		$model->execute("DELETE FROM detalle_participacion WHERE id_encuesta='$id'");
		$model->execute("DELETE FROM detalle_encuesta WHERE id_encuesta='$id'");
		$model->execute("DELETE FROM paticipacion_encuesta WHERE id_encuesta='$id'");
		$model->execute("DELETE FROM encuesta_cocina WHERE id_encuesta='$id'");

		echo 1;
		break;
	case 'obtenerDetallesReporte':
		$id = $_POST['id'];
		$model->execute("SELECT * FROM detalle_encuesta WHERE id_encuesta='$id'");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;
	case 'validarFechaEncuesta':
		$fechaLimite = $_POST['fecha'];

		$model->execute("SELECT COUNT(*) AS cantidad FROM encuesta_cocina WHERE fecha_limite>= CURDATE()");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'obtenerConfiguracionMantenimiento':
		$id = $_POST['id'];
		$model->execute("SELECT * FROM configuracion_lista_mantenimiento WHERE id_mantenimiento='$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'obtenerActividadesMantenimiento':
		$id = $_POST['id'];
		$model->execute("SELECT * FROM detalle_mantenimiento WHERE id_mantenimiento='$id'");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;
	case 'obtenerDatosMantenimiento':
		$id = $_POST['id'];
		$model->execute("SELECT a.observaciones,a.id_mantenimiento,a.fecha_inicial,a.fecha_final, b.Lunes,b.Martes,b.Miercoles,b.Jueves,b.Viernes FROM registro_mantenimiento a INNER JOIN configuracion_lista_mantenimiento b ON a.id_mantenimiento=b.id_mantenimiento WHERE a.id_mantenimiento='$id'");
		$consulta = $model->fetch();

		echo json_encode($consulta);
		die();
		break;
	case 'eliminarDetalleMantenimiento':
		$id = $_POST['id'];
		$model->execute("DELETE FROM detalle_mantenimiento WHERE id_detalle='$id'");

		echo 1;
		break;
	case 'obtenerEvidenciasMantenimiento':
		$id = $_POST['id'];

		$model->execute("SELECT* FROM evidencia_mantenimiento WHERE id_mantenimiento = '$id'");
		$consult = $model->fetchAll();

		echo json_encode($consult);
		die();
		break;
	case 'obtenerTop10-Desayunos':
		$id = $_POST['id'];

		$model->execute("SELECT* FROM detalle_encuesta WHERE id_encuesta='$id' AND tipo='DESAYUNO' ORDER BY votos DESC LIMIT 10");
		$consult = $model->fetchAll();

		echo json_encode($consult);
		die();
		break;
	case 'obtenerTop10-COMIDAS':
		$id = $_POST['id'];

		$model->execute("SELECT* FROM detalle_encuesta WHERE id_encuesta='$id' AND tipo='COMIDA' ORDER BY votos DESC LIMIT 10");
		$consult = $model->fetchAll();

		echo json_encode($consult);
		die();
		break;
	case 'verDetallesParticipacion':
		$id = $_POST['id'];

		$model->execute("SELECT b.nombre FROM detalle_participacion a INNER JOIN lista_servicio_cocina b ON a.id_usuario=b.id_usuario WHERE id_detalle_encuesta='$id'");
		$consult = $model->fetchAll();

		echo json_encode($consult);
		die();
		break;
	case 'crearTotalPagos':
		$fechaInicial = $_POST['fechaInicial'];
		$fechaFinal = $_POST['fechaFinal'];

		if ($fechaInicial == $fechaFinal) {
			$model->execute("SELECT b.nombre,a.fecha_pago,a.fecha_inicial,a.fecha_final,SUM(a.dias_pagados) AS dias_pagados, SUM(total) AS total FROM historial_pagos_cocina a INNER JOIN lista_servicio_cocina b ON a.id_usuario=b.id_usuario  WHERE fecha_pago LIKE '$fechaInicial%' GROUP BY a.fecha_pago  ORDER BY id_historial");
			$consult = $model->fetchAll();

			echo json_encode($consult);
			die();
		} else {
			$model->execute("SELECT b.nombre,a.fecha_pago,a.fecha_inicial,a.fecha_final,SUM(a.dias_pagados) AS dias_pagados, SUM(total) AS total FROM historial_pagos_cocina a INNER JOIN lista_servicio_cocina b ON a.id_usuario=b.id_usuario WHERE fecha_pago BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY a.fecha_pago  ORDER BY id_historial ");
			$consult = $model->fetchAll();

			echo json_encode($consult);
			die();
		}

		break;
	case 'obtenerDatosRegistroBitacora':

		$id = $_POST['id'];

		$model->execute("SELECT * FROM bitacora_mantenimiento WHERE id_registro = '$id'");
		$consult = $model->fetch();

		echo json_encode($consult);
		die();

		break;
	case 'editarRegistroBitacora':

		$id = $_POST['id'];
		$fecha = $_POST['fecha'];
		$encargado = $_POST['encargado'];
		$hora = $_POST['hora'];
		$actividad = $_POST['actividad'];
		$observaciones = $_POST['observaciones'];

		$model->execute("UPDATE bitacora_mantenimiento SET id_actividad='$actividad',id_encargado='$encargado',observaciones='$observaciones',fecha='$fecha',hora='$hora' WHERE id_registro = '$id'");
		$consult = $model->get_Affect();
		print_r($consult);
		if ($consult == 0) {
			echo "No se realizo ningun cambio";
		} else {
			echo "Actualización exitosa";
		}
		break;
	case 'eliminarRegistrosBitacora':
		$id = $_POST['id'];

		$model->execute("DELETE FROM bitacora_mantenimiento  WHERE id_registro = '$id'");
		$consult = $model->get_Affect();
		if ($consult == 0) {
			echo "Error en consulta";
		} else {
			echo "Registro eliminado exitosamente";
		}
		break;
	case 'verRegistroBitacora':
		$id = $_POST['id'];

		$model->execute("SELECT* FROM bitacora_mantenimiento WHERE id_registro = '$id'");
		$consult = $model->fetch();

		echo json_encode($consult);
		die();

		break;
	case 'verEvidenciasBitacora':
		$id = $_POST['id'];

		$model->execute("SELECT* FROM evidencia_bitacora WHERE id_registro = '$id'");
		$consult = $model->fetchAll();

		echo json_encode($consult);
		die();

		break;
	case 'agregarEncargadoMantenimiento':

		$nom = $_POST['nom'];

		$model->execute("INSERT INTO encargado_mantenimiento (encargado) VALUES ('$nom')");
		$consult = $model->get_Affect();

		if ($consult == 1) {
			echo 'Registro agregado exitosamente';
		} else {
			echo 'Error al agregar registro';
		}
		break;
	case 'eliminarEncargadoMantenimiento':
		$id = $_POST['id'];

		$model->execute("DELETE FROM encargado_mantenimiento WHERE id_encargado = '$id'");
		$consult = $model->get_Affect();



		if ($consult == 1) {
			echo 'Registro eliminado exitosamente';
		} else {
			echo 'Error al eliminar registro';
		}
		break;
	case 'cambiarCalificacionRegistro':
		$id = $_POST['id'];
		$cal = $_POST['cal'];

		$model->execute("UPDATE bitacora_mantenimiento SET calificacion = '$cal' WHERE id_registro = '$id'");
		$consult = $model->get_Affect();

		if ($consult == 1) {
			echo "Calificación modificada exitosamente";
		} else {
			echo "Error al modificar la calificación";
		}
		break;
	case 'cambiarCalificacionReporte';
		$id = $_POST['id'];
		$cal = $_POST['cal'];

		$model->execute("UPDATE reporte SET calificacion = '$cal' WHERE id_reporte = '$id'");
		$consult = $model->get_Affect();

		if ($consult == 1) {
			echo "Calificación modificada exitosamente";
		} else {
			echo "Error al modificar la calificación";
		}
		break;
	case 'GraficaRendimientoGeneral':
		$model->execute("SET lc_time_names = 'es_ES';");
		$model->execute("SELECT Date_format(fecha_final,'%M/%Y') AS FECHA, avg(calificacion) AS promedio FROM reporte GROUP BY FECHA ORDER BY fecha_final");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;

	case 'GraficaMantenimiento':

		$model->execute("SELECT b.encargado, COUNT(a.id_actividad) AS cantidad FROM `bitacora_mantenimiento` a INNER JOIN encargado_mantenimiento b ON a.id_encargado = b.id_encargado INNER JOIN actividades_mantenimiento c ON a.id_actividad = c.id_actividad GROUP BY b.id_encargado");
		$consulta = $model->fetchAll();

		echo json_encode($consulta);
		die();
		break;

	case 'obtenerDatosPagosPendientes':
		$id = $_POST['id'];

		$model->execute("SELECT * FROM adeudo_pagos WHERE id_usuario= '$id' ORDER BY id_adeudo DESC");
		$consult = $model->fetchAll();

		echo json_encode($consult);
		die();
		break;
	case 'obtenerTotalAdeudos':
		$id = $_POST['id'];

		$model->execute("SELECT ifnull(sum(monto),0) AS total , COUNT(*) AS dias FROM adeudo_pagos WHERE id_usuario= '$id' and estatus= 'PENDIENTE' ORDER BY id_adeudo DESC");
		$consult = $model->fetch();

		echo json_encode($consult);
		die();
		break;
	case 'pagarAdeudos':
		$id = $_POST['id'];
		$dias = $_POST['dias'];
		print_r($_POST);
		$model->execute("SELECT sum(monto) AS total, COUNT(*) AS dias FROM adeudo_pagos WHERE id_usuario= '$id' and estatus= 'PENDIENTE' ORDER BY id_adeudo DESC");
		$consulta = $model->fetch();


		if ($dias > $consulta['dias']) {
			echo 'El numero de dias no es valido ya que rebasa el limite';
		} else if ($dias > 0 && $dias <= $consulta['dias']) {
			$model->execute("SELECT id_adeudo, DATE(fecha_servicio) as fecha, fecha_servicio AS fechaHora FROM adeudo_pagos WHERE id_usuario='$id' AND estatus = 'PENDIENTE' ORDER BY id_adeudo DESC");
			$consult = $model->fetchAll();

			$contador = 0;

			print_r($consult);


			foreach ($consult as $res) {
				if ($contador < $dias) {
					$id_adeudo = $res['id_adeudo'];
					$fecha = $res['fecha'];
					$fechaHora = $res['fechaHora'];
					$model->execute("UPDATE adeudo_pagos SET estatus='PAGADO', fecha_pago='$fechaHora' WHERE id_adeudo='$id_adeudo'");
					if ($model->get_Affect() > 0) {
						$model->execute("INSERT INTO historial_pagos_cocina (id_usuario,dias_pagados,fecha_inicial,fecha_final,total) VALUES ('$id',1,'$fecha','$fecha',50)");
						if ($model->get_Affect() > 0) {
							$contador++;
							echo 1;
						} else {
							echo "Error al crear registro en el historial de pago";
							return false;
						}
					} else {
						echo "Error al actualizar el pago";
						return false;
					}
				}
			}



			echo 'El pago se a registrado exitosamente';
		}
		break;
	case 'agregarRegistrosAdeudos':

		$id = $_POST['id'];
		$fechas = $_POST['fechas'];

		print_r($fechas);
		$contador = 0;
		for ($i = 0; $i < COUNT($fechas); $i++) {
			
			$dia = $fechas[$i];
			$model->execute("INSERT INTO adeudo_pagos (id_usuario,monto,fecha_servicio) VALUES ('$id',50,'$dia')");
			if ($model->get_Affect() > 0) {
				$contador++;
			} else {
				echo "Error al crear registro en el historial de pago";
			}
		}
		if($contador == COUNT($fechas)){
			echo 1;
		}

		break;
	case 'traerDatosPlatillos':
		$model->execute("SELECT* FROM platillos_cocina a INNER JOIN tipo_platillo b ON a.tipo_platillo = b.id_tipo");
		$consult = $model->fetchAll();
		
		echo json_encode($consult);
		die();

		break;
	case 'traerDatosUsuarios':
		$model->execute("SELECT* FROM lista_servicio_cocina");
		$consult = $model->fetchAll();
		
		echo json_encode($consult);
		die();
		break;
	default:
		$response = array('response' => 'no se encontro action',);
		echo json_encode($response);
		die();
		break;
}
