@extends('layouts.candidate')

{{-- Page title --}}
@section('title')
Board Configuration
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
@parent
@endsection

{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h1>Welcome <small> Chest No. {{$chestno}} &nbsp;&nbsp; {{$fullname}}</small></h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Candidate</a>
        </li>
        <li class="active">Assessment</li>
    </ol>
</section>
<section class="content">
    <div class="row">

        <div class="col-lg-12">
            <div class="text-center"><a class="btn btn-lg btn-success" href="#" role="button">Refresh</a></div>
            <br>
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Instruction
                        </h3>
                    </div>
                    <div class="panel-body">


                    </div>
                </div>
                <br>
                <div class="text-center"><a class="btn btn-lg btn-primary" href="{{url('candidate/sample-test')}}" role="button">Sample Test</a></div>
                <br>
        </div>
    </div>

</section>
<!-- content -->



@endsection

{{-- page level scripts --}}
@section('footer_scripts')

@endsection
