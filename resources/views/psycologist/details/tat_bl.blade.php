@extends('admin/layouts/tat')

{{-- Page title --}}
@section('title')
TAT / BL
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
        overflow: hidden;
    }

    #content {
        padding-top: 1px;
    }
</style>


@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h5>TAT / BL Module</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">TAT / BL</li>
        </ol>
    </section>

    @if(Auth::user()->hasRole('user'))
        <section class="content">
            <div class="container">
                <div class="row ">
                    <div class="row gallery">
                        @foreach($data as $key => $value)
                            <div class="col-md-3 pd"><a href="{{asset('assets/uploads/psy_module')}}/{{$value->file}}" rel="prettyPhoto[gallery1]" title="{{$value->title}}"><img src="{{asset('assets/uploads/psy_module')}}/{{$value->file}}" class="img-thumb" alt="{{$value->title}}" /></a></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    @endif
@stop


{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $("area[rel^='prettyPhoto']").prettyPhoto();
        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
        $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
        $("a[rel^='prettyPhoto']").prettyPhoto({social_tools: false,allow_resize: true,default_width: 720,default_height: 480,horizontal_padding: 10,modal: false,opacity: 0.90,autoplay: true });
      });
    </script>
@stop

