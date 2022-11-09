$("#add_role").validate(
    {
        ignore: [],
        debug: false,
        rules: {
            'permissions[]':{
                required: true
            },

        },
        messages: {

            'permissions[]': {
                required:"Please check at least one from permission list"
            }


        },
        errorPlacement: function(error, element)
        {
            if (element.attr("name") == 'permissions[]') {
                error.insertBefore("#checkbox");
            } else {
                error.insertAfter(element);
            }

        },
        submitHandler: function(form) {
            var formData = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: '/roles/create',
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