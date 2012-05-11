=== Yii Bridge ===
Contributors: chensihai (this should be a list of wordpress.org userid's)
Donate link: http://wp.69digital.com/
Tags: connect, Yii Framework
Requires at least: 3.3.1
Tested up to: 3.3.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Yii Bridge is a Wordpress plugin, which connect Yii framework into Wordpress,
as MVC framework, to allow you to develop Wordpress shortcode/plugin.

== Description ==

Yii Bridge is a WordPress plugin, which connect Yii framework into WordPress,
as MVC framework, to allow to develop WordPress shortcode/plugin.
The shiny part is, you don’t need to do any hack in WordPress, or Yii
framework/Application, just install the plugin, and you’ll see all Yii
function work seamless within WordPress.

This is a standard free version. You mind find some functions miss, for
examples,
a)Login function,
b)Captcha
c)Style sheet
For a PRO version, which cover all the functions, please go to
http://wp.69digital.com.

== Installation ==
---and test---
1)Install Yii on the root of Wordpress, and name it as /yii. In other word,
/wp-content and /yii folders are on teh same directory level.

2)Install the yii-bridge plugin under wp-content/plugins, enable the plugin

3)Do test by place short code on page/post. You may need to set Permallink to
none default option if it won’t work.
[yii app_path=demos/helloworld]
[yii app_path=demos/phonebook]
[yii app_path=demos/blog]
[yii app_path=demos/hangman]
4)
a)Create your own yii application, produce yii web application as yii
framework suggested,
#cd yii/framework
#./yiic webapp ../testyii
b)test shortcode like 3)
[yii app_path=testyii]

== Frequently Asked Questions ==


== Screenshots ==

Please check the demos
Yii Bridge Demos/blog
Yii Bridge demos/hangman
Yii Bridge Demos/Helloworld
Yii Bridge demos/phonebook
Yii Bridge User created app demo

== Changelog ==

=0.4 =
*This is the first release version
* Another change.


== Arbitrary section ==
Yii PHP framework 1.1.10
Wordpress 3.3.2
