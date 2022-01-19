<?php

namespace MindApps\LaravelSispag\Common;

class Util
{
    private $codeItau = '341';
    private $nameItau = 'Itaú Unibanco';


    /**
     * @notes Get bank code from class name
     *
     * @param $className
     * @return mixed
     * @throws \Exception
     */
    public static function getBankCode($className)
    {
        if(!isset((new self)->{'code'.$className}))
        {
            throw new \Exception('Invalid class name');
        }
        else
        {
            return (new self)->{'code'.$className};
        }
    }

    /**
     * @notes Get bank code from class name
     *
     * @param $className
     * @return mixed
     * @throws \Exception
     */
    public static function getBankName($className)
    {
        if(!isset((new self)->{'name'.$className}))
        {
            throw new \Exception('Invalid class name');
        }
        else
        {
            return (new self)->{'name'.$className};
        }
    }

    /**
     * @notes Return string with only space char
     *
     * @param $length
     * @return string
     */
    public static function complementWithSpace($length)
    {
        return str_repeat(' ', $length);
    }

    /**
     * @notes Return string with only zero char
     *
     * @param $length
     * @return string
     */
    public static function complementWithZero($length)
    {
        return str_repeat('0', $length);
    }


    /**
     * @notes Remove non numeric char from string
     *
     * @param $string
     * @return array|string|string[]|null
     */
    public static function onlyNumbers($string)
    {
        $string = str_replace(" ","",$string);

        return preg_replace("/[^0-9]/", "", $string);
    }


    /**
     * @notes Remove accenpts and special chars from string
     *
     * @param $string
     * @return array|string|string[]|null
     */
    public static function removeSpecialChars($string)
    {
        $string = str_replace(array("Ç","ç"),array("C","c"), $string);

        $result = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/",
            "/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/",
            "/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),($string));
        
        return $result;
    }


    /**
     * @notes Remove mask from string
     *
     * @param $string
     * @return array|string|string[]|null
     */
    public static function removeMask($string)
    {
        $result = str_replace(["\n",".","_","\\","/","-","(",")",'"',"'","+",","], ["","","","","","","","","","","",""], $string);

        return $result;
    }
}