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
        var sl = ($('input[name="text_options[]"]').length)+1;
        $('#more_text_opt').append('<div class="form-group extra_field">' +
            '<label for="down_text">Option-' + sl +'</label>' +
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
        var sl = ($('input[name="img_options[]"]').length)+1;
        $('#more_img_option').append('<div class="col-md-2 extra_field">' +
            '<label for="down_text">Option-' + sl +'</label>' +
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
        var sl = ($('input[name="sound_options[]"]').length)+1;
        $('#more_sound_opt').append('<div class="form-group extra_field">' +
            '<label for="">Option-' + sl +'</label>' +
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

            $('.sub_question_image').hide(300);
            $('.sub_question_snd').hide(300);

            $('.sub_question_text').prop('required', true);
            $('.img_sub_question').prop('required', false);
            $('.sub_sound_questions').prop('required', false);

            $('.sub_question_text').val('');
            $('.img_sub_question').val('');
            $('.sub_sound_questions').val('');

            $('.sub_question_txt input, .sub_question_txt select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_image input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_snd input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
        }else if(sub_question_type == 2)
        {
            $('#sub_question_img').show(300);
            $('#sub_question_sound').hide(300);
            $('#sub_question_text').hide(300);

            $('.sub_question_snd').hide(300);
            $('.sub_question_txt').hide(300);

            $('.img_sub_question').prop('required', true);
            $('.sub_question_text').prop('required', false);
            $('.sub_sound_questions').prop('required', false);

            $('.sub_question_text').val('');
            $('.img_sub_question').val('');
            $('.sub_sound_questions').val('');

            $('.sub_question_txt input, .sub_question_txt select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_image input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_snd input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
        }else if(sub_question_type == 3)
        {
            $('#sub_question_img').hide(300);
            $('#sub_question_sound').show(300);
            $('#sub_question_text').hide(300);

            $('.sub_question_image').hide(300);
            $('.sub_question_txt').hide(300);

            $('.sub_sound_questions').prop('required', true);
            $('.sub_question_text').prop('required', false);
            $('.img_sub_question').prop('required', false);

            $('.sub_question_text').val('');
            $('.img_sub_question').val('');
            $('.sub_sound_questions').val('');

            $('.sub_question_txt input, .sub_question_txt select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_image input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_snd input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
        }
        names.length = 0;
        $('.text_options_list').val('');
    });

    /* change sub option type */
    $('.sub_option_type').on('change', function(){
        var sub_option_type = $(this).val();

        $('.sub_correct_answer').show();

        if(sub_option_type == 1){
            $('#sub_otp_text_show').show(300);
            $('#sub_opt_img_show').hide(300);
            $('#sub_otp_sound_show').hide(300);

            $('.sub_question_image').hide(300);
            $('.sub_question_snd').hide(300);
            $('.sub_question_txt').hide(300);

            $('.sub_text_options_0').prop('required', true);
            $('.sub_img_options_0').prop('required', false);
            $('.sub_sound_options_0').prop('required', false);

            /*$('.sub_question_text').val('');
            $('.img_sub_question').val('');
            $('.sub_sound_questions').val('')*/;

            $('.sub_question_txt input, .sub_question_txt select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_image input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_snd input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
        }else if(sub_option_type == 2)
        {
            $('#sub_otp_text_show').hide(300);
            $('#sub_opt_img_show').show(300);
            $('#sub_otp_sound_show').hide(300);

            $('.sub_question_image').hide(300);
            $('.sub_question_snd').hide(300);
            $('.sub_question_txt').hide(300);

            $('.sub_img_options_0').prop('required', true);
            $('.sub_text_options_0').prop('required', false);
            $('.sub_sound_options_0').prop('required', false);

            /*$('.sub_question_text').val('');
            $('.img_sub_question').val('');
            $('.sub_sound_questions').val('');*/

            $('.sub_question_txt input, .sub_question_txt select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_image input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_snd input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
        }else if(sub_option_type == 3)
        {
            $('#sub_otp_text_show').hide(300);
            $('#sub_opt_img_show').hide(300);
            $('#sub_otp_sound_show').show(300);

            $('.sub_question_image').hide(300);
            $('.sub_question_txt').hide(300);
            $('.sub_question_snd').hide(300);

            $('.sub_sound_options_0').prop('required', true);
            $('.sub_text_options_0').prop('required', false);
            $('.sub_img_options_0').prop('required', false);

            /*$('.sub_question_text').val('');
            $('.img_sub_question').val('');
            $('.sub_sound_questions').val('');*/

            $('.sub_question_txt input, .sub_question_txt select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_image input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
            $('.sub_question_snd input, .sub_question_snd select').each(function() {
                $(this).prop('required', false);
            });
        }
        names.length = 0;
        $('.text_options_list').val('');

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

    $(document).on('click', '.sub_text_opt', function(){
        var id = $(this).attr('id');
        var this_class = id.split(/_/);
        var className = this_class[3];
        var sl = ($('input[name="sub_text_options_'+className+'[]"]').length)+1;
        $('.sub_more_text_opt_'+className).append('<div class="form-group extra_field"><span class="btn btn-danger btn-sm remove_sub_opt" id="remove_sub_opt_'+className+'" style="float: right;margin-bottom: 2px;">&times;</span><label for="option">Option-' + sl +'</label><input type="text" class="form-control sub_text_options_'+className+'" name="sub_text_options_'+className+'[]" id="" placeholder="Option" required="required"><div class="invalid-feedback">This field is required.</div></div>');

        var selectList  = $("#sub_right_answer_"+className);
        selectList.find('option').remove();

        var numItems = $('.sub_text_options_'+className).length;

        $("#sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    $(document).on('click', '.sub_img_opt', function(){
        var id = $(this).attr('id');
        var this_class = id.split(/_/);
        var className = this_class[3];
        var sl = ($('input[name="sub_img_options_'+className+'[]"]').length)+1;

        $('#sub_more_img_opt_'+className).append('<div class="col-md-2 extra_field"><label for="down_text">Option-' + sl +'</label><span class="btn btn-danger btn-sm remove-img remove_sub_opt" id="remove_sub_opt_'+className+'" style="margin-left: 18px;">&times;</span><div class="form-group"><div class="fileinput fileinput-new" data-provides="fileinput"><div class="fileinput-new thumbnail"><img src="assets/img/authors/no_avatar.jpg" alt="..." class="img-responsive" style="width: 80px; height: 80px;"></div><div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div><div><span class="btn btn-primary btn-file btn-sm"><span class="fileinput-new">Choose image</span><span class="fileinput-exists">Change</span><input type="file" class="form-control sub_img_options_'+className+'" name="sub_img_options_'+className+'[]" accept="image/*" id="" required="required"><div class="invalid-feedback">This field is required.</div></span><span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span></div></div></div></div>');

        var selectList  = $("#sub_right_answer_"+className);
        selectList.find('option').remove();

        var numItems = $('.sub_img_options_'+className).length;


        $("#sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    $(document).on('click', '.sub_sound_opt', function(){
        var id = $(this).attr('id');
        var this_class = id.split(/_/);
        var className = this_class[3];
        var sl = ($('input[name="sub_sound_options_'+className+'[]"]').length)+1;

        $('#sub_more_sound_opt_'+className).append('<div class="form-group extra_field"><span class="btn btn-danger btn-sm remove_sub_opt" id="remove_sub_opt_'+className+'" style="float: right;margin-bottom: 2px;">&times;</span><label for="">Option-' + sl +'</label><input type="file" class="form-control sub_sound_options_'+className+'" name="sub_sound_options_'+className+'[]" id="" accept="audio/*" required="required"><div class="invalid-feedback">This field is required.</div></div>');

        var selectList  = $("#sub_right_answer_"+className);
        selectList.find('option').remove();

        var numItems = $('.sub_sound_options_'+className).length;


        $("#sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    /*remove sub options*/
    $(document).on('click', '.remove_sub_opt', function(e){
        $(this).parent('.extra_field').remove();
        e.preventDefault();

        var id = $(this).attr('id');
        var this_class = id.split(/_/);
        var className = this_class[3];

        var selectList  = $("#sub_right_answer_"+className);
        selectList.find('option').remove();

        var option_type  = $('.sub_option_type:checked').val();

        if(option_type == 1){
            var numItems = $('.sub_text_options_'+className).length;
        }else if(option_type == 2) {
            var numItems = $('.sub_img_options_'+className).length;
        }else if(option_type == 3) {
            var numItems = $('.sub_sound_options_'+className).length;
        }

        $("#sub_right_answer_"+className).append("<option value=''> Choose Sub Correct Answer </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#sub_right_answer_"+className).append("<option value="+ i +">Option "+ i +"</option>")
        }
    });


    /* add more sub question */
    var i = 1;
    $('#sub_question').on('click', function(){
        i++;
        names.push('options_'+i);
        $('.text_options_list').val(names);

        var sub_question_type = $('.sub_question_type:checked').val();
        var sub_options_type = $('.sub_option_type:checked').val();

        if(sub_question_type){
            if(sub_options_type){
                if(sub_question_type == 1){
                    $('#more_sub_question').append('<div class="sub_question_txt extra_question"><span id="id_'+i+'" class="btn btn-danger btn-sm remove_sub_question" style="float: right;margin-bottom: 2px;">&times;</span><div class="form-group">'+
                        '<label for="sub_question">Sub Question '+ i +'</label>'+
                        // '<input type="text" class="form-control sub_question_text" name="sub_text_question[]" id="" placeholder="Sub Question" required/>'+
                        '<textarea class="form-control sub_question_text tinymce-editor" name="sub_text_question[]" placeholder="Sub Question '+ i+'"></textarea>'+
                        '<div class="invalid-feedback">This field is required.</div>'+
                        '</div>' +
                        '<span id="more_sub_option_'+i+'"></span>' +
                        '<select name="sub_right_answer[]" id="sub_right_answer_'+i+'" class="form-control mt-4 sub_right_answer" required>'+
                        '<option value=""> Choose Sub Correct Answer</option>'+
                        '<option value="1">Option 1</option>'+
                        '</select>' +
                        '<div class="invalid-feedback">This field is required.</div>'+
                        '<br></div>');

                        // ----------- For Appended Sub Question Text editor
                        tinymce.init({
                                    selector: 'textarea.tinymce-editor',
                                    height: 150,
                                    menubar: false,
                                    plugins: [
                                        'advlist autolink lists link image charmap print preview anchor',
                                        'searchreplace visualblocks code fullscreen',
                                        'insertdatetime media table paste code help wordcount', 'image'
                                    ],
                                    toolbar: 'undo redo | formatselect | ' +
                                        'bold italic forecolor backcolor | alignleft aligncenter ' +
                                        'alignright alignjustify | bullist numlist outdent indent | ' +
                                        'removeformat | help',
                                    //content_css: '//www.tiny.cloud/css/codepen.min.css'
                                });

                }
                else if(sub_question_type == 2)
                {
                    $('#more_sub_question').append(''+
                        '<div class="sub_question_image extra_question"><span id="id_'+i+'" class="btn btn-danger btn-sm remove_sub_question" style="float: right;margin-bottom: 2px;">&times;</span><div class="form-group">'+
                        '<label for="sub_question">Sub Question</label><br>'+
                        '<div class="fileinput fileinput-new" data-provides="fileinput">'+
                        '<div class="fileinput-new thumbnail">'+
                        '<img src="assets/img/authors/no_avatar.jpg" alt="..." class="img-responsive" style="width: 180px; height: 100px;"/>'+
                        '</div>'+
                        '<div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div>'+
                        '<div>'+
                        '<span class="btn btn-primary btn-file btn-sm">'+
                        '<span class="fileinput-new">Choose image</span>'+
                        '<span class="fileinput-exists">Change</span>'+
                        '<input type="file" class="form-control img_sub_question" name="sub_img_question[]" accept="image/*" id="" required/>'+
                        '<div class="invalid-feedback">This field is required.</div>'+
                        '</span>'+
                        '<span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>'+
                        '</div>'+
                        '</div>'+
                        '</div>' +
                        '<span id="more_sub_option_'+i+'"></span>' +
                        '<select name="sub_right_answer[]" id="sub_right_answer_'+i+'" class="form-control mt-4 sub_right_answer" required>'+
                        '<option value=""> Choose Sub Correct Answer</option>'+
                        '<option value="1">Option 1</option>'+
                        '</select>' +
                        '<div class="invalid-feedback">This field is required.</div>' +
                        '<br></div>');
                }
                else if(sub_question_type == 3)
                {
                    $('#more_sub_question').append('<div class="sub_question_snd extra_question"><span id="id_'+i+'" class="btn btn-danger btn-sm remove_sub_question" style="float: right;margin-bottom: 2px;">&times;</span><div class="form-group">'+
                        '<label for="sub_question">Sub Question</label>'+
                        '<input type="file" class="form-control sub_sound_questions" name="sub_sound_question[]" id="" accept="audio/*" required/>'+
                        '<div class="invalid-feedback">This field is required.</div>'+
                        '</div>' +
                        '<span id="more_sub_option_'+i+'"></span>' +
                        '<select name="sub_right_answer[]" id="sub_right_answer_'+i+'" class="form-control mt-4 sub_right_answer" required>'+
                        '<option value=""> Choose Sub Correct Answer</option>'+
                        '<option value="1">Option 1</option>'+
                        '</select>' +
                        '<div class="invalid-feedback">This field is required.</div>'+
                        '<br></div>');
                }
            }
            else{
                toastr.error('You Got Error', 'Please choose sub options type!', {timeOut: 5000});
            }
        }
        else{
            toastr.error('You Got Error', 'Please choose sub questions type!', {timeOut: 5000});
        }

        if(sub_options_type == 1){
            $('#more_sub_option_'+ i).append('<div class="form-group">'+
            '<label for="option">Option</label>'+
                '<input type="text" class="form-control sub_text_options_'+i+'" name="sub_text_options_'+i+'[]" id="" placeholder="Option" required/>'+
                '<div class="invalid-feedback">This field is required.</div>'+
                '</div>'+
                '<span class="sub_more_text_opt_'+i+'"></span>'+
                '<div class="btn btn-info btn-sm sub_text_opt" id="sub_text_opt_'+i+'">add more</div>');
        }
        else if(sub_options_type == 2)
        {
            $('#more_sub_option_'+i).append('<div class="row">'+
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
            '<input type="file" class="form-control sub_img_options_'+i+'" name="sub_img_options_'+i+'[]" accept="image/*" id="" required/>'+
            '<div class="invalid-feedback">This field is required.</div>'+
            '</span>'+
            '<span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>'+
            '</div>'+
            '</div>'+
            '<label id="sub_img_options_0[]-error" class="error" for="sub_img_options_0[]" hidden></label>'+
        '</div>'+
        '</div>'+
        '<span id="sub_more_img_opt_'+i+'"></span>'+
            '</div>'+
            '<div class="btn btn-info btn-sm sub_img_opt" id="sub_img_opt_'+i+'">add more</div>');
        }
        else if(sub_options_type == 3)
        {
            $('#more_sub_option_'+i).append('<div class="form-group">'+
            '<label for="">Option</label>'+
                '<input type="file" class="form-control sub_sound_options_'+i+'" name="sub_sound_options_'+i+'[]" id="" accept="audio/*" required/>'+
                '<div class="invalid-feedback">This field is required.</div>'+
            '</div>'+
            '<span id="sub_more_sound_opt_'+i+'"></span>'+
            '<div class="btn btn-info btn-sm sub_sound_opt" id="sub_sound_opt_'+i+'">add more</div>');
        }
    });

    /* remove sub question */
    $(document).on('click', '.remove_sub_question', function(e){
        var id = $(this).attr('id');
        var split_id = id.split(/_/);
        names = jQuery.grep(names, function(value) {
            return value != 'options_'+split_id[1];
        });
        $('.text_options_list').val(names);

        $(this).parent('.extra_question').remove();
    });

    /*radio button validation*/

    $('.create').on('click', function () {
        var question_type = $('.question_type:checked').val();
        var sub_question_type = $('.sub_question_type:checked').val();
        var sub_option_type = $('.sub_option_type:checked').val();
        var option_type = $('.option_type:checked').val();
        var sub_question_enable = $('#sub_question_enable:checked').val();

        if(question_type){
            $('#question_type_error').hide();
        }else{
            $('#question_type_error').show();
        }

        if(sub_question_enable){
            if(sub_question_type){
                $('#sub_question_type_error').hide();
            }else{
                $('#sub_question_type_error').show();
            }
            if(sub_option_type){
                $('#sub_option_type_error').hide();
            }else{
                $('#sub_option_type_error').show();
            }
        }else{
            if(option_type){
                $('#option_type_error').hide();
            }else{
                $('#option_type_error').show();
            }
        }
    });

    $('.question_type').on('change', function () {
        $('#question_type_error').hide();
    });
    $('.option_type').on('change', function () {
        $('#option_type_error').hide();
    });
    $('.sub_question_type').on('change', function () {
        $('#sub_question_type_error').hide();
    });
    $('.sub_option_type').on('change', function () {
        $('#sub_option_type_error').hide();
    });

    $('.create').click(function(){
        $('.form-control:invalid').focus();
    });
});
