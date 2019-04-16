<?php

namespace App\Controllers;

use App\Models\Clients;
use App\Models\Cities;

class IndexController extends BaseController {

    public function indexAction() {

        $clientes = Clients::getClients();

        return $this->renderHTML('index.twig', [
                    'listaClientes' => $clientes
        ]);
    }
    
    public function getCiudades() {

        $ciudades = Cities::getCities();

        return $this->renderJson($ciudades);
    }

}
