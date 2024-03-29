<?php
namespace Core\Router;


class Request implements \Core\Router\IRequest{
    
  function __construct()
  {
    $this->bootstrapSelf();
  }
  private function bootstrapSelf()
  {
    foreach($_SERVER as $key => $value)
    {
      $this->{$this->toCamelCase($key)} = $value;
    }
  }
  private function toCamelCase($string)
  {
    $result = strtolower($string);
        
    preg_match_all('/_[a-z]/', $result, $matches);
    foreach($matches[0] as $match)
    {
        $c = str_replace('_', '', strtoupper($match));
        $result = str_replace($match, $c, $result);
    }
    return $result;
  }
  public function getBody()
  {
    if($this->requestMethod === "GET")
    {
      $body = array();
      foreach($_GET as $key => $value)
      {
        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
      return $body;
    }
    if ($this->requestMethod == "POST")
    {
      $body = array();
      foreach($_POST as $key => $value)
      {
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
      return $body;
    }

    if ($this->requestMethod == "PUT")
    {
      parse_str(file_get_contents("php://input"),$post_vars);
      $body = array();
      foreach($post_vars as $key => $value)
      {
        $body[$key] = $value;
      }
      return $body;
    }

    if ($this->requestMethod == "DELETE")
    {
      parse_str(file_get_contents("php://input"),$post_vars);
      $body = array();
      foreach($post_vars as $key => $value)
      {
        $body[$key] = $value;
      }
      return $body;
    }

  }
}