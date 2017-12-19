<?php
namespace KikimR\router;
class Router
{
    private static $url='';
    private static $routes=array();
    private static $withUrl=false;
    private static $callableIndex=false;




    /**
     * @param array $middlewaresStart
     */
    public static function init($middlewaresStart=array())
    {

        $nb_midelware=count($middlewaresStart);

        for ($i=0;$i<$nb_midelware;$i++) call_user_func_array($middlewaresStart[$i]['fn'],$middlewaresStart[$i]['params']);

        if (isset($_GET['url']))
        {
            self::$url=trim($_GET['url'],'/');
            unset($_GET['url']);
            self::$withUrl=true;
        }
    }


    public static function get($path,$callable,$name="")
    {
        $route= new Route ($path,$callable,$name);

        self::$routes['get'][]=$route;
        $t=trim($name.$path,'/');
        if($t=="/"||$t=="")
        {
                    self::$callableIndex=$callable;
        }
        return $route;
    }

    /****************post*****************/

    public static function post($path,$callable,$name="")
    {

        $route= new Route ($path,$callable,$name);

        self::$routes['post'][]=$route;

        return $route;

    }


    /***************run******************/
    public static function run($middlewareEnd=null)
    {


        if (self::$withUrl)
        {
                $methode=strtolower($_SERVER['REQUEST_METHOD']);

                if (isset(self::$routes[$methode]))
                {
                    foreach (self::$routes[$methode] as $route) {

                        if ($route->isMe(self::$url))
                        {
                            return $route->call();
                        }

                    }

                    self::Message(404);

                }
                else
                {
                    self::Message(405);

                }
         }
         else
        {
                if (!empty(self::$callableIndex))
                {
                    $v=self::$callableIndex;
                    return call_user_func($v);
                }
                else
                {
                     self::Message(404);
                }

        }


    }

    private static function Message($code=404)
    {
        http_response_code($code);
       

        if (!empty(RouterException::$statuCodes[$code]['file']))
        {
            include RouterException::$statuCodes[$code]['file'];
        }
        else
        {
             echo "<br><div style='color: #39b3d7;'> KikimR <br><hr><br>".RouterException::$statuCodes[$code]["message"]."</div>";
        }
    }

    public static function when($code,$file)
    {
         RouterException::$statuCodes[$code]["file"]=$file;
    }
}
?>