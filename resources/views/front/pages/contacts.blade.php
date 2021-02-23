@extends('layouts.app')
@section('meta_title') {{ $contactPage->meta_title }} @endsection
@section('meta_description') {{ $contactPage->meta_description }} @endsection
@section('content')
    <div class="catalog-page-container">
        <div class="system-container">
            <header class="header-container">
                <div class="header-block-text">
                    <h1>{{ $contactPage->title }}</h1>
                </div>
                <div class="breadcrumb-container">
                    <a href="{{ route('main') }}">{{ trans('site.home') }}</a> / {{ $contactPage->title }}
                </div>
            </header>
        </div>
        <div class="page-contacts-wrappers">
            <div class="system-container">
                <div class="contact-main-content">{!! $contactPage->body !!}</div>
                <form action="{{ route('site.page.contacts') }}" method="post">
                    @csrf
                    <!-- Line 1 -->
                    <div class="form-inputs-wrapper">
                        <div class="form-label-wrapper">
                            <span class="form-label">{{ trans('site.name') }} <span class="form-label-required">*</span></span>
                        </div>
                        <div class="form-label-wrapper">
                            <span class="form-label">{{ trans('site.email') }}<span class="form-label-required">*</span></span>
                        </div>
                        <div class="form-inputs">
                            <div class="form-icon"><img src="{{ asset('images/user-icon.png') }}"></div>
                            <input class="input-field" name="name" type="text">
                        </div>
                        <div class="form-inputs">
                            <div class="form-icon"><img src="{{ asset('images/email-icon.png') }}"></div>
                            <input class="input-field" name="email" type="text">
                        </div>
                    </div>
                    <!-- Line 2 -->
                    <div class="form-inputs-wrapper">
                        <div class="form-label-wrapper">
                            <span class="form-label">{{ trans('site.phone') }}</span>
                        </div>
                        <div class="form-label-wrapper">
                            <span class="form-label">{{ trans('site.subject') }}<span class="form-label-required">*</span></span>
                        </div>
                        <div class="form-inputs">
                            <div class="form-icon"><img src="{{ asset('images/phone-icon.png') }}"></div>
                            <input class="input-field" name="phone" type="text">
                        </div>
                        <div class="form-inputs">
                            <div class="form-icon"><img src="{{ asset('images/subject-icon.png') }}"></div>
                            <input class="input-field" name="subject" type="text">
                        </div>
                    </div>
                    <!-- Line 3 -->
                    <div class="form-textarea-wrapper ">
                        <div class="form-label-wrapper">
                            <span class="form-label">{{ trans('site.text_letter') }}<span class="form-label-required">*</span></span>
                        </div>
                        <div class="form-textarea-icon">
                            <img src="{{ asset('images/text-icon.png') }}">
                        </div>
                        <div class="form-textarea">
                            <textarea class="textarea-field" name="text" type="text"></textarea>
                        </div>
                    </div>
                    <!-- Line 4 -->
                    <div class="captcha-button-wrapper">
                        <!--<div class="captcha-field">
                            reCAPTCHA Code 'll Be Here!
                        </div>-->
                        <div class="button-field">
                            <input type="button" class="submit-button" value="{{ trans('site.send') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
