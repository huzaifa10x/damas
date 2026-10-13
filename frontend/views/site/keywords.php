<?php
if (!empty($doctors)) {
    foreach ($doctors as $doctor) {
        ?>
        <li><?= $language == 'ar' ? $doctor->doctor_name_arabic : $doctor->doctor_name ?></li>
        <?php
    }
}
if (!empty($services)) {
    foreach ($services as $service) {
        ?>
        <li><?= $language == 'ar' ? $service->service_name_arabic : $service->service_name ?></li>
        <?php
    }
}
if (!empty($departments)) {
    foreach ($departments as $department) {
        ?>
        <li><?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?></li>
        <?php
    }
}
?>

