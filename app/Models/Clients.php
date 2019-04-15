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
class Clients {
    //put your code here
    
    public static function getClients() {
        $consulta = "select 
        clients.cod,
        clients.name, 
        cities.name as city
        from clients,cities
        where clients.city=cities.cod";
        //instancia y conexion a base de datos
        $dataBase = new DemoDB();
        try {
            // preparar el DML a ejecutar
            $query = $dataBase->prepare($consulta);
            // ejecutar la consulta
            $query->execute();
            // procesamos el resultado de la consulta
            $resultados = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultados;
        } catch (PDOException $exc) {
            // si ocurre algun error se genera la excepcion y se crea un log
            return null;
        }
    }
    
}
