<?php
    
/**
* Theme Mode
* dark or light
*/

/**
 *          Dark
 * favicon :  img/e FacTex dark.ico
 * app-logo :  img/FacTex dark.ico
 * 
 *          Light
 * favicon :  img/e FacTex light.ico
 * app-logo : factex light.png
 * 
*/

$theme = "light";

return [

    /**
     * Navbar items
     */

    "theme" => $theme == 'dark' ? "theme-dark" : "theme-light",
    "favicon" => "img/Magasum 2x2.ico",
    "app-logo" => "img/Magasum.png",
    "app-icon" => "img/Magasum 2x2.png",
    "app-name" => "Mâgasum",

]

?>