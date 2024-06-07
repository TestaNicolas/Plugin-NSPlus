<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_pluginconns_mod_form extends moodleform_mod {
    function definition() {
        $mform = $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('date_time_selector', 'startdate', get_string('startdate', 'pluginconns'));
        $mform->addElement('date_time_selector', 'enddate', get_string('enddate', 'pluginconns'));

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
