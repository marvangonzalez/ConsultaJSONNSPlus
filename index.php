<?php
require_once('../../config.php');

$id = required_param('id', PARAM_INT);   // Course ID

if (!$course = $DB->get_record('course', array('id' => $id))) {
    print_error('invalidcourseid');
}

require_course_login($course);
$context = context_course::instance($course->id);

$PAGE->set_url('/mod/helloworld/index.php', array('id' => $id));
$PAGE->set_title(format_string($course->fullname));
$PAGE->set_heading(format_string($course->fullname));

echo $OUTPUT->header();
echo $OUTPUT->heading('Hello World instances');
echo $OUTPUT->footer();
