<?php

enum errorRegistro: string
{
  case CamposVacios = 'Todos los campos son obligatorios';
  case ContrasenaNoCoincide = "Las contraseñas no coinciden.";
  case ContrasenaEspacios = "La contraseña no debe contener espacios.";
  case CorreoDuplicado = "El correo electrónico ya está registrado.";
}
