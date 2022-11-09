@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Image Options
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/image-options.css') }}">
    <style>
        .icons {
            padding: 2px;
        }
        .checked {
            border: 2px solid #030303;
        }
        .main-content {
            max-width: 545px;
            height: 445px;
        }
        .main-content>.icons:first-child {
            margin-top: 0px !important;
        }
        .main-content>.icons:last-child {
            margin-top: 0px !important;
        }
    </style>

@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h5>Welcome to Psychometrics Test</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li><a href="{{ URL::to('/') }}">Dashboard</a></li>
            <li>
                <a href="{{ URL::to('/item-create') }}">Item Create</a>
            </li>
            <li>
                <a href="{{ URL::to('/psym-item-create') }}">PSYM Item Create</a>
            </li>
            <li class="active">Memory draft</li>
        </ol>
    </section>

    <div class="main-content">
        <?php
        $dir = 'assets/images/img-options/';
        $files = glob($dir.'*.*');
        $countFiles = count($files);

        function displayImgs($dir, $n=0){
        $files = glob($dir.'*.*');
        shuffle($files);
        $files = array_slice($files, 0, $n);

        $i = 0;
        foreach($files as $file) {
        $i++;
        $marginTop = rand(1, 80);
        $marginBottom = rand(1, 50);
        $marginRight = rand(3, 80);
        $marginLeft = rand(1, 80);
        ?>
        <img class="icons" src="{{$file}}" id="{{ $i }}" alt="..." style="margin: <?php echo $marginTop.'px '.$marginBottom.'px '.$marginRight.'px '.$marginLeft.'px;'; ?>">
        <?php }
        }
        echo displayImgs($dir, $countFiles);
        ?>

    </div>

    <p id="array" style="font-size:40px"></p>
@stop

@section('footer_scripts')

    <script>
        $(document).ready(function(){
            var id = [];
           $('.icons').on('click', function(){
               if ($(this).hasClass('checked')) {
                   $(this).removeClass('checked');
                   var array = id;
                   var removeItem = $(this).attr('id');
                   id = jQuery.grep(array, function(value) {
                       return value != removeItem;
                   });
                   console.log(id);
               }
               else
               {
                   $(this).addClass('checked');
                   id.push($(this).attr('id'));
                   console.log(id)
               }
           });
        });
    </script>

@stop