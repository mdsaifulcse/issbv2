
$("#edit_qusetion_set").validate(
    {
        ignore: [],
        debug: false,
        rules: {
            total_item:{
                required: true,
                min: 1
            },
            total_time:{
                required: true
            },
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
            var number_of_selected_item_item = $("#number_of_selected_item_item").val();

            $('#item_change_status').val(sum);

            if(number_of_selected_item_item != total_question ){
                toastr.error('You Got Error', 'Invalid total item!', {timeOut: 5000});
                return false;
            }else {
                $('.edit_set').prop('disabled', true);
                $('.edit_set').text('Sending...');
                var id = $('#id').val();
                var formData = new FormData($(form)[0]);
                $.ajax({
                    url:"/updateItemSet/" + id,
                    method:"POST",
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        if (data)
                        {
                            sessionStorage.setItem("update_success", "success");
                            window.location.href = "/question-set";
                        }
                    },
                    error: function (e) {
                        toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000});

                        $('.edit_set').prop('disabled', false);
                        $('.edit_set').text('Submit');
                    }
                });
            }


            return false;
        }
    });