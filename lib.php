<?php
defined('MOODLE_INTERNAL') || die();

function helloworld_add_instance($helloworld) {
    global $DB;
    $helloworld->timecreated = time();

    $helloworld->startdate = $helloworld->startdate;
    $helloworld->enddate = $helloworld->enddate;

    return $DB->insert_record('helloworld', $helloworld);
    
}

function helloworld_update_instance($helloworld) {
    global $DB;
    $helloworld->timemodified = time();
    $helloworld->id = $helloworld->instance;
    $helloworld->startdate = $helloworld->startdate;
    $helloworld->enddate = $helloworld->enddate;
    return $DB->update_record('helloworld', $helloworld);
}

function helloworld_delete_instance($id) {
    global $DB;
    if (!$helloworld = $DB->get_record('helloworld', array('id' => $id))) {
        return false;
    }
    return $DB->delete_records('helloworld', array('id' => $helloworld->id));
}

function helloworld_extend_settings_navigation(settings_navigation $settingsnav, navigation_node $helloworldnode) {
    global $PAGE;

    // Encolar los archivos CSS y JS
    $PAGE->requires->css('/mod/helloworld/ns/css/XNSDiagram.css');
    $PAGE->requires->js('/mod/helloworld/ns/js/XNS-core/html2canvas.js');
    $PAGE->requires->js('/mod/helloworld/ns/js/XNS-core/Enumeration.js');
    $PAGE->requires->js('/mod/helloworld/ns/js/XNS-core/ClassConstructor.js');
    $PAGE->requires->js('/mod/helloworld/ns/js/XNS-core/BaseDiagram.js');
    $PAGE->requires->js('/mod/helloworld/ns/js/XNS-core/DiagramObject.js');
    $PAGE->requires->js('/mod/helloworld/ns/js/XNS-core/XNSDiagram.js');
    // aca agrega la direccion a las fechas al ns
    //$PAGE->requires->js('/mod/helloworld/ns/js/XNS-core/XNSDiagram.js');
}



