
$("#create_verbal_item").validate(
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
            $('.create').prop('disabled', true);
            $('.create').text('Sending...');
            var publish_test=$('#publish_test :selected').val();
            var formData = new FormData($(form)[0]);
            $.ajax({
                url:"/storeVerbalItem",
                method:"POST",
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if (data == 'success')
                    {
                        sessionStorage.setItem("new_success", "success");
                        window.location.href = "/verbal-item-bank/"+publish_test;
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