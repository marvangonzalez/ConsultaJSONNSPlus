<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_helloworld_mod_form extends moodleform_mod {
    function definition() {
        global $CFG;
        $mform = $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('helloworldname', 'helloworld'), array('size'=>'64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'helloworldname', 'helloworld');

        $mform->addElement('date_selector', 'startdate', get_string('startdate', 'helloworld'));
        $mform->addElement('date_selector', 'enddate', get_string('enddate', 'helloworld'));

        // Procesar el envío del formulario Moodle
        if (isset($_POST['submit'])) {
            $eveValue = $_['eve'];
            $evsValue = $_['evs'];

            // Validar datos (opcional)

            // Codificar valores en JSON
            $jsonData = json_encode(['eve' => $eveValue, 'evs' => $evsValue]);
            }
        
        $this->standard_intro_elements();

        $this->standard_coursemodule_elements();

        $this->add_action_buttons();
    }
}
