<?php
if (
    empty($_POST["idCotizacion"])
    ||
    empty($_POST["servicio"])
    ||
    ( ! isset($_POST["costo"]) && $_POST["costo"] )
    ||
    empty($_POST["tiempoEnMinutos"])
    ||
    empty($_POST["multiplicador"])
    ||
    empty($_POST["tokenCSRF"])
) {
    Utiles::redireccionar("detalles_caracteristicas_cotizacion&id=" . $_POST["idCotizacion"]);
}

Utiles::salirSiTokenCSRFNoCoincide($_POST["tokenCSRF"]);

Cotizaciones::agregarServicio($_POST["idCotizacion"], $_POST["servicio"], $_POST["costo"], $_POST["tiempoEnMinutos"], $_POST["multiplicador"]);

Utiles::redireccionar("detalles_caracteristicas_cotizacion&id=" . $_POST["idCotizacion"]);
