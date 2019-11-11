<?php

namespace Core\Router;


class Router{

  private $request;
  private $supportedHttpMethods = array( "GET", "POST", "PUT", "DELETE");

  function __construct(IRequest $request){
   $this->request = $request;
  }


  function __call($name, $args){
    list($route, $method) = $args;
    if(!in_array(strtoupper($name), $this->supportedHttpMethods)){
      $this->invalidMethodHandler();
    }

    $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
  }

  /**
   * Removes trailing forward slashes from the right of the route.
   * @param route (string)
   */
  private function formatRoute($route){
    $result = rtrim($route, '/');
    if ($result === ''){
      return '/';
    }




    return $result;
  }

  private function invalidMethodHandler(){
    header("{$this->request->serverProtocol} 405 Method Not Allowed");
    var_dump('405');
  }
  
  private function defaultRequestHandler(){
    header("{$this->request->serverProtocol} 404 Not Found");
    var_dump('404');
  }

  /**
   * Resolves a route
   */
  function resolve(){
    $methodDictionary = $this->{strtolower($this->request->requestMethod)};
    $formatedRoute = $this->formatRoute($this->request->requestUri);

    if(!isset($methodDictionary) || !isset($formatedRoute) || !isset($methodDictionary[$formatedRoute]) || is_null($methodDictionary[$formatedRoute])){
      $this->defaultRequestHandler();
      return;
    }

    $method = $methodDictionary[$formatedRoute];

    echo call_user_func_array($method, array($this->request));
  }

  function __destruct(){
    $this->resolve();
  }
}