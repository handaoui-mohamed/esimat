<?php
namespace KikimR\router;
/**
 *
 */
class route
{
    private $path=array();
    private $callable;
    private $matches=array();
    private $name;
    private $params=array();

    function __construct($path,$callable,$name="")
    {
        $this->path[]=trim($path,'/');
        $this->callable=$callable;
        $this->name=trim($name,'/');
    }

    /**
     * @param $url
     * @return bool
     */
    public function isMe($url)
    {
       $nb_path=count($this->path);
        for ($i=0;$i<$nb_path;$i++)
        {
            $path=preg_replace_callback('#\[[a-z0-9_]+\]#i', [$this,'paramsV'], $this->path[$i]);

            $regexp='#^'.trim($this->name.'/'.$path,'/').'$#i';

            if(preg_match($regexp,$url,$matches))
            {
                array_shift($matches);
                $this->matches=$matches;
                return true;
            }
        }

        return false;
    }

    private function paramsV($v)
    {

        $v=preg_replace('#\[|\]#','',$v[0]);
        if(!empty($this->params[$v]))
        {
            return '('.$this->params[$v].')';
        }
        else return '([^/]+)';
    }

    public function with($param,$regexp)
    {
        $this->params[$param]=$regexp;
        return $this;
    }

    public function addPath($path)
    {
        $this->path[]=trim($path,'/');
        return $this;
    }


    public function call()
    {
        call_user_func_array($this->callable,$this->matches);
    }

}

?>