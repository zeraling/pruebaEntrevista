<?php

namespace App\Controllers;

use App\Models\Cities;
use App\Models\Clients;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

class ClientsController extends BaseController {

    public function formAction(ServerRequest $request) {
        $code = $request->getAttribute('id');
        $data = array();
        if ($code != null && $code > 0) {
            $data['cliente']=Clients::getClientById($code);
        }
        return $this->renderHTML('form-clientes.twig',$data);
    }

    public function saveAction(ServerRequest $request) {
        $postData = $request->getParsedBody();
        $miCliente = new Clients();
        $data = array();
        if ($postData['idCliente'] > 0) {
            //create
            $miCliente->id = $postData['idCliente'];
            $miCliente->name = $postData['Nombre'];
            $miCliente->city = $postData['idCiudad'];
            
            $update = $miCliente->updateCliente();

            $data['response']= $update;
            $data['message'] = $update?'Cliente actualziado correctamente':'ciente no se ha podido actualizar';
            
        } else {
            //create
            $miCliente->id = $postData['Id'];
            $miCliente->name = $postData['Nombre'];
            $miCliente->city = $postData['idCiudad'];

            $guarda = $miCliente->saveCliente();

            $data['response']=$guarda;
            $data['message'] = $guarda?'Cliente creado correctamente':'ciente no se ha podido crear';
        
        }
        
        return $this->renderHTML('form-clientes.twig',$data);
    }

}
