@extends('layouts.app')

@section('title', 'صفحه اصلی | نقاش ساختمان حرفه‌ای')

@section('content')
    <div class="fade-up">@include('home.hero')</div>
    <div class="fade-up">@include('home.trust-strip')</div>
    <div class="fade-up">@include('home.services', ['services' => $services])</div>
    <div class="fade-up">@include('home.projects', ['projects' => $projects])</div>
    <div class="fade-up">@include('home.process')</div>
    <div class="fade-up">@include('home.why')</div>
    <div class="fade-up">@include('home.testimonials-slider', ['testimonials' => $testimonials])</div>
    <div class="fade-up">@include('home.testimonials-form')</div>
@endsection