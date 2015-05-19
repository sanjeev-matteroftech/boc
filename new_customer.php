<?php
$cstmr_id = '';
if (isset($_GET['cstmr_id'])) {
    $cstmr_id = filter_input(INPUT_GET, 'cstmr_id', FILTER_SANITIZE_NUMBER_INT);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Module : Customer</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
        <script>
            $(document).ready(function () {
                // Get Customer Details with id
                var cstmr_id = "<?php echo $cstmr_id; ?>";
                if (cstmr_id !== '') {
                    // Get the details of customer
                    jQuery.ajax({
                        type: "POST",
                        url: "services/search.php",
                        data: "customer_id=" + cstmr_id,
                        success: function (msg) {
                            var res = jQuery.parseJSON(msg);
                            if (res.status !== 'no') {
                                // update form with customer data
                                $('#prefix option').each(function () {
                                    if ($(this).val() === res.status.prefix) {
                                        $(this).attr('selected', true);
                                    } else {
                                        $(this).attr('selected', false);
                                    }
                                });
                                $('#name').val(res.status.name);
                                $('#mobile').val(res.status.mobile);
                                $('#email').val(res.status.email);
                                $('#c_address').val(res.status.c_address);
//                                console.log(res.status.id);
                            }
                        }
                    });
                }
                // Get List of Looking For
                jQuery.ajax({
                    type: "POST",
                    url: "services/job_categories.php",
                    data: "option=get_jobs",
                    success: function (msg) {
                        jQuery('#looking_for').html(msg);
                    }
                });
                // Looking For Change event
                $('#looking_for').change(function () {
                    var looking_for = $(this).val();
                    jQuery.ajax({
                        type: "POST",
                        url: "services/job_categories.php",
                        data: "option=get_category&looking_for=" + looking_for,
                        success: function (msg) {
                            var res = msg.split('~');
                            jQuery('#job_category').html(res[0]);
                            jQuery('#job_subcategory').html(res[1]);
                        }
                    });
                    $('#job_category_legend').show();
                    $('#job_subcategory_legend').show();
                });

                // Remove Red Borders
                $('.forJSON').click(function () {
                    $(this).css('border-color', '');
                });
                // Reset Form
                $('#reset').click(function () {
                    $('.forJSON').each(function () {
                        $(this).val('');
                    });
                });

                // AJAX POST
                var options = {
                    beforeSend: function ()
                    {
                        var alert = '';
                        $('.forJSON').each(function () {
                            if ($(this).attr('id') === 'job_subcategory') {
                                return;
                            }
                            if ($(this).val() === '') {
                                alert = "Please enter the required fields.";
                                $(this).css('border-color', 'red');
                            }
                        });
                        if (alert !== '') {
                            $('#error').html('<font color="red">' + alert + '</font>');
                            return false;
                        }
                        if (!confirm('Are you sure to submit ?')) {
                            return false;
                        }
                    },
                    success: function (response)
                    {
                        var result = jQuery.parseJSON(response);
                        if (result.status === 'success') {
                            $("#error").removeClass('alert-danger');
                            $("#error").addClass('alert-success');
                            $("#error").html('<font color="red">' + result.message + '</font>');
                        } else {
                            $("#error").removeClass('alert-success');
                            $("#error").addClass('alert-danger');
                            $("#error").html('<font color="red">' + result.message + '</font>');
                        }
                    },
                    error: function (response)
                    {
                        $('#error').html(response);
                    }
                };
                $('#myForm').ajaxForm(options);
            });
        </script>
    </head>
    <body>
        <?php
        // put your code here
        require_once './inc/menu.php';
        ?>
        <div style="position: absolute; left: 20%; top: 0%; width: 70%; height: 120%; background-color: lightgoldenrodyellow;">
            <h2>Module : Customer</h2><hr><br>
            <div id="error" style="position: absolute; left: 10%; top: 10%; width: 80%; height: 5%; padding: 1%; background-color: lightgoldenrodyellow;">
                <!--<font color="red">Error : Server Connection time out.</font>-->
            </div>
            <div id="content" style="position: absolute; top: 15%; width: 60%; background-color: lightgoldenrodyellow;" align="right">
                <h4 align="left">Add Customer / Query</h4><hr>
                <form id="myForm" name="myForm" action="services/newcustomer.php" method="POST">
                    <legend>Full Name :
                        <select class="forJSON" id="prefix" name="prefix">
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Dr.">Dr.</option>
                        </select> &nbsp;&nbsp;

                        <input class="forJSON" id="name" name="name" type="text" size="40" placeholder="* write your full name..">
                    </legend><br>
                    <legend>Mobile Number : <input class="forJSON" id="mobile" name="mobile" type="tel" size="40" placeholder="* mobile number"></legend><br>
                    <legend>Email Address : <input class="forJSON" id="email" name="email" type="email" size="40" placeholder=" email address"></legend><br>
                    <legend>Correspondence Address : <textarea class="forJSON" id="c_address" name="c_address" cols="42" rows="3" placeholder="* Correspondence Address"></textarea></legend><br>
                    <legend>Nearest Landmark : <input class="forJSON" id="landmark" name="landmark" type="text" size="40" placeholder=" nearest landmark"></legend><br>
                    <legend>Looking For : 
                        <select class="forJSON" id="looking_for" name="looking_for" style="width: 315px;">
                            <option value="">Select Job</option>
                        </select>
                    </legend><br>
                    <legend id="job_category_legend" style="display: none;">Job Category : 
                        <select class="forJSON" id="job_category" name="job_category" style="width: 315px;">
                            <option value="">Select Job category</option>
                        </select>
                    </legend><br>
                    <legend id="job_subcategory_legend" style="display: none;">Job Sub-Category : 
                        <select class="forJSON" id="job_subcategory" name="job_subcategory" style="width: 315px;">
                            <option value="">Select Job Sub-Category</option>
                        </select>
                    </legend><br>
                    <legend>Job Description : <textarea class="forJSON" id="jd" name="jd" cols="42" rows="3" placeholder="* Job Description"></textarea></legend><br>
                    <legend>Expected Date-Time : <input class="forJSON" id="expected_date" name="expected_date" type="datetime-local" ></legend><br>

                    <p><input type="button" id="reset" name="reset" value="Reset"><label> </label><input type="submit" id="submit" name="submit" value="Submit"></p>
                </form><hr>
            </div>
        </div>

    </body>
</html>