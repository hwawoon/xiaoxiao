    {{Session::get("status");}}
    <hr>
    {{Session::get("error");}}
<form action="{{ action('RemindersController@postReset') }}" method="POST">
    <input type="email" name="email">
    <input type="submit" value="Send Reminder">
</form>