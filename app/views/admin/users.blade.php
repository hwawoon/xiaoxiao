@extends('admin.layouts.main')

@section('content')
<h2 class="sub-header">用户列表</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>功能</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                        <button>删除</button>
                        <button>禁用</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>

@stop