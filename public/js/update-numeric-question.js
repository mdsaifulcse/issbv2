$(document).ready(function(){
    var question_type  = $('.question_type:checked').val();
    var option_type  = $('.option_type:checked').val();
    if(question_type == 1){
        $('#qt_text_show').show();
    }else{
        $('#qt_img_show').show();
    }
    if(option_type == 1){
        $('#otp_text_show').show();
    }else{
        $('#opt_img_show').show();
    }

    var textId = $('.text_opt:last').attr("id").split(/_/);
    var Id = textId[1];

    var i = Id;
    $('#sub_question').on('click', function(){
        i++;
        $('#more_sub_question').append('<div class="sub_ques">'+
            '<span class="btn btn-danger btn-sm remove_sub_question" id="remove_'+i+'" style="float: right; margin-top: 5px; margin-bottom: 5px;">&times;</span>' +
            '<div class="form-group">'+
            '<label for="sub_question">Sub Question</label>'+
            '<input type="text" class="form-control sub_question" name="sub_question[]" id="" placeholder="Sub Question" required/>'+
            '<label class="invalid-feedback">This field is required.</label>'+
            '</div>'+
            '<div id="otp_text_show">'+
            '<div class="form-group">'+
            '<label for="option">Option</label>'+
            '<input type="text" class="form-control textOptions_'+i+'" name="text_options_'+i+'[]" id="" placeholder="Option" required/>' +
            '<label class="invalid-feedback">This field is required.</label>'+
            '</div>'+
            '<span class="more_text_opt"></span>'+
            '<div class="btn btn-info btn-sm textOpt_'+i+'">add more option</div>'+
            '<select name="sub_right_answer[]" id="" class="form-control sub_right_answer'+i+'" required>'+
            '<option value="">Choose Sub Correct Answer</option>'+
            '<option value="1">Option 1</option>'+
            '</select>'+
            '<label class="invalid-feedback">This field is required.</label>'+
            '</div>' +
            '</div>'
        );

        $(document).on('click', '.textOpt_'+i+'', function(e){

            var classNames = this.className.split(/_/);
            var className = classNames[1];

            $(this).prev('.more_text_opt').append('<div class="form-group extra_field">' +
                '<label for="down_text">Option</label>' +
                '<span class="btn btn-danger btn-sm remove_'+className+'" style="float: right;margin-bottom: 2px;">&times;</span>' +
                '<input type="text" class="form-control textOptions_'+className+'" name="text_options_'+className+'[]" placeholder="Option" required/>' +
                '<label class="invalid-feedback">This field is required.</label>' +
                '</div>'
            );

            var selectList  = $(this).next('.sub_right_answer'+className);
            selectList.find('option').remove();

            var numItems = $('.textOptions_'+className).length;

            $(this).next('.sub_right_answer'+className).append("<option value=''> Choose Sub Correct Answer </option>");
            for (var x=1; x<=numItems; x++)
            {
                $(this).next('.sub_right_answer'+className).append("<option value="+ x +">Option "+ x +"</option>")
            }
        });

        $(document).on('click', '.remove_'+i, function(e){
            $(this).parent('.extra_field').remove();
            e.preventDefault();

            var classNames = this.className.split(/_/);
            var className = classNames[1];

            var selectList  = $('.sub_right_answer'+className);
            selectList.find('option').remove();

            var numItems = $('.textOptions_'+className).length;

            $('.sub_right_answer'+className).append("<option value=''> Choose Sub Correct Answer </option>");
            for (var x=1; x<=numItems; x++)
            {
                $('.sub_right_answer'+className).append("<option value="+ x +">Option "+ x +"</option>")
            }
        });

    });

    $(document).on('click', '.text_opt', function(e){
        var idName = $(this).attr("id").split(/_/);
        var id = idName[1];

        $(this).prev('.more_text_opt').append('<div class="form-group extra_field">' +
            '<label for="down_text">Option</label>' +
            '<span class="btn btn-danger btn-sm remove" id="remove_'+id+'" style="float: right;margin-bottom: 2px;">&times;</span>' +
            '<input type="text" class="form-control textOptions_'+id+'" name="text_options_'+id+'[]" placeholder="Option" required/>' +
            '<label class="invalid-feedback">This field is required.</label>' +
            '</div>'
        );

        var selectList  = $(this).next("#sub_right_answer_"+id);
        selectList.find('option').remove();

        var numItems = $('.textOptions_'+id).length;

        if(numItems == 1){
            $("#remove_"+id).hide();
        }else{
            $("#remove_"+id).show();
        }

        $(this).next("#sub_right_answer_"+id).append("<option value=''> Choose Sub Correct Answer </option>");
        for (var i=1; i<=numItems; i++)
        {
            $(this).next("#sub_right_answer_"+id).append("<option value="+ i +">Option "+ i +"</option>")
        }
    });

    $(document).on('click', '.remove_sub_question', function(e){
        $(this).parent('.sub_ques').remove();
    });

    $(document).on('click', '.remove', function(e){
        $(this).parent('.extra_field').remove();
        e.preventDefault();

        var idName = $(this).attr("id").split(/_/);
        var id = idName[1];

        var selectList  = $("#sub_right_answer_"+id);
        selectList.find('option').remove();

        var numItems = $('.textOptions_'+id).length;

        if(numItems == 1){
            $("#remove_"+id).hide();
        }else{
            $("#remove_"+id).show();
        }

        $("#sub_right_answer_"+id).append("<option value=''> Choose Sub Correct Answer </option>");
        for (var i=1; i<=numItems; i++)
        {
            $("#sub_right_answer_"+id).append("<option value="+ i +">Option "+ i +"</option>")
        }
    });
});


(function() {
    'use strict';

    window.addEventListener('load', function() {

        var forms = document.getElementsByClassName('needs-validation');

        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();