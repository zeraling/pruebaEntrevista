<?php

/*
 * Copyright (C) 2018 Sistemas CR EQUIPOS SA
 *
 *  Archivo Creado por Zeraling
 */

namespace App\Connections;

use PDO;
use PDOException;
use RuntimeException;

/**
 * Description of GnesisDB
 *
 * @author Usuario
 */
class DemoDB extends PDO {

    const DB_HOST = 'localhost';
    const DB_NAME = 'id9307511_zeralingapp';
    const DB_USER = 'id9307511_zeryi';
    const DB_PASS = '123456';

    public function __construct() {
        try {
            
            $con = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME;
            parent::__construct($con, self::DB_USER, self::DB_PASS);
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exc) {
            echo 'pdo error';
            die;
        } catch (RuntimeException $e) {
            echo 'runtime error';
            die;
        }
    }

}
