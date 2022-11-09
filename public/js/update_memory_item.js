$(document).ready(function(){

    // add more sub qeustion image
    var total_question = [];
    var x = 0;
    $('.more_sub_question').on('click', function(){
        x++;

        total_question.push(x);
        $('.total_question').val(total_question);
        $('.more_sub_question_blog').append('<div class="extra_field">' +
        '<span class="btb btn-danger btn-sm sub_question_remove" id="sub_question_remove_'+x+'" style="float: right; margin-bottom: 2px; cursor: pointer;">&times;</span>'+
        '<div class="form-group">'+
        '<label for="down_text">Sub Question Images</label>'+
        '<input type="file" class="form-control" name="sub_question_images_'+x+'[]" id="sub_question_images_'+x+'" multiple required/>'+
        '</div>' +
            '<div class="form-group">'+
            '<span class="btn btn-info btn-sm preview" id="preview_'+x+'">Preview</span>'+
            '</div>' +
            '<input type="hidden" id="sub_question_data_'+x+'" name="sub_question_data_'+x+'">' +
            '<input type="hidden" id="sub_correct_answer_'+x+'" class="empty" name="sub_correct_answer_'+x+'">' +
        '<div class="preview_question" id="preview_question_'+x+'"></div></div>');
    });

    // remove sub question

    $(document).on('click', '.sub_question_remove', function(e){

        var id = $(this).attr('id');
        var this_id = id.split('_');
        var sub_question_data = $('#sub_question_data_'+this_id[3]).val();

        $(this).parent('.extra_field').remove();
        e.preventDefault();

        total_question = jQuery.grep(total_question, function(value) {
            return value != this_id[3];
        });
        $('.total_question').val(total_question);

        // delete sub question images
        if(sub_question_data != ''){
            var data = new FormData();
            data.append('sub_question_data', sub_question_data);

            $.ajax({
                url: '/removeMemoryImage',
                method:"POST",
                data:data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    console.log(data);
                }
            });
        }
    });

    // upload & preview image
    $(document).on('click', '.preview', function(e){
        var id = $(this).attr('id');
        var split_id = id.split('_');

        var myfiles = document.getElementById("sub_question_images_"+split_id[1]);
        var files = myfiles.files;
        var data = new FormData();

        for (i = 0; i < files.length; i++) {
            data.append('sub_question_images_'+split_id[1]+'[]', files[i]);
        }
        data.append('total_question', total_question);

        $.ajax({
            url: '/uploadMemoryImage',
            method:"POST",
            data:data,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data){
                    $('#preview_'+split_id[1]).attr('disabled', 'disabled');
                    $('#preview_'+split_id[1]).addClass('previewed');
                    $('#preview_'+split_id[1]).text('Previewed');
                    $('#preview_question_'+split_id[1]).show();

                    $('#sub_question_data_'+split_id[1]).val(data);
                    for(i = 0; i < data.length; i++){
                        $('#preview_question_'+split_id[1]).append('<img src="../assets/uploads/memory_options/'+data[i]+'"'+
                            'alt="..." id="'+i+'" class="icons appended_images_'+split_id[1]+'"/>');
                    }

                    // choose correct answer

                    var id = [];
                    $('.appended_images_'+split_id[1]).on('click', function(){
                        if ($(this).hasClass('checked')) {
                            $(this).removeClass('checked');
                            var array = id;
                            var removeItem = $(this).attr('id');
                            id = jQuery.grep(array, function(value) {
                                return value != removeItem;
                            });
                            $('#sub_correct_answer_'+split_id[1]).val(id);
                        }
                        else
                        {
                            $(this).addClass('checked');
                            id.push($(this).attr('id'));
                            $('#sub_correct_answer_'+split_id[1]).val(id);
                        }

                        var value = $('#sub_correct_answer_'+split_id[1]).val();
                        if(value == ''){
                            $('#sub_correct_answer_'+split_id[1]).addClass('empty');
                        }else{
                            $('#sub_correct_answer_'+split_id[1]).removeClass('empty');
                        }
                    });

                    window.onbeforeunload = function(e) {
                        var dialogText = 'We are saving the status of your listing. Are you realy sure you want to leave?';
                        e.returnValue = dialogText;

                        return dialogText;
                    };
                }else{
                    $('#preview_'+split_id[1]).removeAttr('disabled', 'disabled');
                    toastr.error('You Got Error', 'Data loading failed!', {timeOut: 5000})
                }
            }
        });
    });

    // remove old question
    var old_qt_id = [];
    $('.question_remove').on('click', function(){
        $(this).parent('.preview_question').remove();
        var id = $(this).attr('id');
        old_qt_id.push(id);

        $('#removed_question').val(old_qt_id);
    });
});