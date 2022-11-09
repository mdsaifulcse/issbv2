$(document).ready(function() {

    var checkboxValue = JSON.parse(localStorage.getItem('checkboxValue')) || {}
    var $checkbox = $(".checkbox-container :checkbox");
    $checkbox.on("change", function() {
        $checkbox.each(function() {
            checkboxValue[this.id] = this.checked;
        });
        localStorage.setItem("checkboxValue", JSON.stringify(checkboxValue));
    });
    $.each(checkboxValue, function(key, value) {
        $("#" + key).prop('checked', value);
    });

    $('#checkall').on('click', function(){
        var checkall = $('input[id="checkall"]:checked').val();

        if(checkall >= 1){
            $('.check').prop('checked', true);
        }else{
            $('input[class="check"]:checked').prop('checked', false);
            localStorage.setItem("myData", ['']);
        }

        var checkbox = [];
        $('input[name^=checkbox]:checked').each(function(){
            checkbox.push($(this).val());
        });
        var prev = localStorage.getItem('myData');
        var current = [];
        if(prev != null){
            var prevVal = prev.split(/,/);
            var merge =  $.merge( $.merge( [], checkbox ), prevVal );
            current.push(merge);
        }else{
            current.push(checkbox);
        }
        localStorage.setItem("myData", current);
    });

    var checkall = $('input[id="checkall"]:checked').val();
    if(checkall >= 1){
        $('input[class="check"]').prop('checked', true);

        var checkbox = [];
        $('input[name^=checkbox]:checked').each(function(){
            checkbox.push($(this).val());
        });
        var prev = localStorage.getItem('myData');
        var current = [];
        if(prev != null){
            var prevVal = prev.split(/,/);
            var merge =  $.merge( $.merge( [], checkbox ), prevVal );
            current.push(merge);
        }else{
            current.push(checkbox);
        }
        localStorage.setItem("myData", current);
    }

    $('.check').on('change', function(){

        $('input[id="checkall"]:checked').prop('checked', false);

        if($(this).prop('checked')){

            var checkbox = [];
            $('input[name^=checkbox]:checked').each(function(){
                checkbox.push($(this).val());
            });
            var prev = localStorage.getItem('myData');
            var current = [];
            if(prev != null){
                var prevVal = prev.split(/,/);
                var merge =  $.merge( $.merge( [], checkbox ), prevVal );
                current.push(merge);
            }else{
                current.push(checkbox);
            }
            localStorage.setItem("myData", current);
        }else{

            var prev = localStorage.getItem('myData');
            var current = [];
            if(prev != null){
                var prevVal = prev.split(/,/);
                var removeItem = $(this).val();
                prevVal = jQuery.grep(prevVal, function(value) {
                    return value != removeItem;
                });

                current.push(prevVal);
            }
            localStorage.setItem("myData", current);
        }
    });

    var x = localStorage.getItem('myData');

    if(!x){
        $(".checkbox-container :checkbox").prop('checked', false);
    }


    $('.submit').on('click', function(){

        var x = localStorage.getItem('myData');

        var res = x.split(',');

        var data = [];
        $.each(res, function(i, el){
            if($.inArray(el, data) === -1) data.push(el);
        });

        var checkall = $("#checkall").prop('checked');
        var attr_data = $("#checkall").attr('data');

        if(checkall){
            $('.submit').text('Please wait');
            $('.submit').prop('disabled', true);

            var data = ['all'];
        }else{
            $('.submit').text('Please wait');
            $('.submit').prop('disabled', true);

            var data = data.filter(function(v){return v!==''});
        }

        $.ajax({
            url:"/activateItem",
            method:"POST",
            data: {'data': data, 'item_for':attr_data},
            success:function(data)
            {
                localStorage.clear();
                if (data)
                {
                    sessionStorage.setItem("activation", "success");
                    window.location.href = '/items/'+data+'/1';
                }
            },
            error: function (e) {
                toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000});

                $('.submit').text('Activate');
                $('.submit').prop('disabled', false);
            }
        });

        console.log(data);
        localStorage.clear();
    });
} );
