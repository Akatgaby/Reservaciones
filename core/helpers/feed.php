<?php
/**
*	Clase para definir las plantillas de las páginas web del sitio público.
*/
class Feed
{
	public static function headerTemplate($title)
	{
		session_start();

		ini_set('date.timezone', 'America/El_Salvador');
		print('
		<!DOCTYPE html>
		<!-- IDIOMA DE LA PÁGINA -->
		<html lang="es">
			<head>
				<!-- BEGIN: Head -->
				<!-- CARACTERES ESPECIALES -->
				<meta charset="UTF-8">
				<!-- TÍTULO DE LA VENTANA -->
				<title>Monsters University | ' . $title . '</title>
				<!-- ÍCONO DE LA VENTANA -->
				<link rel="shortcut icon" type="image/x-icon" href="../../resources/img/ico.png">
				<!-- MATERIAL ICONS -->
				<link rel="stylesheet" type="text/css" href="../../resources/css/material-icons.css">
				<!-- MATERIALIZE.MIN -->
				<link rel="stylesheet" type="text/css" href="../../resources/css/materialize.min.css">
				<!-- FUENTE -->
				<link rel="stylesheet" type="text/css" href="../../resources/css/font.css">
				<!-- ESTILOS -->
				<link rel="stylesheet" type="text/css" href="../../resources/css/style.css">
				<link rel="stylesheet" type="text/css" href="../../resources/css/aki.css">
				<!-- END: Head-->
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			</head>
		');
			// Se comprueba si existe una sesión para mostrar el menú de opciones, de lo contrario se muestra un menú vacío
		if (isset($_SESSION['idUsuario'])) {
			//Tiempo en segundos para dar vida a la sesión.
			$inactivo = 5000; // Fórmula para obtener segundos (min * 60)
			//Calculamos tiempo de vida inactivo.
			$vida_session = time() - $_SESSION['tiempo'];
			//Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
			if ($vida_session > $inactivo) {
				//Destruimos sesión.
				session_destroy();
				//Redirigimos pagina.
				header("Location: index.php");
			} else {  // si no ha caducado la sesion, actualizamos
				$_SESSION['tiempo'] = time();
			}
			$filename = basename($_SERVER['PHP_SELF']);
			if ($filename != 'index.php' && $filename != 'register.php') {
				self::modals();
				print('
					<header>
						<div class="navbar-fixed">
							<nav class="white black-text">
								<div class="brand-sidebar black">
									<a class="brand-logo center">
										<img src="../../resources/img/ico2.png" alt="ico" height="25">
									</a>
								</div>
								<div class="nav-wrapper">
									<a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
									<ul class="right hide-on-med-and-down">
										<li><a href="student.php" class="middle black-text"><i class="material-icons left">school</i>Datos del aspirante</a></li>
										<li><a href="main.php" class="middle black-text"><i class="material-icons left">home</i>Inicio</a></li>
										<li><a href="#" class="middle dropdown-trigger black-text" data-target="dropdown"><i class="material-icons left">person</i>Usuario: <b>' . $_SESSION['aliasUsuario'] . '</b></a></li>
									</ul>
									<ul id="dropdown" class="dropdown-content">
										<li><a href="#mo" onclick="modalProfile()"><i class="material-icons">mode_edit</i>Perfil</a></li>
										<li><a href="#modal-password" class="modal-trigger"><i class="material-icons">lock</i>Clave</a></li>
										<li><a href="#" onclick="signOff()"><i class="material-icons">power_settings_new</i>Salir</a></li>
									</ul>
								</div>
							</nav>
						</div>
						<ul class="sidenav black-text" id="mobile">
						<li><a href="student.php" class=" black-text"><i class="material-icons left">school</i>Datos del aspirante</a></li>
						<li><a href="main.php" class=" black-text"><i class="material-icons left">home</i>Inicio</a></li>
						<li><a href="#" class=" dropdown-trigger black-text" data-target="dropdown"><i class="material-icons left">person</i>Usuario: <b>' . $_SESSION['aliasUsuario'] . '</b></a></li>
						</ul>
						<ul id="dropdown-mobile" class="dropdown-content">
							<li><a href="#" onclick="modalProfile()">Editar perfil</a></li>
							<li><a href="#modal-password" class="modal-trigger">Cambiar clave</a></li>
							<li><a href="#" onclick="signOff()">Salir</a></li>
						</ul>
					</header>
					<!-- BEGIN: Profile Button -->
					<div class="fixed-action-btn">
						<a class="btn-floating btn-large light-green tooltipped" data-position="left" data-tooltip="Cuenta">
							<i class="large material-icons">person</i>
						</a>
						<ul>
							<li><a href="" class="btn-floating red lighten-4 tooltipped" data-position="top" data-tooltip="Mis datos"><i class="material-icons">person</i></a></li>
							<li><a href="#" onclick="modalProfile()" class="btn-floating red lighten-3 tooltipped" data-position="top" data-tooltip="Editar"><i class="material-icons">edit</i></a></li>
							<li><a href="#modal-password" class="modal-trigger btn-floating red lighten-2 tooltipped" data-position="top" data-tooltip="Contraseña"><i class="material-icons">lock</i></a></li>
							<li><a href="#" onclick="signOff()" class="btn-floating red lighten-1 tooltipped" data-position="top" data-tooltip="Salir"><i class="material-icons">power_settings_new</i></a></li>
						</ul>
					</div>
					<!-- END: Profile Button -->
					<main class="container">
				');
				$filename = basename($_SERVER['PHP_SELF']);
				if ($filename != 'main.php') {
				} else {
					print('<h3 class="center-align">Aspirante ' . $_SESSION['Nombre'] . '.</h3>');
				}
			} else {
				header('location: main.php');
			}
		} else {
			$filename = basename($_SERVER['PHP_SELF']);
			if ($filename != 'index.php' && $filename != 'register.php') {
				header('location: index.php');
			} else {
				print('
					<!-- BEGIN: Navbar -->
						<nav class="white">
							<div class="nav-wrapper">
								<ul>
									<li>
										<a href="index.php" class="middle black-text"> <i class="material-icons left">near_me</i> Iniciar sesión</a>
									</li>
									<li>
										<a href="register.php" class="middle black-text"> <i class="material-icons left">supervisor_account</i> Registrarme</a>
									</li>
									<li>
										<a href="../index.php" class="middle black-text"> <i class="material-icons left">school</i>Acerca de</a>
									</li>
								</ul>
							</div>
						</nav>
					<!-- END: Navbar -->
				');
			}
		}
	}

	public static function footerTemplate($controller)
	{
		print('
					<script type="text/javascript" src="../../libraries/jquery-3.2.1.min.js"></script>
					<script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
					<script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
					<script type="text/javascript" src="../../resources/js/dashboard.js"></script>
					<script type="text/javascript" src="../../resources/js/init-slider.js"></script>
					<script type="text/javascript" src="../../core/helpers/functions.js"></script>
					<script type="text/javascript" src="../../core/controllers/feed/account.js"></script>
					<script type="text/javascript" src="../../core/controllers/feed/' . $controller . '"></script>
				</body>
			</html>
		');
	}

	private function modals()
	{
		print('
			<div id="modal-profile" class="modal">
				<div class="modal-content">
					<h4 class="center-align">Mi perfil</h4>
					<form method="post" id="form-profile">
						<div class="row">
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">bookmark</i>
								<input autocomplete="off" id="profile_nombres" type="text" name="profile_nombres" class="validate" required/>
								<label for="profile_nombres">Nombres</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">bookmark_border</i>
								<input autocomplete="off" id="profile_apellidos" type="text" name="profile_apellidos" class="validate" required/>
								<label for="profile_apellidos">Apellidos</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">email</i>
								<input autocomplete="off" id="profile_correo" type="email" name="profile_correo" class="validate" required/>
								<label for="profile_correo">Correo</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">favorite_border</i>
								<input autocomplete="off" id="profile_alias" type="text" name="profile_alias" class="validate" required/>
								<label for="profile_alias">Nombre de usuario</label>
							</div>
						</div>
						<div class="row center-align">
							<a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
							<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
						</div>
					</form>
				</div>
			</div>
			<div id="modal-password" class="modal">
				<div class="modal-content">
					<h4 class="center-align">Actualizar mi contraseña</h4>
					<form method="post" id="form-password">
						<div class="row center-align">
						<label><i>CONTRASEÑA ACTUAL</i></label>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">lock</i>
								<input autocomplete="off" id="clave_actual_1" type="password" name="clave_actual_1" class="validate" required/>
								<label for="clave_actual_1">Escriba su contraseña actual</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">refresh</i>
								<input autocomplete="off" id="clave_actual_2" type="password" name="clave_actual_2" class="validate" required/>
								<label for="clave_actual_2">Repita su contraseña actual</label>
							</div>
						</div>
						<div class="row center-align">
							<label><i>NUEVA CONTRASEÑA</i></label>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">lock_outline</i>
								<input autocomplete="off" id="clave_nueva_1" type="password" name="clave_nueva_1" class="validate" required/>
								<label for="clave_nueva_1">Escriba su nueva contraseña</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">done</i>
								<input autocomplete="off" id="clave_nueva_2" type="password" name="clave_nueva_2" class="validate" required/>
								<label for="clave_nueva_2">Repita la nueva contraseña</label>
							</div>
						</div>
						<div class="row center-align">
							<a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
							<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Cambiar"><i class="material-icons">save</i></button>
						</div>
					</form>
				</div>
			</div>
		');
	}
}
