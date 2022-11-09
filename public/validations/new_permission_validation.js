$("#add_permission").validate(
    {
        ignore: [],
        debug: false,
        rules: {

        },
        messages: {

        },
        errorPlacement: function(error, element)
        {
            $(element).parent('div').after().append(error[0]);

        },
        highlight: function(element, errorClass, validClass)
        {
            $(element).parent().addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass)
        {
            $(element).parent().addClass(validClass).removeClass(errorClass);
        },

        submitHandler: function(form) {
            var formData = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: 'permissions/create',
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