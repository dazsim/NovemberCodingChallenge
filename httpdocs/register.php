<?php 
    //include all required classes
    include_once("users.php");
    include_once("configcode.php");
    $configs = new configcode("config.php");
    session_start();
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta charset="utf-8">
  <title>Simple Login System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- stylesheets -->
  
  <style type="text/css" media="screen"><!--
/*------------------------------------------------------------
Style.css
Created by: Dave Rupert
Contact: https://github.com/davatron5000/foldy960
Copyright 2012
License: WTFPL + "Not going to maintain this because
the rent is too damn high licence."
--------------------------------------------------------------*/
/* Responsive Resets
-------------------------------------------------------------- */
@-o-viewport {
width: device-width;
}
@-ms-viewport {
width: device-width;
}
@viewport {
width: device-width;
}
html {
overflow-y: auto;
}
img,
audio,
video,
canvas {
max-width: 100%;
}
/* Grid > 6 Column Mobile First
-------------------------------------------------------------- */
.container {
/*
The `max-width` property is the width governer. I dare you to experiment
with setting this larger, something like 1280px.
*/
max-width: 1280px;
width:92%;
margin:0px auto;
position: relative;
}
.row {
clear: both;
}
@media screen and (min-width: 480px) {
.container {
width: 98%;
}
.grid-1,
.grid-2,
.grid-3,
.grid-4,
.grid-5,
.grid-6,
.grid-half,
.grid-full,
.grid-unit {
float: left;
width:96.969696969697%;
margin:0 1.515151515152% 1em;
}
.gallery .grid-unit,
.grid-half {
width:46.969696969697%;
margin: 0 1.515151515152% 1em;
}
.grid-flow-opposite{
float:right
}
}
@media screen and (min-width: 640px) {
.grid-1 { width: 13.636363636364%; }
.grid-2 { width: 30.30303030303%; }
.grid-3,
.grid-half { width: 46.969696969697%; }
.grid-4 { width: 63.636363636364%; }
.grid-5 { width: 80.30303030303%; }
.grid-6,
.grid-full { width: 96.969696969697%; }
.gallery .grid-unit {
width: 30.30303030303%;
}
.content-pad-right {
padding-right: 4%; /* Use (or don't) as necessary. */
}
.content-pad-left {
padding-left: 4%;
}
}
/* Micro Clearfix - https://nicolasgallagher.com/micro-clearfix-hack/
For best results, use your favorite clearfix here.
-------------------------------------------------------------- */
.cf:before, .cf:after { content:""; display:table; }
.cf:after { clear:both; }
.cf { zoom:1; } /* For IE 6/7 (trigger hasLayout) */
/* Layout
-------------------------------------------------------------- */
body {
font: 100%/1.5 sans-serif;
}
section {
margin-bottom: 2em;
}
footer {
font-size: 0.9em;
border-top: 1px solid #ccc;
padding: 0.5em 0 2.5em;
}
/* Typography
-------------------------------------------------------------- */
.heading {
font-size: 3em;
margin: 0;
}
.sub-heading {
font-size: 2em;
margin-bottom: 0.5em;
}
a {
color: #0066cc;
}
a:focus,
a:hover {
color: #003399;
}
/* Elements
-------------------------------------------------------------- */
figure {
margin: 0;
background: #f8f8f8;
}
figcaption {
padding: 0.5em 1em 1em;
font-size: 0.875em;
}
code {
padding: 0.5em;
background: #efefef;
}
/* Helpers
-------------------------------------------------------------- */
.show-grid div[class*='grid-'] {
background-color: #eee;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
display: block;
padding: 0.5em 1em;
margin-bottom: 1em;
text-align: center;
}
.errorStyle {
    color: #f00;
}
.successStyle { 
    color: #0f0;
}
-->
  </style>
<!-- javascripts --><!--[if IE]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<section id="content">
</section>
<div class="container">
    <section class="cf">
    </section>
        <div class="grid">
            Register New User : 
        </div>
        <div class="grid">
            <form action="/regresponse.php" method="post">
            <fieldset>
                <legend>Login:</legend>
                Username:<br>
                <input type="text" name="username" /> <br>
                Email:<br>
                <input type="text" name="email" /> <br>
                Password:<br>
                <input type="password" name="password" /> <br>
                Repeat Password:<br>
                <input type="password" name="passwordConfirm" /> <br>
                <input type="submit" name="register" value="Register">
            </fieldset>
            </form>
        </div>
    </div>
    <div class="grid">
    <?php 
        //This block of code displays any errors or other messages in the template.
        if (isset($_GET['messagetype']))
        {
            switch ($_GET['messagetype'])
            {
                case "error":
                    //insert error message here
                    echo "<div class=\"errorStyle\">".$_GET['message']."</div>";
                    break;
                case "sucess":
                    //insert success message here
                    echo "<div class=\"successStyle\">".$_GET['message']."</div>";
                    break; //redundant but included for completeness
            }
        }
    ?></div>
</body>
</html>

