<?php
session_start();

if (isset($_SESSION['usuarioID'])) {
  echo "El ID del usuario logueado es: " . $_SESSION['usuarioID'];
} else {
  echo "No hay sesión iniciada o no se ha guardado el usuarioID.";
}
