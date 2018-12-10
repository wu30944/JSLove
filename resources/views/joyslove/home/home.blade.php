@extends('joyslove.layout.layout')

@section('content')
<!--Header-->
<div class="header" id="home">
{{--{!! Form::open() !!}--}}
<!--/top-bar-->
    @include('joyslove.commons.navigate')
    <!--//top-bar-->
    <!-- banner-text -->

    @include('joyslove.banner.banner')

    <!-- //Modal1 -->
    <!--//Slider-->
</div>
<!--//Header-->
@include('joyslove.news.news')
@include('joyslove.menu.menu')
@include('joyslove.gallery.gallery')
@include('joyslove.store.store')
@include('joyslove.about.about')
@include('joyslove.contact.contact')

@endsection
