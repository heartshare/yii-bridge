<?php
    /*
    Plugin Name:Yii bridge
    Description: connect Yii www.yiiframework.com as a MVC framework for Wordpress
    Author: chensihai
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

    //if(strpos($_SERVER['REQUEST_URI'],"site/login")>0||strpos($_SERVER['REQUEST_URI'],"site/logout")>0)
    {    
        add_action('get_header', 'login_func',-100);
    }
    if(strpos($_SERVER['REQUEST_URI'],"captcha")>0)
    {
        add_action('get_header', 'captcha_func',-100);
    }
    function login_func(){
        ob_start();
    }

    function captcha_func(){
        global $posts;
        $shortcode_found=false;
        foreach($posts as $post){
            if (stripos($post->post_content, '[yii ') !== false) {
                $shortcode_found = true; 
                $str = preg_split('!(\[.*?\])!', $post->post_content, -1,  PREG_SPLIT_DELIM_CAPTURE  );
                $str=trim($str[1],"[");
                $str=trim($str,"]");
                $strs=explode("=",$str);
                $app_path=$strs[1];
                break;
            }
        } 
        $app="yii/".$app_path;
        $file=ABSPATH."/".$app."/index.php";
        $_SERVER['PHP_SELF']=$_SERVER['SCRIPT_NAME']="/".$app."/index.php";            
        $_SERVER['SCRIPT_FILENAME']=$file;
        $_GET['r']="site/captcha";
        require($file);
        die();    
    }

    function header_func(){
        global $posts;
        $shortcode_found=false;
        foreach($posts as $post){
            if (stripos($post->post_content, '[yii ') !== false) {
                $shortcode_found = true;
                $str = preg_split('!(\[.*?\])!', $post->post_content, -1,  PREG_SPLIT_DELIM_CAPTURE  );
                $str=trim($str[1],"[");
                $str=trim($str,"]");
                $strs=explode("=",$str);
                $app_path=$strs[1];

                break;
            }
        } 
        if(!$shortcode_found) return;
    ?>
    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="/yii/<?php echo $app_path ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="/yii/<?php echo $app_path ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="/yii/<?php echo $app_path ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="/yii/<?php echo $app_path ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="/yii/<?php echo $app_path ?>/css/form.css" />
    <?php       
    } 
    add_action('wp_head', 'header_func');       
?>
