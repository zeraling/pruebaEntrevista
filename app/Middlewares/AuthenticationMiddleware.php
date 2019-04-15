<?php

namespace App\Middlewares;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use \Zend\Diactoros\Response\RedirectResponse;

class AuthenticationMiddleware implements MiddlewareInterface
{

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $urlPath = $request->getUri()->getPath();
        
        if (empty($_SESSION['sigUser'])) {
            if($urlPath!='/login'){
                return new RedirectResponse('/login');
            }  
        } elseif (!empty($_SESSION['sigUser'])) {
            if($urlPath=='/login'){
                return new RedirectResponse('/');
            } 
        }

        return $handler->handle($request);
    }
}