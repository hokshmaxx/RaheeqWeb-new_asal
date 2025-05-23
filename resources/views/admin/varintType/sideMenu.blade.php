@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.variant'))}}
@endsection
@section('css')

    <style>
        a:link {
            text-decoration: none;
        }
    </style>

@endsection
@section('content')
                           <div class="container">
								<!--begin::Profile Overview-->
								<div class="d-flex flex-row">
									<!--begin::Aside-->

									<!--end::Aside-->
									<!--begin::Content-->


							    @yield('companyContent')

									<!--end::Content-->
								</div>
								<!--end::Profile Overview-->
							</div>
@endsection
