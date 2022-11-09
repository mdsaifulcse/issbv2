
$("#update_memory_item").validate(
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

            var preview = $('.preview').length;
            var previewed = $('.previewed').length;
            var empty = $('.empty').length;
            var question_remove = $('.question_remove').length;
            var sub_question_remove = $('.sub_question_remove').length;

            if(question_remove > 0 || sub_question_remove > 0){
                if(preview == previewed){

                    if(empty > 0){
                        toastr.error('You Got Error', 'Correct answer is empty!', {timeOut: 5000});
                        return false;
                    }else{
                        var formData = new FormData($(form)[0]);
                        var id = $('.id').val();
                        $.ajax({
                            url:"/updateMemoryItem/"+id,
                            method:"POST",
                            data:formData,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success:function(data)
                            {
                                if (data)
                                {
                                    window.onbeforeunload = function(e) {
                                        return undefined;
                                    };
                                    sessionStorage.setItem("update_success", "success");
                                    window.location.href = "/memory-items/"+data ;
                                }
                            },
                            error: function (e) {
                                toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000});
                                $('.create').prop('disabled', false);
                                $('.create').text('Submit');
                            }
                        });
                    }
                }else {
                    toastr.error('You Got Error', 'You must preview all sub question!', {timeOut: 5000});
                    return false;
                }
            }
            else
            {
                toastr.error('You Got Error', 'You must add one sub question!', {timeOut: 5000});
                return false;
            }


            return false;

        }
    });