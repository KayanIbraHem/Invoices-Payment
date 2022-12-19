$(document).ready(function(){
    $('#search').click(function(){
    var user_id= $('#employee_list').val()
    console.log(user_id)
        if(user_id)
        // console.log(user_id);
        {
            $.ajax({
            url:"{{ URL::to('users') }}/"+user_id, 
            method:"GET",
            dataType:"JSON",
            success:function(data)
                {
                    $('#employee_details').css("display", "block");
                    $('#employee_name').text(data.name);
                    $('#employee_address').text(data.address);
                    $('#employee_gender').text(data.gender==0?'Male':'Female');
                    $('#employee_email').text(data.email);
                    $('#employee_type').text(data.is_admin==0?'USER':'ADMIN');
                }
            })
        }
        else
        {
        alert("Please Select Employee");
        $('#employee_details').css("display", "none");
        }
    });

    $('#newuser').click(function(){
    console.log('d')
    $('#users_form').css("display", "block");
    })
    
});