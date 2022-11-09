
$("#create_numeric_qusetion").validate(
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
        }
    });