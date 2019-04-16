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

    public $id;
    public $name;
    public $city;

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

    public static function getClientById($cod) {
        $consulta = "select * from clients where cod=:code";
        //instancia y conexion a base de datos
        $dataBase = new DemoDB();
        try {
            // preparar el DML a ejecutar
            $query = $dataBase->prepare($consulta);
            $query->bindValue(':code', $cod,PDO::PARAM_INT);
            // ejecutar la consulta
            $query->execute();
            // procesamos el resultado de la consulta
            $resultados = $query->fetch(PDO::FETCH_OBJ);
            return $resultados;
        } catch (PDOException $exc) {
            // si ocurre algun error se genera la excepcion y se crea un log
            return null;
        }
    }
    
    
    public function saveCliente() {
        $consulta = "INSERT INTO `clients`(`cod`, `name`, `city`) VALUES (:id,:name,:city)";

        //instancia y conexion a base de datos
        $dataBase = new DemoDB();
        try {
            // preparar el DML a ejecutar
            $query = $dataBase->prepare($consulta);
            
            $query->bindValue(':id', $this->id,PDO::PARAM_INT);
            $query->bindValue(':name', $this->name,PDO::PARAM_STR);
            $query->bindValue(':city', $this->city,PDO::PARAM_INT);
            // ejecutar la consulta
            $rest = $query->execute();
            return $rest;
        } catch (PDOException $exc) {
            // si ocurre algun error se genera la excepcion y se crea un log
            return false;
        }
    }
    
     public function updateCliente() {
        $consulta = "UPDATE clients SET name=:name,city=:city WHERE cod=:cod";

        //instancia y conexion a base de datos
        $dataBase = new DemoDB();
        try {
            // preparar el DML a ejecutar
            $query = $dataBase->prepare($consulta);
            
            $query->bindValue(':cod', $this->id,PDO::PARAM_INT);
            $query->bindValue(':name', $this->name,PDO::PARAM_STR);
            $query->bindValue(':city', $this->city,PDO::PARAM_INT);
            // ejecutar la consulta
            $rest = $query->execute();
            return $rest;
        } catch (PDOException $exc) {
            return false;
        }
    }

}
