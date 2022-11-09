$(document).ready(function(){

    /* change question type */
    $('.question_type').on('change', function(){
        var question_type = $(this).val();

        if(question_type == 1){
            $('#qt_img_show').hide(300);
            $('#qt_text_show').show(300);
            $('.img_questions').val('');
            $(".img_questions").removeAttr("required");
            $(".text_questions").attr("required", "required");
        }else
        {
            $('#qt_text_show').hide(300);
            $('#qt_img_show').show(300);
            $('.text_questions').val('');
            $(".text_questions").removeAttr("required");
            $(".img_questions").attr("required", "required");
        }
    });

    /* change option type */
    $('.option_type').on('change', function(){
        var option_type = $(this).val();

        if(option_type == 1){
            $('#opt_img_show').hide(300);
            $('#otp_text_show').show(300);
            $('.img_options').val('');
            $(".img_options").removeAttr("required");
            $(".text_options").attr("required", "required");
        }else
        {
            $('#otp_text_show').hide(300);
            $('#opt_img_show').show(300);
            $('.text_options').val('')
            $(".text_options").removeAttr("required");
            $(".img_options").attr("required", "required");
        }

        var selectList  = $("#right_answer");
        selectList.find('option').remove();

        var option_type  = $('.option_type:checked').val();

        if(option_type == 1){
            var numItems = $('.text_options').length;
        }else {
            var numItems = $('.img_options').length;
        }

        $("#right_answer").append("<option value=''> Choose One </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#right_answer").append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    /*add more text fields*/
    var i = 1;
    $('#text_opt').on('click', function(){
        i++;
        $('#more_text_opt').append('<div class="form-group extra_field">' +
            '<label for="down_text">Option</label>' +
            '<span class="btn btn-danger btn-sm remove" style="float: right;margin-bottom: 2px;">&times;</span>' +
            '<input type="text" class="form-control text_options" name="text_options[]" placeholder="Option" required/>' +
            '<label class="invalid-feedback">This field is required.</label>' +
            '</div>'
        );

        var selectList  = $("#right_answer");
        selectList.find('option').remove();

        var option_type  = $('.option_type:checked').val();

        if(option_type == 1){
            var numItems = $('.text_options').length;
        }else {
            var numItems = $('.img_options').length;
        }

        $("#right_answer").append("<option value=''> Choose One </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#right_answer").append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    /*remove text fields*/
    $(document).on('click', '.remove', function(e){
        $(this).parent('.extra_field').remove();
        e.preventDefault();

        var selectList  = $("#right_answer");
        selectList.find('option').remove();

        var option_type  = $('.option_type:checked').val();

        if(option_type == 1){
            var numItems = $('.text_options').length;
        }else {
            var numItems = $('.img_options').length;
        }

        $("#right_answer").append("<option value=''> Choose One </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#right_answer").append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    /* add more image fields */
    var i = 1;
    $('#img_opt').on('click', function(){
        i++;
        $('#more_img_opt').append('<div class="col-md-2 extra_image">' +
            '<label for="down_text">Option</label>' +
            '<span class="btn btn-danger btn-sm remove-img" style="margin-left: 18px;">&times;</span>' +
            '<div class="form-group">' +
            '<div class="fileinput fileinput-new" data-provides="fileinput">' +
            '<div class="fileinput-new thumbnail">' +
            '<img src="assets/img/authors/no_avatar.jpg" alt="..." class="img-responsive" style="width: 80px; height: 80px;"/>' +
            '</div>' +
            '<div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div>' +
            '<div>' +
            '<span class="btn btn-primary btn-file btn-sm">' +
            '<span class="fileinput-new">Choose image</span>' +
            '<span class="fileinput-exists">Change</span>' +
            '<input type="file" class="form-control img_options" name="img_options[]" accept="image/*" id="" required/>' +
            '<div class="invalid-feedback">This field is required.</div>' +
            '</span>' +
            '<span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>' +
            '</div>' +
            '</div>' +
            '</div>'
        );

        var selectList  = $("#right_answer");
        selectList.find('option').remove();

        var option_type  = $('.option_type:checked').val();

        if(option_type == 1){
            var numItems = $('.text_options').length;
        }else {
            var numItems = $('.img_options').length;
        }

        $("#right_answer").append("<option value=''> Choose One </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#right_answer").append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    /*remove image fields*/
    $(document).on('click', '.remove-img', function(e){
        $(this).parent('.extra_image').remove();
        e.preventDefault();

        var selectList  = $("#right_answer");
        selectList.find('option').remove();

        var option_type  = $('.option_type:checked').val();

        if(option_type == 1){
            var numItems = $('.text_options').length;
        }else {
            var numItems = $('.img_options').length;
        }

        $("#right_answer").append("<option value=''> Choose One </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#right_answer").append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    $('.img_options').on('change', function(){
        $('#-error').hide();
    });
});
