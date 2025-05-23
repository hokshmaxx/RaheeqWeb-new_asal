@extends('website.layout')
@section('title') {{$page->title}} @endsection
@section('css')
@endsection
@section('content')

	<section class="section_page_site">
            <div class="container">
                <div class="sec-head">
                    <h2>{{$page->title}}</h2>
                </div>
                 
                    {!! $page->description !!}
                 
         
            </div>
		</section>

@endsection

@section('script')
 
 	
@endsection

