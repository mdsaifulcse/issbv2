
$("#edit_user").validate(
    {
        ignore: [],
        debug: false,
        rules: {
            edit_email:{
                required: true,
                email: true
            },
            edit_password:{
                minlength:8

            },
            edit_confirm_password:{
                minlength:8,
                equalTo: "#edit_password"
            }

        },
        messages: {

            edit_email: {
                required:"please enter email address",
                email: "please enter a valid email address"
            },
            edit_password: {
                minlength: "Your password length have to be at least 8 characters"
            },
            edit_confirm_password: {
                required: "Please enter your password again",
                equalTo:"Your given password is not a match with this one"
            }


        },
        errorPlacement: function(error, element)
        {
            $(element).parent('div').after().append(error[0]);

        },
        submitHandler: function(form) {
            var id = $('#edit_id').val();
            var formData = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: '/users/' + id,
                data:formData,
                processData: false,
                contentType: false,
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async: true,
                success: function(response) {
                    if (response == 'success')
                    {
                        sessionStorage.setItem("update_success", "success");
                        window.location.reload();
                    }
                },
                error: function (e) {
                    toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})

                }
            });

            return false;

        }


    });