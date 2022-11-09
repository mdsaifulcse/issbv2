$(document).ready(function(){
    var names = [];

    /* change question type */
    $('.question_type').on('change', function(){
        var question_type = $(this).val();

        if(question_type == 1){
            $('#qt_img_show').hide(300);
            $('#qt_sound_show').hide(300);
            $('#qt_text_show').show(300);
            $('.img_questions').val('');
            $(".img_questions").removeAttr("required");
            $(".sound_questions").removeAttr("required");
            $(".text_questions").attr("required", "required");
        }else if(question_type == 2)
        {
            $('#qt_text_show').hide(300);
            $('#qt_sound_show').hide(300);
            $('#qt_img_show').show(300);
            $('.text_questions').val('');
            $(".text_questions").removeAttr("required");
            $(".sound_questions").removeAttr("required");
            $(".img_questions").attr("required", "required");
        }else if(question_type == 3)
        {
            $('#qt_text_show').hide(300);
            $('#qt_img_show').hide(300);
            $('#qt_sound_show').show(300);
            $('.text_questions').val('');
            $('.img_questions').val('');
            $(".text_questions").removeAttr("required");
            $(".img_questions").removeAttr("required");
            $(".sound_questions").attr("required", "required");
        }
    });

    /* change option type */
    $('.option_type').on('change', function(){
        var option_type = $(this).val();

        $('#right_answer').show();

        if(option_type == 1){
            $('#opt_img_show').hide(300);
            $('#otp_sound_show').hide(300);
            $('#otp_text_show').show(300);

            $('.text_options').prop('required', true);
            $('.img_options').prop('required', false);
            $('.sound_options').prop('required', false);
        }else if(option_type == 2)
        {
            $('#otp_text_show').hide(300);
            $('#otp_sound_show').hide(300);
            $('#opt_img_show').show(300);

            $('.img_options').prop('required', true);
            $('.text_options').prop('required', false);
            $('.sound_options').prop('required', false);
        }else if(option_type == 3)
        {
            $('#otp_text_show').hide(300);
            $('#opt_img_show').hide(300);
            $('#otp_sound_show').show(300);

            $('.sound_options').prop('required', true);
            $('.text_options').prop('required', false);
            $('.img_options').prop('required', false);
        }

        var selectList  = $("#right_answer");
        selectList.find('option').remove();

        var option_type  = $('.option_type:checked').val();

        if(option_type == 1){
            var numItems = $('.text_options').length;
        }else if(option_type == 2) {
            var numItems = $('.img_options').length;
        }else if(option_type == 3) {
            var numItems = $('.sound_options').length;
        }

        $("#right_answer").append("<option value=''> Choose One </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#right_answer").append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    /*add more text option fields*/
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

    /* add more image option fields */
    var i = 1;
    $('#img_option').on('click', function(){
        i++;
        $('#more_img_option').append('<div class="col-md-2 extra_field">' +
            '<label for="down_text">Option</label>' +
            '<span class="btn btn-danger btn-sm remove-img remove" style="margin-left: 18px;">&times;</span>' +
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

    /*add more sound option fields*/
    var i = 1;
    $('#sound_opt').on('click', function(){
        i++;
        $('#more_sound_opt').append('<div class="form-group extra_field">' +
            '<label for="">Option</label>' +
            '<span class="btn btn-danger btn-sm remove" style="float: right;margin-bottom: 2px;">&times;</span>' +
            '<input type="file" class="form-control sound_options" name="sound_options[]" id="" accept="audio/*" required/>' +
            '<label class="invalid-feedback">This field is required.</label>' +
            '</div>'
        );

        var selectList  = $("#right_answer");
        selectList.find('option').remove();

        var option_type  = $('.option_type:checked').val();

        if(option_type == 1){
            var numItems = $('.text_options').length;
        }else if(option_type == 2) {
            var numItems = $('.img_options').length;
        }else if(option_type == 3) {
            var numItems = $('.sound_options').length;
        }

        $("#right_answer").append("<option value=''> Choose One </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#right_answer").append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    /*remove extra fields*/
    $(document).on('click', '.remove', function(e){
        $(this).parent('.extra_field').remove();
        e.preventDefault();

        var selectList  = $("#right_answer");
        selectList.find('option').remove();

        var option_type  = $('.option_type:checked').val();

        if(option_type == 1){
            var numItems = $('.text_options').length;
        }else if(option_type == 2) {
            var numItems = $('.img_options').length;
        }else if(option_type == 3) {
            var numItems = $('.sound_options').length;
        }

        $("#right_answer").append("<option value=''> Choose One </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#right_answer").append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    /* enable or disable sub question */
    $('#sub_question_enable').on('change', function(){
        var sub_question = $(this).prop('checked') == true;

        if(sub_question){
            $('#sub_item').show();
            $('#pm_vit').hide();

            $('.sub_question_type').prop('required',true);
            $('.sub_option_type').prop('required',true);
            $('.sub_right_answer_0').prop('required',true);

            $('#pm_vit input, #pm_vit select').each(function() {
                $(this).prop('required', false);
            });
        }else
        {
            $('#sub_item').hide();
            $('#pm_vit').show();

            $('.option_type').prop('required',true);
            $('#right_answer').prop('required',true);

            $('#sub_item input, #sub_item select').each(function() {
                $(this).prop('required', false);
            });
        }
    });


    /* change sub question type */
    $('.sub_question_type').on('change', function(){
        var sub_question_type = $(this).val();

        if(sub_question_type == 1){
            $('#sub_question_img').hide(300);
            $('#sub_question_sound').hide(300);
            $('#sub_question_text').show(300);

            $('.sub_question_text').prop('required', true);
            $('.img_sub_question').prop('required', false);
            $('.sub_sound_options').prop('required', false);
        }else if(sub_question_type == 2)
        {
            $('#sub_question_img').show(300);
            $('#sub_question_sound').hide(300);
            $('#sub_question_text').hide(300);

            $('.img_sub_question').prop('required', true);
            $('.sub_question_text').prop('required', false);
            $('.sub_sound_options').prop('required', false);
        }else if(sub_question_type == 3)
        {
            $('#sub_question_img').hide(300);
            $('#sub_question_sound').show(300);
            $('#sub_question_text').hide(300);

            $('.sub_sound_options').prop('required', true);
            $('.sub_question_text').prop('required', false);
            $('.img_sub_question').prop('required', false);
        }
    });

    /* change sub option type */
    $('.sub_option_type').on('change', function(){
        var sub_option_type = $(this).val();

        $('.sub_correct_answer').show();

        if(sub_option_type == 1){
            $('#sub_otp_text_show').show(300);
            $('#sub_opt_img_show').hide(300);
            $('#sub_otp_sound_show').hide(300);

            $('.sub_text_options_0').prop('required', true);
            $('.sub_img_options_0').prop('required', false);
            $('.sub_sound_options_0').prop('required', false);
        }else if(sub_option_type == 2)
        {
            $('#sub_otp_text_show').hide(300);
            $('#sub_opt_img_show').show(300);
            $('#sub_otp_sound_show').hide(300);

            $('.sub_img_options_0').prop('required', true);
            $('.sub_text_options_0').prop('required', false);
            $('.sub_sound_options_0').prop('required', false);
        }else if(sub_option_type == 3)
        {
            $('#sub_otp_text_show').hide(300);
            $('#sub_opt_img_show').hide(300);
            $('#sub_otp_sound_show').show(300);

            $('.sub_sound_options_0').prop('required', true);
            $('.sub_text_options_0').prop('required', false);
            $('.sub_img_options_0').prop('required', false);
        }

        var className = 0;

        var selectList  = $(".sub_right_answer_"+className);
        selectList.find('option').remove();

        var option_type  = $('.sub_option_type:checked').val();

        if(option_type == 1){
            var numItems = $('.sub_text_options_'+className).length;
        }else if(option_type == 2) {
            var numItems = $('.sub_img_options_'+className).length;
        }else if(option_type == 3) {
            var numItems = $('.sub_sound_options_'+className).length;
        }

        $(".sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
        for (var i=1; i<=numItems; i++)
        {
            $(".sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    $(document).on('click', '.sub_text_opt_0', function(){
        var this_class = this.className.split(/_/);
        var className = this_class[3];
        $('.sub_more_text_opt_'+className).append('<div class="form-group extra_field"><span class="btn btn-danger btn-sm remove_sub_opt_'+className+'" style="float: right;margin-bottom: 2px;">&times;</span><label for="option">Option</label><input type="text" class="form-control sub_text_options_'+className+'" name="sub_text_options_'+className+'[]" id="" placeholder="Option" required="required"><div class="invalid-feedback">This field is required.</div></div>');

        var selectList  = $(".sub_right_answer_"+className);
        selectList.find('option').remove();

        var numItems = $('.sub_text_options_'+className).length;

        $(".sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
        for (var i=1; i<=numItems; i++)
        {
            $(".sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    $(document).on('click', '.sub_img_opt_0', function(){
        var this_class = this.className.split(/_/);
        var className = this_class[3];

        $('#sub_more_img_opt_'+className).append('<div class="col-md-2 extra_field"><label for="down_text">Option</label><span class="btn btn-danger btn-sm remove-img remove_sub_opt_'+className+'" style="margin-left: 18px;">&times;</span><div class="form-group"><div class="fileinput fileinput-new" data-provides="fileinput"><div class="fileinput-new thumbnail"><img src="assets/img/authors/no_avatar.jpg" alt="..." class="img-responsive" style="width: 80px; height: 80px;"></div><div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div><div><span class="btn btn-primary btn-file btn-sm"><span class="fileinput-new">Choose image</span><span class="fileinput-exists">Change</span><input type="file" class="form-control sub_img_options_'+className+'" name="sub_img_options_'+className+'[]" accept="image/*" id="" required="required"><div class="invalid-feedback">This field is required.</div></span><span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span></div></div></div></div>');

        var selectList  = $(".sub_right_answer_"+className);
        selectList.find('option').remove();

        var numItems = $('.sub_img_options_'+className).length;


        $(".sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
        for (var i=1; i<=numItems; i++)
        {
            $(".sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    $(document).on('click', '.sub_sound_opt_0', function(){
        var this_class = this.className.split(/_/);
        var className = this_class[3];

        $('#sub_more_sound_opt_'+className).append('<div class="form-group extra_field"><span class="btn btn-danger btn-sm remove_sub_opt_'+className+'" style="float: right;margin-bottom: 2px;">&times;</span><label for="">Option</label><input type="file" class="form-control sub_sound_options_'+className+'" name="sub_sound_options_'+className+'[]" id="" accept="audio/*" required="required"><div class="invalid-feedback">This field is required.</div></div>');

        var selectList  = $(".sub_right_answer_"+className);
        selectList.find('option').remove();

        var numItems = $('.sub_sound_options_'+className).length;


        $(".sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
        for (var i=1; i<=numItems; i++)
        {
            $(".sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    /*remove sub options*/
    $(document).on('click', '.remove_sub_opt_0', function(e){
        $(this).parent('.extra_field').remove();
        e.preventDefault();

        var classNames = this.className.split(/_/);
        var className = classNames[3];

        var selectList  = $(".sub_right_answer_"+className);
        selectList.find('option').remove();

        var option_type  = $('.sub_option_type:checked').val();

        if(option_type == 1){
            var numItems = $('.sub_text_options_'+className).length;
        }else if(option_type == 2) {
            var numItems = $('.sub_img_options_'+className).length;
        }else if(option_type == 3) {
            var numItems = $('.sub_sound_options_'+className).length;
        }

        $(".sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
        for (var i=1; i<=numItems; i++)
        {
            $(".sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
        }
    });


    /* add more sub question */
    var i = 0;
    $('#sub_question').on('click', function(){
        i++;
        names.push('options_'+i);
        $('.text_options_list').val(names);

        $('#more_sub_question').append('<div class="sub_question_blog mb-4">'+
            '<span class="btn btn-danger btn-sm remove_sub_question" id="remove_'+i+'" style="float: right;margin-bottom: 2px;">&times;</span>' +
            '<div class="form-group">'+
                '<label>Sub Question Type</label><br>'+
            '<label for="sub_text_type_'+i+'">'+
                '<input type="radio" name="sub_question_type_'+i+'" class="sub_question_types" id="sub_text_type_'+i+'" value="1" required/> Text Field'+
            '&nbsp;&nbsp;&nbsp;'+
            '</label>'+
            '<label for="sub_img_type_'+i+'">'+
                '<input type="radio" name="sub_question_type_'+i+'" class="sub_question_types" id="sub_img_type_'+i+'" value="2" required/> Image Field'+
            '&nbsp;&nbsp;&nbsp;'+
            '</label>'+
            '<label for="sub_sound_type_'+i+'">'+
                '<input type="radio" name="sub_question_type_'+i+'" class="sub_question_types" id="sub_sound_type_'+i+'" value="3" required/> Sound Field'+
            '</label><br>'+
            '<label id="sub_question_types-error" class="error" for="sub_question_type_'+i+'" hidden></label>'+
            '</div>'+

            '<div id="sub_question_append_'+i+'"></div>'+



                '<div id="otp_text">'+
                '<div class="form-group">'+
                '<label>Sub Option Type</label><br>'+
            '<label for="sub_text_opt_'+i+'">'+
                '<input type="radio" name="sub_option_type_'+i+'" class="sub_option_types sub_option_type_'+i+'" id="sub_text_opt_'+i+'" value="1" required/> Text Field'+
            '&nbsp;&nbsp;&nbsp;'+
            '</label>'+
            '<label for="sub_img_opt_'+i+'">'+
                '<input type="radio" name="sub_option_type_'+i+'" class="sub_option_types sub_option_type_'+i+'" id="sub_img_opt_'+i+'" value="2" required/> Image Field'+
            '&nbsp;&nbsp;&nbsp;'+
            '</label>'+
            '<label for="sub_sound_opt_'+i+'">'+
                '<input type="radio" name="sub_option_type_'+i+'" class="sub_option_types sub_option_type_'+i+'" id="sub_sound_opt_'+i+'" value="3" required/> Sound Field'+
            '</label><br>' +
            '<label id="sub_option_type_'+i+'-error" class="error" for="sub_option_types" hidden></label>'+
            '</div>'+
            '<label id="sub_option_type_'+i+'-error" class="error" for="sub_option_type_'+i+'" hidden></label>'+

            '<div id="sub_option_append_'+i+'"></div>'+


        '<select name="sub_right_answer_'+i+'[]" id="" class="form-control mt-4 sub_right_answer_'+i+'" style="display: none;">'+
    '<option value=""> Choose Sub Correct Answer</option>'+
    '<option value="1">Option 1</option>'+
    '</select>'+
    '</div>'+
    '</div>');

        /* change dynamic sub question type */
        $(document).on('change','.sub_question_types', function(){
            var sub_question_type = $(this).val();
            var this_class = this.id.split(/_/);
            var className = this_class[3];

            if(sub_question_type == 1){
                $('#sub_question_append_'+className).html('<div id="sub_question_text_'+className+'" class="form-group">'+
                    '<label for="sub_question">Sub Question</label>'+
                    '<input type="text" class="form-control sub_question_text_'+className+'" name="sub_text_question[]" id="" placeholder="Sub Question" required="required"/>'+
                    //'<div class="invalid-feedback">This field is required.</div>'+
                    '</div>');
            }else if(sub_question_type == 2)
            {
                $('#sub_question_append_'+className).html(
                    '<div id="sub_question_img_'+className+'>'+
                    '<div class="row">'+
                    '<div class="col-md-12">'+
                    '<div class="form-group">'+
                    '<label for="sub_question">Sub Question</label>' +
                    '<br>'+
                    '<div class="fileinput fileinput-new" data-provides="fileinput">'+
                    '<div class="fileinput-new thumbnail">'+
                    '<img src="assets/img/authors/no_avatar.jpg" alt="..." class="img-responsive" style="width: 180px; height: 100px;"/>'+
                    '</div>'+
                    '<div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div>'+
                    '<div>'+
                    '<span class="btn btn-primary btn-file btn-sm">'+
                    '<span class="fileinput-new">Choose image</span>'+
                    '<span class="fileinput-exists">Change</span>'+
                    '<input type="file" class="form-control img_sub_question_'+className+'" name="sub_img_question[]" accept="image/*" id="" required/>'+
                    '<div class="invalid-feedback">This field is required.</div>'+
                    '</span>'+
                    '<label id="img_sub_question[]-error" class="error" for="img_sub_question[]" style="display: none !important;"></label>'+
                    '<span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<br>'
                );

            }else if(sub_question_type == 3)
            {
                $('#sub_question_append_'+className).html(
                    '<div id="sub_question_sound_'+i+'">'+
                    '<div class="form-group">'+
                    '<label for="sub_question">Sub Question</label>'+
                    '<input type="file" class="form-control sub_sound_question_'+i+'" name="sub_sound_question[]" id="" accept="audio/*" required/>'+
                    '</div>'+
                    '</div>'
                );

            }
        });

        /* change dynamic sub option type */
        $(document).on('change', '.sub_option_types', function(){
            var sub_option_type = $(this).val();
            var this_class = this.id.split(/_/);
            var className = this_class[3];

            $('.sub_right_answer_'+className).show();

            $('.sub_right_answer_'+className).prop('required', true);

            if(sub_option_type == 1){

                $('#sub_option_append_'+className).html(
                    '<div id="sub_otp_text_show_'+className+'">'+
                    '<div class="form-group">'+
                    '<label for="option">Option</label>'+
                    '<input type="text" class="form-control sub_text_options_'+className+'" name="sub_text_options_'+className+'[]" id="" placeholder="Option" required="required"/>'+
                    //'<div class="invalid-feedback">This field is required</div>'+
                    '</div>'+
                    '<span class="sub_more_text_opt_'+className+'"></span>'+
                    '<div class="btn btn-info btn-sm sub_text_opt_'+className+'" id="">add more</div>'+
                    '</div>'
                );
            }else if(sub_option_type == 2)
            {

            $('#sub_option_append_'+className).html(
                '<div id="sub_opt_img_show_'+className+'">'+
                '<div class="row">'+
                '<div class="col-md-2">'+
                '<label for="down_text">Option</label>'+
                '<div class="form-group">'+
                '<div class="fileinput fileinput-new" data-provides="fileinput">'+
                '<div class="fileinput-new thumbnail">'+
                '<img src="assets/img/authors/no_avatar.jpg" alt="..." class="img-responsive" style="width: 80px; height: 80px;"/>'+
                '</div>'+
                '<div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div>'+
                '<div>'+
                '<span class="btn btn-primary btn-file btn-sm">'+
                '<span class="fileinput-new">Choose image</span>'+
                '<span class="fileinput-exists">Change</span>'+
                '<input type="file" class="form-control sub_img_options_'+className+'" name="sub_img_options_'+className+'[]" accept="image/*" id="" required="required"/>'+
                '<div class="invalid-feedback">This field is required.</div>'+
                '</span>'+
                '<label id="img_options[]-error" class="error" for="img_options[]" style="display: none !important;"></label>'+
                '<span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<span id="sub_more_img_opt_'+className+'"></span>'+
                '</div>'+
                '<div class="btn btn-info btn-sm sub_img_opt_'+className+'" >add more</div>'+
                '</div>'
            );

            }else if(sub_option_type == 3)
            {
                $('#sub_option_append_'+className).html(
                    '<div id="sub_otp_sound_show_'+className+'">'+
                    '<div class="form-group">'+
                    '<label for="">Option</label>'+
                    '<input type="file" class="form-control sub_sound_options_'+className+'" name="sub_sound_options_'+className+'[]" id="" accept="audio/*" required="required"/>'+
                    //'<div class="invalid-feedback">This field is required</div>'+
                    '</div>'+
                    '<span id="sub_more_sound_opt_'+className+'"></span>'+
                    '<div class="btn btn-info btn-sm sub_sound_opt_'+className+'">add more</div>'+
                    '</div>'
                );
            }

            var selectList  = $(".sub_right_answer_"+className);
            selectList.find('option').remove();

            var option_type  = $('.sub_option_type_'+className+':checked').val();

            if(option_type == 1){
                var numItems = $('.sub_text_options_'+className).length;
            }else if(option_type == 2) {
                var numItems = $('.sub_img_options_'+className).length;
            }else if(option_type == 3) {
                var numItems = $('.sub_sound_options_'+className).length;
            }

            $(".sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
            for (var i=1; i<=numItems; i++)
            {
                $(".sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
            }
        });

        $(document).on('click', '.sub_text_opt_'+i, function(){
            var this_class = this.className.split(/_/);
            var className = this_class[3];
            $('.sub_more_text_opt_'+className).append('<div class="form-group extra_field"><span class="btn btn-danger btn-sm remove_sub_opt_'+className+'" style="float: right;margin-bottom: 2px;">&times;</span><label for="option">Option</label><input type="text" class="form-control sub_text_options_'+className+'" name="sub_text_options_'+className+'[]" id="" placeholder="Option" required="required"><div class="invalid-feedback">This field is required</div></div>');

            var selectList  = $(".sub_right_answer_"+className);
            selectList.find('option').remove();

            var numItems = $('.sub_text_options_'+className).length;

            $(".sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
            for (var i=1; i<=numItems; i++)
            {
                $(".sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
            }
        });

        $(document).on('click', '.sub_img_opt_'+i, function(){
            var this_class = this.className.split(/_/);
            var className = this_class[3];

            $('#sub_more_img_opt_'+className).append('<div class="col-md-2 extra_field"><label for="down_text">Option</label><span class="btn btn-danger btn-sm remove-img remove_sub_opt_'+className+'" style="margin-left: 18px;">&times;</span><div class="form-group"><div class="fileinput fileinput-new" data-provides="fileinput"><div class="fileinput-new thumbnail"><img src="assets/img/authors/no_avatar.jpg" alt="..." class="img-responsive" style="width: 80px; height: 80px;"></div><div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div><div><span class="btn btn-primary btn-file btn-sm"><span class="fileinput-new">Choose image</span><span class="fileinput-exists">Change</span><input type="file" class="form-control sub_img_options_'+className+'" name="sub_img_options_'+className+'[]" accept="image/*" id="" required="required"><div class="invalid-feedback">This field is required</div></span><label id="img_options[]-error" class="error" for="img_options[]" style="display: none !important;"></label><span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span></div></div></div></div>');

            var selectList  = $(".sub_right_answer_"+className);
            selectList.find('option').remove();

            var numItems = $('.sub_img_options_'+className).length;


            $(".sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
            for (var i=1; i<=numItems; i++)
            {
                $(".sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
            }
        });

        $(document).on('click', '.sub_sound_opt_'+i, function(){
            var this_class = this.className.split(/_/);
            var className = this_class[3];

            $('#sub_more_sound_opt_'+className).append('<div class="form-group extra_field"><span class="btn btn-danger btn-sm remove_sub_opt_'+className+'" style="float: right;margin-bottom: 2px;">&times;</span><label for="">Option</label><input type="file" class="form-control sub_sound_options_'+className+'" name="sub_sound_options_'+className+'[]" id="" accept="audio/*" required="required"><div class="invalid-feedback">This field is required</div></div>');

            var selectList  = $(".sub_right_answer_"+className);
            selectList.find('option').remove();

            var numItems = $('.sub_sound_options_'+className).length;


            $(".sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
            for (var i=1; i<=numItems; i++)
            {
                $(".sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
            }
        });

        /*remove sub options*/
        $(document).on('click', '.remove_sub_opt_'+i, function(e){
            $(this).parent('.extra_field').remove();
            e.preventDefault();

            var classNames = this.className.split(/_/);
            var className = classNames[3];

            var selectList  = $(".sub_right_answer_"+className);
            selectList.find('option').remove();

            var option_type  = $('.sub_option_type_'+className+':checked').val();

            if(option_type == 1){
                var numItems = $('.sub_text_options_'+className).length;
            }else if(option_type == 2) {
                var numItems = $('.sub_img_options_'+className).length;
            }else if(option_type == 3) {
                var numItems = $('.sub_sound_options_'+className).length;
            }

            $(".sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
            for (var i=1; i<=numItems; i++)
            {
                $(".sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
            }
        });

        $('.sub_img_options'+i).on('change', function(){
            $('#-error').hide();
        });

    });

    /* remove sub question */
    $(document).on('click', '.remove_sub_question', function(e){
        var id = $(this).attr('id');
        var split_id = id.split(/_/);
        names = jQuery.grep(names, function(value) {
            return value != 'options_'+split_id[1];
        });
        $('.text_options_list').val(names);

        $(this).parent('.sub_question_blog ').remove();
    });

    $('.sub_img_options_0').on('change', function(){
        $('#-error').hide();
    });

    $('.img_sub_question').on('change', function(){
        $('#-error').hide();
    });
    $('.img_options').on('change', function(){
        $('#-error').hide();
    });

});
