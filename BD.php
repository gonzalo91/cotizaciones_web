<?php

class BD
{
    static $bd, $bdSession;

    public static function obtener()
    {
        
        if(is_null(static::$bd)){
            BD::$bd = new PDO(
                "mysql:host=" . Comun::env("HOST_MYSQL") . ";dbname=" . Comun::env("NOMBRE_BD_MYSQL"),
                Comun::env("USUARIO_MYSQL"),
                Comun::env("PASS_MYSQL")
            );
            BD::$bd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            BD::$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            BD::$bd->query("SET NAMES 'utf8'");
        }
        
        return BD::$bd;
    }

    public static function obtenerParaSesion()
    {
        
        return self::obtener();
    }
}
