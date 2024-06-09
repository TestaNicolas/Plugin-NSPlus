<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_pluginconns_mod_form extends moodleform_mod {
    function definition() {
        global $CFG, $DB;
        $mform = $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Agregar el checkbox para "Modo Examen"
        $mform->addElement('advcheckbox', 'exammode', get_string('exammode', 'pluginconns'), get_string('exammode_desc', 'pluginconns'));
        $mform->setType('exammode', PARAM_INT);

        // Recuperar el valor de 'exammode' de la base de datos
        if ($this->_instance) {
            $record = $DB->get_record('pluginconns', array('id' => $this->_instance), '*', MUST_EXIST);
            $mform->setDefault('exammode', $record->exammode);
        }

        // Agregar los campos de fecha
        $mform->addElement('date_time_selector', 'startdate', get_string('startdate', 'pluginconns'));
        $mform->disabledIf('startdate', 'exammode', 'notchecked');

        $mform->addElement('date_time_selector', 'enddate', get_string('enddate', 'pluginconns'));
        $mform->disabledIf('enddate', 'exammode', 'notchecked');

        if ($this->_instance) {
            $mform->setDefault('startdate', $record->startdate);
            $mform->setDefault('enddate', $record->enddate);
        }

        $this->standard_intro_elements();

        $this->standard_coursemodule_elements();

        $this->add_action_buttons();
    }


function data_preprocessing(&$default_values) {
    if (isset($default_values['startdate'])) {
        $default_values['startdate'] = $default_values['startdate'];
    }
    if (isset($default_values['enddate'])) {
        $default_values['enddate'] = $default_values['enddate'];
    }
}
}
?>
