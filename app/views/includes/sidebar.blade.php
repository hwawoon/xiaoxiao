<div class="arecommend">
    <div class="rcmd-head">
        <span class="label label-warning">推荐一下</span>
    </div>
    <div class="rcmd-row">
        @foreach ($rarticles as $rart)
        <section>
            <div class="rcmd-title">
                <a href="{{URL::to('/art').'/'.$rart->id}}" >
                    <span>
                        {{$rart->title}}
                    </span>
                    <img class="" src="{{URL::to('/')}}/{{$rart->thumbpath}}" >
                </a>
            </div>
        </section>
        @endforeach
    </div>
</div>