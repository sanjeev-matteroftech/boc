<?php

require_once '../config/db.php';
require_once '../config/database.class.php';
require_once '../config/functions.php';

$input = array();
$output = array();

foreach ($_POST AS $key => $value) {
    if ($key !== 'submit') {
        if (!empty($value)) {
            if ($key === 'mobile') {
                $mobile = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
                if (validate_mobile($mobile)) {
                    $input[$key] = $mobile;
                } else {
                    $output['status'] = 'error';
                    $output['message'] = $key . ' is in-correct.';
                }
            } elseif ($key === 'email') {
                $email = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
                if (validate_email($email)) {
                    $input[$key] = $email;
                } else {
                    $output['status'] = 'error';
                    $output['message'] = $key . ' is in-correct.';
                }
            } else {
                $input[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
            }
        } else {
            if ($key === 'job_subcategory') {
                $input[$key] = "";
            } else {
                $output['status'] = 'error';
                $output['message'] = $key . ' is required.';
            }
        }
    }
}
//echo json_encode($input);
if (isset($output['status'])) {
    echo json_encode($output);
} else {
    $g = new database($db_config);
    $selectQuery = 'SELECT `id`, `prefix`, `name`, `mobile`, `email`, `c_address` FROM `customers` WHERE `mobile`="' . $input['mobile'] . '"';
    $g->selectQuerySingleRow($selectQuery);
    $result = '';
    $customer_id = '';
    if ($g->rowcount > 0) {
        $customer_id = $g->singleDataSet->id;
        $updateQuery = 'UPDATE `customers` SET `prefix`="' . $input['prefix'] . '", `name`="' . $input['name'] . '", `email`="' . $input['email'] . '", `c_address`="' . $input['c_address'] . '" WHERE `mobile`="' . $input['mobile'] . '"';
        $result = $g->updateQuery($updateQuery);
    } else {
        $query = 'INSERT INTO `customers` (`prefix`, `name`, `mobile`, `email`, `c_address`) VALUES ';
        $query = $query . '(';
        foreach ($input as $key => $value) {
            if ($key === 'prefix' || $key === 'name' || $key === 'mobile' || $key === 'email' || $key === 'c_address') {
                $query = $query . '"' . $value . '",';
            }
        }
        $query = substr($query, 0, -1) . ')';
        // insert in to the database
        $result = $g->insertQuery($query);
        $customer_id = $g->last_insert_id;
    }

    if ($result === TRUE && $customer_id !== '') {
        $c_query = 'INSERT INTO `customer_query` (`landmark`, `looking_for`, `job_category`, `job_subcategory`, `jd`, `expected_date`, `customer_id`) VALUES ';
        // Customer Query Data
        $c_query = $c_query . '("' . $input['landmark'] . '","' . $input['looking_for'] . '","' . $input['job_category'] . '","' . $input['job_subcategory'] . '","' . $input['jd'] . '","' . $input['expected_date'] . '","' . $customer_id . '")';
        $res = $g->insertQuery($c_query);
        if ($res) {
            $output['status'] = 'success';
            $output['message'] = 'Data saved successfully. Please note your reference number of the query' . (1000000 + intval($g->last_insert_id));
        } else {
            $output['status'] = 'error';
            $output['message'] = 'Could not save in to database. Please try again!';
        }
    } else {
        $output['status'] = 'error';
        $output['message'] = 'Could not save in to database. Please try again!';
    }
    $g->close();
    echo json_encode($output);
}
?>

