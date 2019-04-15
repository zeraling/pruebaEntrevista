<?php

namespace App\Controllers;

use App\Models\Clients;

class IndexController extends BaseController {

    public function indexAction() {

        $clientes = Clients::getClients();

        return $this->renderHTML('index.twig', [
                    'listaClientes' => $clientes
        ]);
    }

}
