<?php

require_once('../../config.php');
require_once('lib.php');
require_once('mod_form.php');

$id = required_param('id', PARAM_INT); // ID del módulo del curso, o
$n  = optional_param('n', 0, PARAM_INT);  // ID de instancia de pluginconns

if ($id) {
    $cm = get_coursemodule_from_id('pluginconns', $id, 0, false, MUST_EXIST);
    $course = get_course($cm->course);
    $pluginconns = $DB->get_record('pluginconns', array('id' => $cm->instance), '*', MUST_EXIST);
} elseif ($n) {
    $pluginconns = $DB->get_record('pluginconns', array('id' => $n), '*', MUST_EXIST);
    $course = get_course($pluginconns->course);
    $cm = get_coursemodule_from_instance('pluginconns', $pluginconns->id, $course->id, false, MUST_EXIST);
} else {
    print_error('Debes especificar un ID de módulo del curso o un ID de instancia');
}

require_login($course, true, $cm);

$PAGE->set_url('/mod/pluginconns/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($pluginconns->name));
$PAGE->set_heading(format_string($course->fullname));

// Configurar la zona horaria
date_default_timezone_set('UTC');

// Convertir las fechas a formato UTC y sumar 8 horas
$examStartDate = gmdate('Y-m-d\TH:i:s', strtotime('+8 hours', $pluginconns->startdate));
$examEndDate = gmdate('Y-m-d\TH:i:s', strtotime('+8 hours', $pluginconns->enddate));




global $USER;

// Preparar los datos del usuario para pasarlos mediante POST.
$user_info = array(
    'username' => $USER->username, 
    'userId' => $USER->id,
    'userEmail' => $USER->email,
    'userRole' => $USER->role,
    'fullname' => $USER->firstname . ' ' . $USER->lastname,
    'courseName' => $course->fullname,
    'examStartDate' => $examStartDate,
    'examEndDate' => $examEndDate,
    'isExam' => $pluginconns->exammode
);

?>

<form id="redirectForm" method="post" action="index.php">
    <?php foreach ($user_info as $key => $value): ?>
        <input type="hidden" name="<?php echo htmlspecialchars($key); ?>" value="<?php echo htmlspecialchars($value); ?>">
    <?php endforeach; ?>
</form>

<script type="text/javascript">
    document.getElementById('redirectForm').submit();
</script>
