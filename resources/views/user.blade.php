<h1> List Of All Users </h1>
@foreach($users as $user)
	<li> {!! $user->firstName !!} </li>
@endforeach
<br/>
<hr/>
@if(Auth::check())
	Current User {!! Auth::user()->username !!}.{!! HTML::link('logout','logout') !!}
@endif
<hr/>