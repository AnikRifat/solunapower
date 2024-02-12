{{-- @extends($extend_blade) --}}
@extends($theme.'layouts.user')
@section('title',trans('Plan'))

@section('content')
    @include($theme.'sections.investment')
    {{-- @include($theme.'sections.why-chose-us') --}}
    @include($theme.'sections.we-accept')
@endsection

