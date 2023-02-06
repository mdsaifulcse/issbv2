
$("#create_random_test").validate(
    {
        ignore: [],
        debug: false,
        rules: {
            total_item:{
                required: true,
                min: 1
            },
            // total_time:{
            //     required: true
            // },
            pass_mark:{
                required: true
            },
            candidate_type: {
                required: true
            }
        },
        messages: {
            total_item:{
                required:"You must enter an Item type",
                min : "You must enter an Item type"
            },
            total_time:{
                required:"This field is required"
            },
            pass_mark:{
                required:"This field is required"
            },
            candidate_type: {
                required:"This field is required"
            }
        },

        submitHandler: function(form) {
            var sum = 0;
            $(".item_type").each(function(){
                sum += +$(this).val();
            });

            var total_question = $("#total_question").val();

            if(total_question != sum){
                toastr.error('You Got Error', 'Invalid total item!', {timeOut: 5000});
                $('#invalid_total_question').html('Invalid total item');
                $('#invalid_total_question').show();
                $('#total_question').focus();
                return false;
            }else {
                $('.create_set').prop('disabled', true);
                $('.create_set').text('Sending...');
                var formData = new FormData($(form)[0]);
                $.ajax({
                    url:"/storeTestConfig",
                    method:"POST",
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        if(data[0] == 'exists'){
                            toastr.error('You Got Error', data[1]+' test already exists!', {timeOut: 5000});
                            $('.create_set').prop('disabled', false);
                            $('.create_set').text('Submit');
                        }
                        else {
                            sessionStorage.setItem("new_success", "success");
                            window.location.href = "/test-configuration-list";
                            //window.location.href = "/test-configuration-list/"+data;
                        }
                    },
                    error: function (e) {
                        toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000});

                        $('.create_set').prop('disabled', false);
                        $('.create_set').text('Submit');
                    }
                });
            }


            return false;
        }
    });