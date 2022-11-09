
$("#add_user").validate(
    {
        ignore: [],
        debug: false,
        rules: {
            email:{
                required: true,
                email: true
            },
            password:{
                required:true,
                minlength:8,

            },
            confirm_password:{
                required:true,
                minlength:8,
                equalTo: "#password"
            }

        },
        messages: {

            email: {
                required:"please enter email address",
                email: "please enter a valid email address"
            },
            password: {
                required: "Please enter your password",
                minlength: "Your password length have to be at least 8 characters"
            },
            confirm_password: {
                required: "Please enter your password again",
                equalTo:"Your given password is not a match with this one"
            }


        },
        errorPlacement: function(error, element)
        {
            $(element).parent('div').after().append(error[0]);

        },
        submitHandler: function(form) {
            var formData = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: '/users/create',
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
                        sessionStorage.setItem("new_success", "success");
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