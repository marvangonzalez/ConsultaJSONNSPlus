<?php
require_once('../../config.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT); // ID del módulo del curso, o
$n  = optional_param('n', 0, PARAM_INT);  // ID de instancia de helloworld

if ($id) {
    $cm         = get_coursemodule_from_id('helloworld', $id, 0, false, MUST_EXIST);
    $course     = get_course($cm->course);
    $helloworld = $DB->get_record('helloworld', array('id' => $cm->instance), '*', MUST_EXIST);
} elseif ($n) {
    $helloworld = $DB->get_record('helloworld', array('id' => $n), '*', MUST_EXIST);
    $course     = get_course($helloworld->course);
    $cm         = get_coursemodule_from_instance('helloworld', $helloworld->id, $course->id, false, MUST_EXIST);
} else {
    print_error('Debes especificar un ID de módulo del curso o un ID de instancia');
}

require_login($course, true, $cm);

$PAGE->set_url('/mod/helloworld/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($helloworld->name));
$PAGE->set_heading(format_string($course->fullname));

// Encolar los archivos CSS y JS necesarios
$PAGE->requires->css('/mod/helloworld/ns/css/XNSDiagram.css');
$PAGE->requires->js('/mod/helloworld/ns/js/XNS-core/html2canvas.js');
$PAGE->requires->js('/mod/helloworld/js/XNS-core/Enumeration.js');
$PAGE->requires->js('/mod/helloworld/js/XNS-core/ClassConstructor.js');
$PAGE->requires->js('/mod/helloworld/js/XNS-core/BaseDiagram.js');
$PAGE->requires->js('/mod/helloworld/js/XNS-core/DiagramObject.js');
$PAGE->requires->js('/mod/helloworld/js/XNS-core/XNSDiagram.js');
$PAGE->requires->js('/mod/helloworld/js/XNS-editor/NSPProject.js');

global $USER;           // Se accede a la variable global $USER que contiene información del usuario actual.
$current_user = $USER;  // Se asigna la variable global $USER a la variable $current_user.

// Preparar los datos del usuario para pasarlos mediante POST.
$user_info = array(
    'username' => $current_user->username, // Se agrega el nombre de usuario del usuario.
    'course_fullname' => $course->fullname // Se agrega el nombre completo del curso.
);

?>

<form id="redirectForm" method="post" action="ns/index.php"> <!-- Formulario que se enviará mediante POST a 'ns/index.php' -->
    <?php foreach ($user_info as $key => $value): ?>
        <input type="hidden" name="<?php echo htmlspecialchars($key); ?>" value="<?php echo htmlspecialchars($value); ?>">
    <?php endforeach; ?>
</form>

<script type="text/javascript">
    document.getElementById('redirectForm').submit(); // Se envía automáticamente el formulario al cargar la página
</script>
