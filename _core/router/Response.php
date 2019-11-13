<?php
namespace Core\Router;


class Response{
    
  function __construct()
  {
  }

  public function withJson( Array $arr , $code = 201)
  {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode($arr );
  }
  

  public function withStatus( $code = 201)
  {
    http_response_code($code);
  }

}