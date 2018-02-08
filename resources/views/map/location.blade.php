
@include('map.script-css')

{!! Form::hidden('invisible', $userInfo->latitude, array('id' => 'latitude')) !!}
{!! Form::hidden('invisible', $userInfo->longitude, array('id' => 'longitude')) !!}
{!! Form::hidden('invisible', $userInfo->id, array('id' => 'user_id')) !!}
{!! Form::hidden('invisible', $userInfo->firstName, array('id' => 'firstName')) !!}
{!! Form::hidden('invisible', $userInfo->photo, array('id' => 'photo')) !!}
{!! Form::hidden('invisible', $isSpeed, array('id' => 'current_page')) !!}
{!! Form::hidden('invisible', url(), array('id' => 'base_url')) !!}
<div ng-app="mapDatings">
    <div ng-controller="mapCtrl">
      @include('user.shared.virtual_gift_modal')

      
        <div id="map" class="map-class"></div>

        <div id="floating-panel"><a href="javascript:getMenus();" class="toggle-menus-data">MENU</a>
            <div class="filter-option-map pull-right" style="display: none">

                <a id="filtering-btn-map"><i class="fa fa-cog" aria-hidden="true"></i> Filter Map </a>
            </div>
        	<div id="listOFdata">
            <p style="text-align: center; margin-top: 35px; display: none;" id="pwait">Please wait..</p>

          </div>
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
  </div>
</div>
@extends('map.script-js')
