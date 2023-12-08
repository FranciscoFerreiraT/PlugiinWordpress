<?php
/*
Plugin Name: DAM experimento
Plugin URI: http://www.danielcastelao.org/
Description: Experimentación de varias técnicas para hacer un plugin
Version: 1.0
*/


$palabras_a_reemplazar = array(
    'papanatas' => 'GunGin',
    'recorcholis' => 'GinGun',
    'panplinas' => 'GunGan',
    'rayos y centellas' => 'GanGun',
    'caspita' => 'GinGin',
);


add_filter('content_save_pre', 'filtrar_palabras_en_post');

function filtrar_palabras_en_post($content) {
    global $palabras_a_reemplazar;


    foreach ($palabras_a_reemplazar as $palabra_original => $palabra_reemplazo) {
        $content = str_ireplace($palabra_original, $palabra_reemplazo, $content);
    }

    return $content;
}
