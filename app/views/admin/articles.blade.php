@extends('admin.layouts.main')

@section('content')
<h2 class="sub-header">图片列表</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>标题</th>
            <th>图片</th>
            <th>功能</th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
        <tr>
            <td>{{$article->id}}</td>
            <td>{{$article->title}}</td>
            <td>
                <img src="{{URL::to('/').'/'}}{{$article->imgpath}}" width="250" />
            </td>
            <td>
                <button>删除</button>
                <button>禁用</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{$articles->links() }}
</div>

@stop