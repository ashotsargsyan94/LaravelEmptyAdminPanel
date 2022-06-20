@extends('site.layouts.header')
@section('content')
{{--    <div class="main">--}}
{{--        <section--}}
{{--                style="position:relative;background-image:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),url({{asset('/u/banners/'.$contacts_banner->content->image)}}) "--}}
{{--                class="about_header header_background_dotted">--}}
{{--            <div class="header_txt">--}}
{{--                <div class="container text-md-left">--}}
{{--                    <p>{{$contacts_banner->content->title}}</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--        <style>--}}
{{--            .main {--}}
{{--                background-color: white !important;--}}
{{--            }--}}

{{--            footer {--}}
{{--                margin-top: 0 !important;--}}
{{--            }--}}
{{--        </style>--}}

{{--        <section class="container" style="padding:45px 15px ">--}}
{{--            <div class="row">--}}
{{--                <div style="margin-bottom: 30px" class="col-12 ">--}}
{{--                    <div style="text-align: center;font-family: Roboto Condensed, sans-serif;font-size: 33px;padding-bottom: 20px" class="text-center w-100 head_text">{!! $contacts_banner->content->text !!}</div>--}}
{{--                    @if ($errors->has('global'))--}}
{{--                        <div style="color: red" class="text-left w-100 err-global pb-3">* {{ $errors->first('global') }}</div>--}}
{{--                    @elseif(session('message_sent'))--}}
{{--                        <div style="color: green" class="green font-weight-bold text-center pb-3">{{ __('app.message sent') }}</div>--}}
{{--                    @endif--}}
{{--                    <form class="container" action="{{ route('contacts.send_mail') }}" method="post" id="contact-form">--}}
{{--                        @csrf--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                @if($errors->has('name'))--}}
{{--                                    <span class="text-left w-100 d-inline-block"  id="error" style="color: red">* {{$errors->first('name')}}</span>--}}
{{--                                    <style>.phone{border:1px solid red!important;}</style>--}}
{{--                                @endif--}}
{{--                                <input required name="name" placeholder="{{t('contact.name')}}" value="{{ old('name') }}" class="form-control mb-4 inp phone" type="text">--}}

{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                    @if($errors->has('email'))--}}
{{--                                    <span class="text-left w-100 d-inline-block"  id="error" style="color: red">* {{$errors->first('email')}}</span>--}}
{{--                                    <style>.email{border:1px solid red!important;}</style>--}}
{{--                                @endif--}}
{{--                                <input autocomplete="email" required name="email" placeholder="{{t('contact.email')}}" value="{{ old('email') }}" class="email form-control mb-4 inp" type="text">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                @if($errors->has('service'))--}}
{{--                                    <span class="text-left w-100 d-inline-block"  id="error" style="color: red">* {{$errors->first('service')}}</span>--}}
{{--                                    <style>.email{border:1px solid red!important;}</style>--}}
{{--                                @endif--}}
{{--                                <input  required name="email" placeholder="{{t('contact.interested_service')}}" value="{{ old('service') }}" class="email form-control mb-4 inp" type="text">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                            @if($errors->has('phone'))--}}
{{--                                    <span class="text-left w-100 d-inline-block"  id="error" style="color: red">* {{$errors->first('phone')}}</span>--}}
{{--                                    <style>.phone{border:1px solid red!important;}</style>--}}
{{--                                @endif--}}
{{--                                <input autocomplete="phone" required name="phone" placeholder="{{t('contact.telephone')}}" value="{{ old('phone') }}" class="form-control mb-4 inp phone" type="text">--}}

{{--                            </div>--}}
{{--                            <div class="col-12">--}}
{{--                                @if($errors->has('message'))--}}
{{--                                    <span class="text-left w-100 d-inline-block"  id="error" style="color: red">* {{$errors->first('message')}}</span>--}}
{{--                                    <style>.messagess{border:1px solid red!important;}</style>--}}
{{--                                @endif--}}
{{--                                <textarea  placeholder="{{t('contact.interesting')}}" class="messagess form-control mb-4 inp_text" name="message" id="" cols="30" rows="10">{{ old('message') }}</textarea>--}}
{{--                            </div>--}}
{{--                            <div class="col-12 d-flex justify-content-center">--}}
{{--                                <button class="send_email" type="submit" >{{t('contact.send_question')}} </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </form>--}}
{{--                </div>--}}
{{--                <section class="container">--}}
{{--                    @if ($info->data->iframe)--}}
{{--                        <iframe src="{{ url($info->data->iframe) }}"--}}
{{--                                width="100%" height="360" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
{{--                    @endif--}}
{{--                </section>--}}
{{--                @include('site.layouts.footer')--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </div>--}}






<div class="for-contacts__map">
    <iframe src="{{ $info->map->source }}" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</div>


<section>
    <div class="container">
        <div class="contact-us">
            <div class="contact-us__title">
                <h2>Կապ մեզ հետ</h2>
            </div>
            <div class="contact-us__info d_flex a_items_center j_content_between">
                <div class="contact-us__href">
                    <ul>
                        <li>
                            <img src="{{asset('f/site/img/Group10.png')}}">
                            @foreach($info->contacts as $address)
                                @if($address->address!='')
                                    <a href="javascript:void(0)">{{$address->address}}</a>
                        @endif
                        @endforeach
                        <li>
                            <img src="{{asset('f/site/img/Group11.png')}}">
                            @foreach($info->contacts as $phone)
                                @if($phone->phone!='')
                                    <a href="tel:{{$phone->phone}}">{{$phone->phone}} <br></a>
                                @endif
                            @endforeach
                        </li>
                        <li>
                            <img src="{{asset('f/site/img/Group12.png')}}">
                            @foreach($info->contacts as $email)
                                @if($email->email!='')
                                    <a href="mailto:{{$email->email}}">{{$email->email}} <br></a>
                                @endif
                            @endforeach
                        </li>
                    </ul>
                </div>
                <div class="contact-us__icon">
                    <ul>
                        @foreach($socials as $social)
                            <li><a target="_blank" href="{{$social->url}}">
                                    <img src="{{$social->icon()}}">
                                </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="contact-us__block">
                <form>
                    <div class="contact-us__form">
                        <div class="contact-us__cnt d_flex j_content_between f_wrap a_items_center">
                            <div class="contact-us__inp  mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class=" mdl-textfield__input" type="text" >
                                <label class="mdl-name mdl-textfield__label" >{{ t('app.Անուն:') }}</label>
                            </div>

                            <div class="contact-us__inp  mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class=" mdl-textfield__input" type="text" >
                                <label class="mdl-name mdl-textfield__label" >{{ t('app.Թեմա։') }}</label>
                            </div>

                            <div class="contact-us__inp  mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class=" mdl-textfield__input" type="text" >
                                <label class="mdl-name mdl-textfield__label" >{{ t('app.Էլ-հասցե։') }}</label>
                            </div>
                            <div class="contact-us__inp  mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class=" mdl-textfield__input" type="text" >
                                <label class="mdl-name mdl-textfield__label" >{{ t('app.Հեռ․՝') }}</label>
                            </div>
                        </div>
                        <div class="contact-us__textarea  mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <textarea class=" mdl-textfield__input" ></textarea>
                            <label class="mdl-name mdl-textfield__label" >{{ t('app.Հաղորդագրություն։') }}</label>
                        </div>
                        <div class="d_flex j_content_end">
                            <div class="contact-us__btn">
                                <button>{{ t('app.Ուղարկել') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


@include('site.layouts.footer')
@endsection
@push('js')

    {{--    @include('ckfinder::setup')--}}
@endpush
