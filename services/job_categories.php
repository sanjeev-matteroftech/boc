<?php

require_once '../config/db.php';
require_once '../config/database.class.php';
require_once '../config/functions.php';

if (isset($_POST['option'])) {
    $option = sanitize($_POST['option']);
    // DB Object
    $g = new database($db_config);

    if ($option === 'get_jobs') {
        $selectQuery = 'SELECT `id`, `name`, `description`, `order_by`, `modified` FROM `jobs` ORDER BY `order_by`';
        $g->selectQuerySingleRow($selectQuery);
        $output = '<option value="">Select Job</option>';
        for ($i = 0; $i < $g->rowcount; $i++) {
            $output = $output . '<option value="' . $g->singleDataSet->id . '">' . $g->singleDataSet->name . '</option>';
            $g->getNextRow();
        }
        $g->close();
        echo $output;
    } elseif ($option === 'get_category') {
        $looking_for = sanitize($_POST['looking_for']);
        // Get Category
        $selectQuery = 'SELECT `id`, `name`, `description`, `modified` FROM `job_category` WHERE `job_id`="' . $looking_for . '"';
        $g->selectQuerySingleRow($selectQuery);
        $output = '<option value="">Select Job Category</option>';
        for ($i = 0; $i < $g->rowcount; $i++) {
            $output = $output . '<option value="' . $g->singleDataSet->id . '">' . $g->singleDataSet->name . '</option>';
            $g->getNextRow();
        }
        // Sub Category
        $selectQuery = 'SELECT `id`, `name`, `description`, `modified` FROM `job_subcategory` WHERE `job_id`="' . $looking_for . '"';
        $g->selectQuerySingleRow($selectQuery);
        $output12 = '<option value="">Select Job Sub-Category</option>';
        for ($i = 0; $i < $g->rowcount; $i++) {
            $output12 = $output12 . '<option value="' . $g->singleDataSet->id . '">' . $g->singleDataSet->name . '</option>';
            $g->getNextRow();
        }
        $g->close();
        echo $output . '~' . $output12;
    }
}
?>