@foreach ($rarticles as $rart)
<section>
    <div class="row tagtitle">
        <a href="{{URL::to('/art').'/'.$rart->id}}" >
                        <span>
                            {{$rart->title}}
                        </span>
        </a>
    </div>
    <div class="row">
        <a href="{{URL::to('/art').'/'.$rart->id}}">
            <img class="" src="{{URL::to('/')}}/{{$rart->thumbpath}}" >
        </a>
    </div>
</section>
@endforeach