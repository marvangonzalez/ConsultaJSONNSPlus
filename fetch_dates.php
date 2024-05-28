<?php

require_once('../../config.php');

$id = required_param('id', ); // Course Module ID
$cm = get_coursemodule_from_id('myplugin', $id, 0, false, MUST_EXIST);
$context = context_module::instance($cm->id);

require_login($cm->course, true, $cm);
$PAGE->set_url('/mod/myplugin/fetch_dates.php', array('id' => $id));
$PAGE->set_context($context);

// Obtener los datos de la instancia del plugin
$instance = $DB->get_record('myplugin', array('id' => $cm->instance), '*', MUST_EXIST);

// Acceder a las fechas de inicio y finalización


header('Content-Type: application/json');
echo json_encode($response);

?>
