@extends('gain.layout.app')
@section('content1')
    @include('gain.layout.header')

    @include('gain.layout.hero')
    @include('gain.layout.workspace')
    @include('gain.layout.about')
{{--    @include('gain.layout.program')--}}
    @include('gain.layout.event')
    @include('gain.layout.target')
    @include('gain.layout.news')
    @include('gain.layout.achievement')
    @include('gain.layout.partner')
    @include('gain.layout.contact')

    @include('gain.layout.map')
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush
