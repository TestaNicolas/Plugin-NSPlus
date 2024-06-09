<?php
defined('MOODLE_INTERNAL') || die();

function pluginconns_add_instance($pluginconns) {
    global $DB;

    $pluginconns->timecreated = time();

    // Si el modo examen no está activado, establecer fechas a null
    if (empty($pluginconns->exammode)) {
        $pluginconns->startdate = null;
        $pluginconns->enddate = null;
    }

    $pluginconns->id = $DB->insert_record('pluginconns', $pluginconns);

    return $pluginconns->id;
}

function pluginconns_update_instance($pluginconns) {
    global $DB;

    $pluginconns->timemodified = time();
    $pluginconns->id = $pluginconns->instance;

    // Si el modo examen no está activado, establecer fechas a null
    if (empty($pluginconns->exammode)) {
        $pluginconns->startdate = null;
        $pluginconns->enddate = null;
    }

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
?>
