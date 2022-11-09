
$("#create_qusetion").validate(
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

            question_type:{
                required: true
            },
            option_type:{
                required: true
            },
            right_answer:{
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
            question_type:{
                required:"This field is required"
            },
            option_type:{
                required:"This field is required"
            },
            right_answer:{
                required:"This field is required"
            },
            publish_test:{
                required:"This field is required"
            }
        },

        submitHandler: function(form) {
            $('.create').prop('disabled', true);
            $('.create').text('Sending...');
            var publish_test=$('#publish_test :selected').val();
            var formData = new FormData($(form)[0]);
            $.ajax({
                url:"/store",
                method:"POST",
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if (data == 'pm_success')
                    {
                        sessionStorage.setItem("new_success", "success");
                        window.location.href = "/pm-question-bank/"+publish_test;
                    }
                    else if(data == 'vit_success')
                    {
                        sessionStorage.setItem("new_success", "success");
                        window.location.href = "/vit-question-bank/"+publish_test;
                    }
                },
                error: function (e) {
                    toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000});
                    $('.create').prop('disabled', false);
                    $('.create').text('Submit');
                }
            });

            return false;

        }
    });