<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <!-- CSS goes in the document HEAD or added to your external stylesheet -->
        <style type="text/css">
            table.gridtable {
                width: 100%;
                font-family: verdana,arial,sans-serif;
                font-size:11px;
                color:#333333;
                border-width: 1px;
                border-color: #666666;
                border-collapse: collapse;
            }
            table.gridtable th {
                border-width: 1px;
                padding: 8px;
                border-style: solid;
                border-color: #666666;
                background-color: #dedede;
            }
            table.gridtable td {
                border-width: 1px;
                padding: 8px;
                border-style: solid;
                border-color: #666666;
                background-color: #ffffff;
            }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
        <script>
            $(document).ready(function () {
                // Remove Red Borders
                $('.forJSON').click(function () {
                    $(this).css('border-color', '');
                    $('#error').html('');
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
                    },
                    success: function (response)
                    {
                        var result = jQuery.parseJSON(response);
                        if (result.status === 'customer') {
                            $("#error").removeClass('alert-danger');
                            $("#error").addClass('alert-success');
                            var table = '<table class="gridtable"><th>Prefix</th><th>Name</th><th>Mobile</th><th>Email</th><th>Correspondence Address</th><th>Action</th>';
                            table = table + '<tr>';
                            table = table + '<td>' + result.message.prefix + '</td>';
                            table = table + '<td>' + result.message.name + '</td>';
                            table = table + '<td>' + result.message.mobile + '</td>';
                            table = table + '<td>' + result.message.email + '</td>';
                            table = table + '<td>' + result.message.c_address + '</td>';
                            table = table + '<td><a href="new_customer.php?cstmr_id=' + result.message.id + '">Add Query</a></td>';
                            table = table + '</tr>';
                            table = table + '</table>';
                            $("#results").html(table);
                        } else if (result.status === 'query') {
                            $("#error").removeClass('alert-danger');
                            $("#error").addClass('alert-success');
                            var table = '<table class="gridtable"><th>Landmark</th><th>Looking For</th><th>Job Category</th><th>Job Sub-Category</th><th>Job Description</th><th>Expected Date</th><th>Action</th>';
                            table = table + '<tr>';
                            table = table + '<td>' + result.message.landmark + '</td>';
                            table = table + '<td>' + result.message.looking_for + '</td>';
                            table = table + '<td>' + result.message.job_category + '</td>';
                            table = table + '<td>' + result.message.job_subcategory + '</td>';
                            table = table + '<td>' + result.message.jd + '</td>';
                            table = table + '<td>' + result.message.expected_date + '</td>';
                            table = table + '<td><a href="new_customer.php?cstmr_id=' + result.message.customer_id + '">+ Add Query</a></td>';
                            table = table + '</tr>';
                            table = table + '</table>';
                            $("#results").html(table);
                        } else {
                            $("#error").removeClass('alert-success');
                            $("#error").addClass('alert-danger');
                            $("#results").html(result.message);
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
        <div style="position: absolute; left: 20%; top: 0%; width: 70%; height: 100%; overflow: auto; background-color: lightgoldenrodyellow;">
            <h2 align="center">Home</h2><hr><br>
            <div id="error" style="position: absolute; left: 10%; top: 15%; width: 80%; height: 5%; padding: 1%; background-color: lightgoldenrodyellow;" align="center">
                <!--<font color="red">Error : Server Connection time out.</font>-->
            </div>
            <div id="content" style="position: absolute; top: 20%; width: 100%; overflow: auto; background-color: lightgoldenrodyellow;">
                <h3>Search Customer </h3><br>
                <form id="myForm" name="myForm" action="services/search.php" method="POST">
                    <legend>Reference Number : 
                        <input class="forJSON" id="search_keyword" name="search_keyword" type="text" size="60" placeholder="search with mobile number or reference number..">
                        <input type="submit" id="search" name="search" value="Search">
                    </legend>
                </form><hr>
                <strong>Results : </strong>
                <div id="results">
                    <p>none</p>
                </div>
            </div>
        </div>
    </body>
</html>
