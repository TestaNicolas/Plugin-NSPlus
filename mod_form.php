<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_pluginconns_mod_form extends moodleform_mod {

    function definition() {
        global $CFG, $DB;
        $mform = $this->_form;

        // Modo Examen section header
        $mform->addElement('header', 'exammodeheader', get_string('exammodeheader', 'pluginconns'));

        // Add the checkbox for "Exam Mode"
        $mform->addElement('advcheckbox', 'exammode', get_string('exammode', 'pluginconns'), get_string('exammode_desc', 'pluginconns'));
        $mform->setType('exammode', PARAM_BOOL);
        $mform->addHelpButton('exammode', 'helpidentifier', 'pluginconns');

        // Add date fields
        $mform->addElement('date_time_selector', 'startdate', get_string('startdate', 'pluginconns'));
        $mform->disabledIf('startdate', 'exammode', 'notchecked');
        $mform->addElement('date_time_selector', 'enddate', get_string('enddate', 'pluginconns'));
        $mform->disabledIf('enddate', 'exammode', 'notchecked');

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
        if (isset($default_values['exammode'])) {
            $default_values['exammode'] = (bool)$default_values['exammode'];
        }
    }

}
?>
