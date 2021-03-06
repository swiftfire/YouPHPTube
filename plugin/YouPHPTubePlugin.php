<?php
require_once $global['systemRootPath'].'objects/plugin.php';
class YouPHPTubePlugin{
    public static function getHeadCode(){
        $plugins = Plugin::getAllEnabled();
        $str = "";
        foreach ($plugins as $value) {
            $p = static::loadPlugin($value['dirName']);
            $str .= $p->getHeadCode();
        }
        return $str;
    }
    public static function getFooterCode(){
        $plugins = Plugin::getAllEnabled();
        $str = "";
        foreach ($plugins as $value) {
            $p = static::loadPlugin($value['dirName']);
            $str .= $p->getFooterCode();
        }
        return $str;
    }
    public static function getHTMLBody(){
        $plugins = Plugin::getAllEnabled();
        $str = "";
        foreach ($plugins as $value) {
            $p = static::loadPlugin($value['dirName']);
            $str .= $p->getHTMLBody();
        }
        return $str;
    }
    public static function getHTMLMenuLeft(){
        $plugins = Plugin::getAllEnabled();
        $str = "";
        foreach ($plugins as $value) {
            $p = static::loadPlugin($value['dirName']);
            $str .= $p->getHTMLMenuLeft();
        }
        return $str;
    }
    public static function getHTMLMenuRight() {
        $plugins = Plugin::getAllEnabled();
        $str = "";
        foreach ($plugins as $value) {
            $p = static::loadPlugin($value['dirName']);
            $str .= $p->getHTMLMenuRight();
        }
        return $str;
    }
        
    public static function getFirstPage() {
        $plugins = Plugin::getAllEnabled();
        $firstPage = false;
        foreach ($plugins as $value) {
            $p = static::loadPlugin($value['dirName']);
            $firstPage = $p->getFirstPage();
            if($firstPage){
                return $firstPage;
            }
        }
        return $firstPage;
    }
    
    static function loadPlugin($name){
        global $global;
        $file = "{$global['systemRootPath']}plugin/{$name}/{$name}.php";
        if(file_exists($file)){
            require_once $file;
            eval("\$p = new {$name}();");
            return $p;
        }
        return false;
    }
    
    
    public static function isEnabled($uuid){
        return !empty(Plugin::getEnabled($uuid));
    }
    
}