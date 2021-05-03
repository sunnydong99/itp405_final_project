@extends('layouts.main')

@section('title', 'About')

@section('content')
<div class="row d-flex justify-content-around">
    <div class="col-5">
        <h3>Our Mission</h3>
        <p class="about-text">KPub seeks to create and promote a healthy, collaborative culture amongst K-Pop stans by providing a platform for everyone to be creative without judgment with the Dream Group Creator. We strive to provide an unbiased zone for you to keep track of and show off your biases <i class="fas fa-smile-wink"></i>. </p>
        <p class="about-text">We hope to build more features in the future to further promote friendly communication amongst fans of different groups.</p>
    </div>
    <div class="col-7">
        <img alt="Kpop graphic" id="about-img" src="https://cdn.vox-cdn.com/thumbor/gYuKcgbNZUcJVG8A1dEDO1gHbCg=/97x0:922x550/1025x683/cdn.vox-cdn.com/assets/1578749/kpop_lead.jpg"/>
    </div>
</div>

@endsection