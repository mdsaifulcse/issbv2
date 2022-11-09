/**
 * Created by User on 6/19/2019.
 */

$(document).ready(function(){
    $("#choose1").click(function(){
        $(this).hide();
        $("#display1").show();
        $("#choose2").show();

    });
    $("#choose2").click(function(){
        $(this).hide();
        $("#display2").show();
        $("#choose3").show();

    });
    $("#choose3").click(function(){
        $(this).hide();
        $("#display3").show();
        $("#choose4").show();

    });
    $("#choose4").click(function(){
        $(this).hide();
        $("#display4").show();

    });
    $("#remove1").click(function(){
        $("#choose2").hide();
        $("#choose3").hide();
        $("#choose4").hide();
        $("#choose1").show();

    });
    $("#remove2").click(function(){
        $("#display2").hide();
        $("#choose3").hide();
        $("#choose4").hide();
        $("#choose1").hide();
        $("#choose2").show();

    });
    $("#remove3").click(function(){
        $("#display3").hide();
        $("#choose4").hide();
        $("#choose2").hide();
        $("#choose1").hide();
        $("#choose3").show();

    });
    $("#remove4").click(function(){
        $("#display4").hide();
        $("#choose1").hide();
        $("#choose2").hide();
        $("#choose3").hide();
        $("#choose4").show();

    });
});