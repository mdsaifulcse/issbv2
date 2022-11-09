@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Upcoming Events
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<style>
    /**** CONTAINERS *****/
    /*********************/
    #container {
        position: relative;
        margin: auto;
        margin-top: 0;
        width: 100%;
        max-width: 960px;
        max-height: 25000px;
        overflow: hidden;
    }

    #content {
        padding-top: 1px;
    }

    /******* INSIDE content *******/
    /*****************************/
    #content>li {
        font-size: 1.25em;
    }

    .content-slideshow {
        position: relative;
        margin: 0;
        top: 2px;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        height: 40rem;
        overflow: hidden;
    }

    /******* alignment classes******/
    /*****************************/
    .fluid {
        width: 100%;
        height: auto;
    }

    .aligncenter {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .aligncenterflex {
        display: flex;
        margin-left: auto;
        margin-right: auto;
    }

    .aligncenter {
        display: block;
        margin: auto;
        margin-top: 2px;
        padding: 0px;
    }

    /******* flexgrid ************/
    /*****************************/
    .flex-horizontal {
        display: flex;
        flex-direction: row;
    }

    .flex-vertical {
        display: flex;
        flex-direction: column;
        width: 100%;
    }
</style>
<link rel="stylesheet" href="{{ asset('assets/mibreit-gallery/css/mibreitGallery.css')}}" type="text/css" />
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h5>Upcoming Events Module</h5>
    <ol class="breadcrumb">
        <li>
            <a href="#">Admin</a>
        </li>
        <li class="active">Upcoming Events</li>
    </ol>
</section>

@if(Auth::user()->hasRole('user'))

<section class="content">
    <div class="row">
        <div class=flex-vertical>
            <div id="content">
                <div id="full-gallery" class="content-slideshow">
                    @foreach($data as $key => $value)
                    <a href="{{asset('assets/uploads/psy_module')}}/{{$value->file}}" target="_blank">
                    <div class="mibreit-imageElement" style="opacity:0">
                        <img src="{{asset('assets/uploads/psy_module')}}/{{$value->file}}" data-src="{{asset('assets/uploads/psy_module')}}/{{$value->file}}" data-title="{{$value->title}}" alt="{{$value->title}}" width=1280 height=853 />
                        <h3>{{$value->title}}</h3>
                    </div>
                    </a>
                    @endforeach
                </div>
                <div class="mibreit-thumbview">
                    @foreach($data as $key => $value)
                    <div class="mibreit-thumbElement">
                        <img src="{{asset('assets/uploads/psy_module')}}/{{$value->file}}" width="100" height="80" alt="{{$value->title}}" />
                    </div>
                    @endforeach
                </div>
                <h3 id="full-gallery-title" class="mibreit-slideshow-title"></h3>
            </div>
        </div>
    </div>
    <!--/row-->
</section>
@endif

@stop

{{-- page level scripts --}}
@section('footer_scripts')

<script src="{{ asset('js/jquery-3.5.1.min.js')}}" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/mibreit-gallery/mibreitGallery.min.js')}}"></script>
<script>
    $(document).ready(function() {
        mibreitGallery.createGallery({
            slideshowContainer: "#full-gallery",
            thumbviewContainer: ".mibreit-thumbview",
            titleContainer: "#full-gallery-title",
            allowFullscreen: !0,
            preloadLeftNr: 2,
            preloadRightNr: 3
        })
    })
</script>


<script>

</script>

@stop