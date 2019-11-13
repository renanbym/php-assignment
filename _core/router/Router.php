<?php

namespace Core\Router;

class Router{

  private $request;
  private $response;
  private $supportedHttpMethods = array( "GET", "POST", "PUT", "DELETE");

  function __construct(IRequest $request, Response $response){
   $this->request = $request;
   $this->response = $response;
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

    $string = strtolower($result);
    preg_match_all('/^(.*)\?(.*)$/', $string, $urls);
    if($urls && isset($urls[1]) && $urls[1] ){
      return $urls[1][0];
    }

    return $result;
  }

  private function invalidMethodHandler(){
    header("{$this->request->serverProtocol} 405 Method Not Allowed");
    $this->response->withJson(array('message' => 'Method Not Allowed'), 405);
  }
  
  private function defaultRequestHandler(){
    header("{$this->request->serverProtocol} 404 Not Found");
    $this->response->withJson(array('message' => 'Not Found'), 404);
  }

  /**
   * Resolves a route
   */
  function resolve(){
    $methodDictionary = $this->{strtolower($this->request->requestMethod)};
    $formatedRoute = $this->formatRoute($this->request->requestUri);

    if(isset($methodDictionary) && isset($formatedRoute) && isset($methodDictionary[$formatedRoute]) && $methodDictionary[$formatedRoute]){
      $method = $methodDictionary[$formatedRoute];
      echo call_user_func_array($method, array($this->request, $this->response));
      return;

    }else{
      
      $this->defaultRequestHandler();
      return;
    }

  }

  function __destruct(){
    $this->resolve();
  }
}