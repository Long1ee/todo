<?php
/**
* File Request.php
*
* @author Kovardin Artem <horechek@gmail.com>
* @link http://tvorzasp.com/
* @copyright tvorzasp
* @license wtfpl
*/
namespace Phpcourses\Http;
/**
* Class Request
*
* description
*
* @author Kovardin Artem <horechek@gmail.com>
* @version 1.0
* @package \Phpcourses\Http 
*/
class Request
{
    public $defaultRoute;

    public function __construct()
    {
        if (!isset($_GET["r"])) {
            $this->defaultRoute = "list";
        }    
    }

    public function getRoute()
    {
        if (!isset($_GET["r"])) {
            return $this->defaultRoute;
        }
        return $_GET["r"];
    }

    public function getParam($name, $default="")
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        return $default;
    }

    public function getPost($name, $default="")
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        return $default;
    }
}