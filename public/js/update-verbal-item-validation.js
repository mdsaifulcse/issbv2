
$("#update_verbal_item").validate(
    {
        ignore: [],
        debug: false,
        rules: {
            question_name:{
                required: true
            },
            question_level:{
                required: true
            },
            question_category:{
                required: true
            },
            publish_test:{
                required: true
            }

        },
        messages: {
            question_name:{
                required:"This field is required"
            },
            question_level:{
                required:"This field is required"
            },
            question_category:{
                required:"This field is required"
            },
            publish_test:{
                required:"This field is required"
            }
        },

        submitHandler: function(form) {
            $('.update').prop('disabled', true);
            $('.update').text('Sending...');
            var publish_test=$('#publish_test :selected').val();
            var id = $('#id').val();
            var formData = new FormData($(form)[0]);
            $.ajax({
                url:"/updateVerbalItem/"+ id,
                method:"POST",
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if (data == 'success')
                    {
                        sessionStorage.setItem("update_success", "success");
                        window.location.href = "/verbal-item-bank/"+publish_test;
                    }
                },
                error: function (e) {
                    toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000});
                    $('.update').prop('disabled', false);
                    $('.update').text('Submit');
                }
            });

            return false;

        }
    });