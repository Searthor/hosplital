<div style="min-height: 30vh">
    <div class="location">
        <p><a href="{{ route('/') }}">{{ __('lang.home') }}</a> / {{ __('lang.news_description') }}</p>
        <p><a href="{{ url()->previous() }}">{{__('lang.back')}}</a></p>
    </div>


    <div class="container-fluid container-new-detail">
        <span>{{$date}}</span>
        <h5>{!! $description !!}</h5>
        <img src="{{asset($image)}}" alt="">  
    </div>
</div>
