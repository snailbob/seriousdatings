
@include('map.script-css')
{!! Form::hidden('invisible', $userInfo->latitude, array('id' => 'latitude')) !!}
{!! Form::hidden('invisible', $userInfo->longitude, array('id' => 'longitude')) !!}
{!! Form::hidden('invisible', $userInfo->id, array('id' => 'user_id')) !!}
{!! Form::hidden('invisible', $userInfo->firstName, array('id' => 'firstName')) !!}
{!! Form::hidden('invisible', $userInfo->photo, array('id' => 'photo')) !!}
{!! Form::hidden('invisible', $isSpeed, array('id' => 'current_page')) !!}
{!! Form::hidden('invisible', url(), array('id' => 'base_url')) !!}

<div id="map" class="map-class"></div>

<div id="floating-panel"><a href="javascript:getMenus();">MENU</a>
	<div id="listOFdata"></div>
</div>

<div id="floating-panel2" style="display: none;">
    <b>Mode of Travel: </b>
    <select id="mode">
      <option value="DRIVING">Driving</option>
      <option value="WALKING">Walking</option>
      <option value="BICYCLING">Bicycling</option>
      <option value="TRANSIT">Transit</option>
    </select>
    </div>
@extends('map.script-js')
