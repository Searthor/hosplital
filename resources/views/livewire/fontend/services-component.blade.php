<div>
    <div class="location">
        <p><a href="{{route('/')}}">{{__('lang.home')}}</a> / {{__('lang.service')}}</p>
    </div>
    <div class="container-fluid blog py-2 my-2">
        <div class="container  py-5">
            <div class="title" data-wow-delay=".3s" >
                <h4>{{__('lang.our_service')}}</h4>
            </div>
            <div class="box-server">
                @foreach ($data as $item)
                <div>
                    <img src="https://images.unsplash.com/photo-1701542183610-60708f7db8f7?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="">
                    <div class="content">
                        <h6>ບໍລິການປ່ວຍເງິນກູ</h6>
                        <a href="{{ route('fontend.service_detail',1)}}"><button>{{__('lang.details')}}</button></a>
                    </div>
                </div>
                @endforeach
              
            </div>
            <div class="float-left pagination">
                {{$data->links('livewire.backend.pagination.pagination-component')}}
            </div>
           

        </div>
    </div>
</div>
