$("#edit_role").validate(
    {
        ignore: [],
        debug: false,
        rules: {
            'edit_permissions[]':{
                required: true
            },

        },
        messages: {

            'edit_permissions[]': {
                required:"Please check at least one from permission list"
            }


        },
        errorPlacement: function(error, element)
        {
            if (element.attr("name") == 'edit_permissions[]') {
                error.insertBefore("#edit_checkbox");
            } else {
                error.insertAfter(element);
            }

        },
        submitHandler: function(form) {
            var id = $('#edit_id').val();
            var formData = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: '/roles/' + id,
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