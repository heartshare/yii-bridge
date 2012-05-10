<?php
    /*
    Plugin Name:Yii bridge
    Description: connect Yii www.yiiframework.com as a MVC framework for Wordpress
    Author: chensihai@gmail.com
    Version: 0.4
    */

    function yii_bridge_func($atts){

        extract( shortcode_atts( array(
                    'app_path' => 'demos/helloworld'
                ), $atts ) );

        $file=ABSPATH."yii/".$app_path."/index.php";
        $file0=$_SERVER['SCRIPT_FILENAME']=$file;
        $_SERVER['SCRIPT_FILENAME']=$file;
        $self0=$_SERVER['PHP_SELF'];
        $_SERVER['PHP_SELF']=$_SERVER['SCRIPT_NAME']="index.php";
        $path0=getcwd();
        chdir($path0."/yii/".$app_path);
        ob_start();
        include($file);
        $result = ob_get_contents();
        ob_end_clean();
        chdir($path0);
        $_SERVER['PHP_SELF']=$_SERVER['SCRIPT_NAME']=$self0;
        $_SERVER['SCRIPT_FILENAME']=$file0;
        if(strpos($result,"<body")>0){
            preg_match('/(?:<body[^>]*>)(.*)<\/body>/isU', $result, $matches);
            $result = $matches[1];
        }
        $urls=explode("?",$_SERVER['REQUEST_URI']);
        $urls[0]=trim($urls[0],"/");
        $result=str_replace("/index.php?r=",$urls[0]."?r=",$result);
        $result=str_replace("index.php/?r=",$urls[0]."?r=",$result);
        $result=str_replace("index.php?r=",$urls[0]."?r=",$result);
        $result=str_replace("index.php/",$urls[0]."/?r=",$result);
        return $result;
    }

    add_shortcode('yii','yii_bridge_func');

?>
