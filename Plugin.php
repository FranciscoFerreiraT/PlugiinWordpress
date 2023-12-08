<?php
/*
Plugin Name: DAM experimento
Plugin URI: http://www.danielcastelao.org/
Description: Experimentación de vaarias técnicas para hacer un plugin
Version: 1.0
*/

// Función para obtener las palabras desde la base de datos
function obtener_palabras_desde_bd() {
    global $wpdb;
    $tabla_palabras = $wpdb->prefix . 'Base_de_datos_palabras';

    // Realiza la consulta SQL para obtener las palabras
    $query = "SELECT palabra_original, palabra_reemplazo FROM $tabla_palabras";
    $resultados = $wpdb->get_results($query, ARRAY_A);

    $palabras_a_reemplazar = array();
    foreach ($resultados as $fila) {
        $palabras_a_reemplazar[$fila['palabra_original']] = $fila['palabra_reemplazo'];
    }

    return $palabras_a_reemplazar;
}

add_filter('content_save_pre', 'filtrar_palabras_en_post');

function filtrar_palabras_en_post($content) {
    $palabras_a_reemplazar = obtener_palabras_desde_bd();

    foreach ($palabras_a_reemplazar as $palabra_original => $palabra_reemplazo) {
        $content = str_ireplace($palabra_original, $palabra_reemplazo, $content);
    }

    return $content;
}
