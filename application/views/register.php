<html>
<head>
    <title>Patient Registration System</title>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="container">
        <br />
        <h3 align="center">Patient Registration System</h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="panel-title">List of patients</h3>
                    </div>
                    <div class="col-md-6" align="right">
                        <button type="button" id="add_button" class="btn btn-info btn-xs">Add</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span id="success_message"></span>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birth date</th>
                            <th>Email address</th>
                            <th>Phone no</th>
                            <th>City</th>
                            <th colspan='2'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<div id="patientModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="patient_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Patient</h4>
                </div>
                <div class="modal-body">
                    <label>First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" />
                    <span id="first_name_error" class="text-danger"></span>
                    <br />
                    <label>Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" />
                    <span id="last_name_error" class="text-danger"></span>
                    <br />
                    <label>Birth date</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control" />
                    <span id="birth_date_error" class="text-danger"></span>
                    <br />
                    <label>Sex</label>
                    <select name="sex" id="sex" class="form-control">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <span id="birth_date_error" class="text-danger"></span>
                    <br />
                    <label>Email address</label>
                    <input type="text" name="email" id="email" class="form-control" />
                    <span id="email_error" class="text-danger"></span>
                    <br />
                    <label>Phone no</label>
                    <input type="text" name="phone" id="phone" class="form-control" />
                    <span id="phone_error" class="text-danger"></span>
                    <br />
                    <label>Address</label>
                    <input type="text" name="address" id="address" class="form-control" />
                    <span id="address_error" class="text-danger"></span>
                    <br />
                    <label>City</label>
                    <input type="text" name="city" id="city" class="form-control" />
                    <span id="city_error" class="text-danger"></span>
                    <br />
                    <label>Postcode</label>
                    <input type="text" name="postcode" id="postcode" class="form-control" />
                    <span id="postcode_error" class="text-danger"></span>
                    <br />
                    <label>Reason of registration</label>
                    <input type="text" name="reason" id="reason" class="form-control" />
                    <span id="reason_error" class="text-danger"></span>
                    <br />
                    <label>Additional note</label>
                    <textarea name="note" id="note" class="form-control"></textarea>
                    <br />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="patient_id" id="patient_id" />
                    <input type="hidden" name="data_action" id="data_action" value="Insert" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
    
    function fetch_data()
    {
        $.ajax({
            url:"<?php echo base_url(); ?>test_api/action",
            method:"POST",
            data:{data_action:'fetch_all'},
            success:function(data)
            {
                $('tbody').html(data);
            }
        });
    }

    fetch_data();

    $('#add_button').click(function(){
        $('#patient_form')[0].reset();
        $('.modal-title').text("Add Patient");
        $('#action').val('Add');
        $('#data_action').val("Insert");
        $('#patientModal').modal('show');
    });

    $(document).on('submit', '#patient_form', function(event){
        event.preventDefault();
        $.ajax({
            url:"<?php echo base_url() . 'test_api/action' ?>",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
                if(data.success)
                {
                    $('#patient_form')[0].reset();
                    $('#patientModal').modal('hide');
                    fetch_data();
                    if($('#data_action').val() == "Insert")
                    {
                        $('#success_message').html('<div class="alert alert-success">New patient Inserted successfully</div>');
                    }
                }

                if(data.error)
                {
                    $('#first_name_error').html(data.first_name_error);
                    $('#last_name_error').html(data.last_name_error);
                    $('#birth_date_error').html(data.birth_date_error);
                    $('#email_error').html(data.email_error);
                    $('#phone_error').html(data.phone_error);
                    $('#address_error').html(data.address_error);
                    $('#city_error').html(data.city_error);
                    $('#postcode_error').html(data.postcode_error);
                    $('#reason_error').html(data.reason_error);
                    $('#sex_error').html(data.sex_error);
                }
            }
        })
    });

    $(document).on('click', '.edit', function(){
        var patient_id = $(this).attr('id');
        $.ajax({
            url:"<?php echo base_url(); ?>test_api/action",
            method:"POST",
            data:{patient_id:patient_id, data_action:'fetch_single'},
            dataType:"json",
            success:function(data)
            {
                $('#patientModal').modal('show');
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#birth_date').val(data.birth_date);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#address').val(data.address);
                $('#city').val(data.city);
                $('#postcode').val(data.postcode);
                $('#reason').val(data.reason);
                $('#note').val(data.note);
                $('#sex').val(data.sex);
                $('.modal-title').text('Edit Patient');
                $('#patient_id').val(patient_id);
                $('#action').val('Edit');
                $('#data_action').val('Edit');
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var patient_id = $(this).attr('id');
        if(confirm("Are you sure you want to delete this patient?"))
        {
            $.ajax({
                url:"<?php echo base_url(); ?>test_api/action",
                method:"POST",
                data:{patient_id:patient_id, data_action:'Delete'},
                dataType:"JSON",
                success:function(data)
                {
                    if(data.success)
                    {
                        $('#success_message').html('<div class="alert alert-success">This patient deleted successfully</div>');
                        fetch_data();
                    }
                }
            })
        }
    });
    
});
</script>