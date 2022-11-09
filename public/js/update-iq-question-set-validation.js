
$("#update_iq_qusetion_set").validate(
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
            $('.update_ip_set').prop('disabled', true);
            $('.update_ip_set').text('Sending...');
            var id = $('#id').val();
            var formData = new FormData($(form)[0]);
            $.ajax({
                url:"/editIQquestionSet/" + id,
                method:"POST",
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if (data == 'pm_success')
                    {
                        sessionStorage.setItem("update_success", "success");
                        window.location.href = "/iq-question-set-list/pm-set";
                    }
                    else if(data == 'vit_success')
                    {
                        sessionStorage.setItem("update_success", "success");
                        window.location.href = "/iq-question-set-list/vit-set";
                    }
                },
                error: function (e) {
                    toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000});

                    $('.update_ip_set').prop('disabled', false);
                    $('.update_ip_set').text('Submit');
                }
            });

            return false;

        }
    });