@php(\App::setLocale( basename(App::getLocale())))
@foreach($messages as $message)

    @if($message->from_data)
        <a href="{{url('messages')}}" class="list-group-item list-group-item-action">

            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago">
                <div>
                    <img alt="image" @if($message->from_data->avatar) src="{{asset('/storage/uploads/avatar/'.$message->from_data->avatar)}}" @else src="{{asset('storage/uploads/avatar/avatar.png')}}" @endif class="avatar rounded-circle"/>
                </div>
                <div class="flex-fill ml-3">
                    <div class="h6 text-sm mb-0">{{$message->from_data->name}} <small class="float-right text-muted">{{$message->created_at->diffForHumans()}}</small></div>
                    <p class="text-sm lh-140 mb-0">
                        {!! $message->message !!}
                    </p>
                </div>
            </div>
        </a>
    @endif
@endforeach
