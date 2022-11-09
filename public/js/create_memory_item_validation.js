
$("#create_memory_item").validate(
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

            if(preview == previewed){

              if(empty > 0){
                toastr.error('You Got Error', 'Correct answer is empty!', {timeOut: 5000});
                return false;
              }else{
                var formData = new FormData($(form)[0]);
                $.ajax({
                    url:"/storeMemoryItem",
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
                            sessionStorage.setItem("new_success", "success");
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

            return false;

        }
    });