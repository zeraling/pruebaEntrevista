<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;


use PDO;
use PDOException;
use App\Connections\DemoDB;
/**
 * Description of Clients
 *
 * @author sergio.prada
 */
class Users {
    //put your code here
    
    public static function getUserByName($name) {
        $consulta = "select * from users where users.name=:user";
        //instancia y conexion a base de datos
        $dataBase = new DemoDB();
        try {
            // preparar el DML a ejecutar
            $query = $dataBase->prepare($consulta);
            $query->bindValue(':user', $name,PDO::PARAM_STR);
            // ejecutar la consulta
            $query->execute();
            // procesamos el resultado de la consulta
            $resultados = $query->fetch(PDO::FETCH_OBJ);
            return $resultados;
        } catch (PDOException $exc) {
            //echo $exc->getTraceAsString();
            return false;
        }
    }
    
}
