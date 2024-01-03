<div>
    <div class="location">
        <p><a href="{{ route('/') }}">{{ __('lang.home') }}</a> / {{ __('lang.news') }}</p>
    </div>
    <div class="container-fluid blog py-2 my-2">
        <div class="container  py-5">
            <div class="title" data-wow-delay=".3s">
                <h4>{{ __('lang.news') }}</h4>
            </div>
            @if (count($data) > 0)
            <div class="box-news">
                    @foreach ($data as $item)
                        <div class="box">
                            <a href="{{ route('fontend.news_detail', ['id' => $item->id]) }}">
                                @if (!empty($item->image))
                                    <img src="{{ $item->image }}" alt="">
                                @else
                                    <img src="{{ asset('fontend/img/news.png') }}" alt="">
                                @endif

                                <div class="content">
                                {!! $item->description !!}
                                </div>
                                <p class="data">{{ optional($item->created_at)->format('Y-m-d') }}</p>
                            </a>
                        </div>
                    @endforeach
            </div>
            @else
            <h3 class="text-center">ຍັງບໍມີການເຄື່ອນໄຫວໃດໆ</h3>
        @endif
            <div class="float-left pagination">
                {{ $data->links('livewire.backend.pagination.pagination-component') }}
            </div>
        </div>
    </div>
</div>
