//ajax call for getting project list according to selected category
function getprojects()
    {
        $.ajax({
            url: "categoryprojectlist",
            data: "val="+$('#contract_id').val(),
            type: "post",
        }).done(function(response) {
                $('#project_list').show();
                $(".success").remove();
               $('#project_list').append(response);
            });
    }
//email validation
function validate_email(val)
    {

        var email = val.split(/[;,]+/); // split element by , and ;
        valid = true;
        for (var i in email) {
            if(!validateEmail(email[i])){
                valid = false;
                $("#warning-message").html('Invalid email:'+email[i]);
                $("#schedule").attr('disabled', 'disabled');
            }
        }
        if(valid){
            $("#warning-message").html('');
            $("#schedule").removeAttr('disabled');
        }

    }
//email validaiton
function validateEmail($email)
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if( !emailReg.test( $email ) ) {
            return false;
        } else {
            return true;
        }
    }
//get employee associated with project
function getprojectemp()
    {
        $('#tbl_employee').show();
        $('#tbl_employee').append("<tr><td>"+$('#project_emp option:selected').text()+"</td><td>"+$('#project_emp option:selected').attr('work')+"</td>" +
                                   "<td>"+
                                    "<input type='hidden' name='empid[]' value='"+$('#project_emp').val()+"'>"+
                                    "<input type='text' name='employeeid_"+$('#project_emp').val()+"' id='employee_id_"+$('#project_emp').val()+"'> </td></tr>");
    }
//numeric validation for textbox
function validatePhone(obj)
    {
    	    var number = $(obj).val();
    	    var filter = /^[0-9-+]+$/;
    	    if (filter.test(number))
            {
        	        return true;
        	}
  	        else
            {
        	        $('#warning-message-'+$(obj).attr('id')).html(number+" is not a valid number");
        	 }
    }