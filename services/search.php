<?php

require_once '../config/db.php';
require_once '../config/database.class.php';
require_once '../config/functions.php';

// DB Object
$d = new database($db_config);
if (isset($_POST['search_keyword'])) {
    $search_keyword = sanitize($_POST['search_keyword']);
    if (!is_nan($search_keyword)) {
        $query = '';
        if (validate_mobile($search_keyword)) {
            $query = 'SELECT `id`, `prefix`, `name`, `mobile`, `email`, `c_address` FROM `customers` WHERE `mobile`="' . $search_keyword . '"';
            $result = $d->selectQuerySingleRow($query);
            if ($d->rowcount > 0) {
                echo '{"status":"customer","message":{"id":"' . $d->singleDataSet->id . '","prefix":"' . $d->singleDataSet->prefix . '","name":"' . $d->singleDataSet->name . '","mobile":"' . $d->singleDataSet->mobile . '","email":"' . $d->singleDataSet->email . '","c_address":"' . $d->singleDataSet->c_address . '"}}';
            } else {
                echo '{"status":"error","message":"User does not exist. <a href="new_customer.php">Add Customer</a>"}';
            }
        } else {
            $reference_no = intval($search_keyword) - 1000000;
            $query = 'SELECT `id`, `landmark`, `looking_for`, `job_category`, `job_subcategory`, `jd`, `expected_date`, `customer_id` FROM `customer_query` WHERE `id`="' . $reference_no . '"';
            $result = $d->selectQuerySingleRow($query);
            if ($d->rowcount > 0) {
                echo '{"status":"query","message":{"id":"' . $d->singleDataSet->id . '","landmark":"' . $d->singleDataSet->landmark . '","looking_for":"' . $d->singleDataSet->looking_for . '","job_category":"' . $d->singleDataSet->job_category . '","job_subcategory":"' . $d->singleDataSet->job_subcategory . '","jd":"' . $d->singleDataSet->jd . '","expected_date":"' . $d->singleDataSet->expected_date . '","customer_id":"' . $d->singleDataSet->customer_id . '"}}';
            } else {
                echo '{"status":"error","message":"Query with this reference number does not exist. Please try again!"}';
            }
        }
    } else {
        echo '{"status":"error","message":"Please enter either mobile number or Query Reference number.Search Keyword is not valid!"}';
    }
} elseif (isset($_POST['customer_id'])) {
    $customer_id = filter_input(INPUT_POST, "customer_id", FILTER_SANITIZE_NUMBER_INT);
    $query = 'SELECT `id`, `prefix`, `name`, `mobile`, `email`, `c_address` FROM `customers` WHERE `id`="' . $customer_id . '"';
    $d->selectQuerySingleRow($query);
    $output = '';
    if ($d->rowcount > 0) {
        $output = $output . '{"status":{"id":"' . $d->singleDataSet->id . '","prefix":"' . $d->singleDataSet->prefix . '","name":"' . $d->singleDataSet->name . '","mobile":"' . $d->singleDataSet->mobile . '","email":"' . $d->singleDataSet->email . '","c_address":"' . $d->singleDataSet->c_address . '"}}';
    } else {
        $output = $output . '{"status":"no"}';
    }
    $d->close();
    echo $output;
} else {
    // Do Nothing
}
?>