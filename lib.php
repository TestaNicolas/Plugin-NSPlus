<?php
defined('MOODLE_INTERNAL') || die();

function pluginconns_add_instance($pluginconns) {
    global $DB;

    $pluginconns->timecreated = time();
    $pluginconns->timemodified = time();
    $pluginconns->startdate = $pluginconns->startdate;
    $pluginconns->enddate = $pluginconns->enddate;

    return $DB->insert_record('pluginconns', $pluginconns);
}

function pluginconns_update_instance($pluginconns) {
    global $DB;

    $pluginconns->timemodified = time();
    $pluginconns->id = $pluginconns->instance;
    $pluginconns->startdate = $pluginconns->startdate;
    $pluginconns->enddate = $pluginconns->enddate;

    return $DB->update_record('pluginconns', $pluginconns);
}


function pluginconns_delete_instance($id) {
    global $DB;
    if (!$pluginconns = $DB->get_record('pluginconns', array('id' => $id))) {
        return false;
    }
    return $DB->delete_records('pluginconns', array('id' => $pluginconns->id));
}

function pluginconns_extend_settings_navigation(settings_navigation $settingsnav, navigation_node $pluginconnsnode) {
    global $PAGE;

}



