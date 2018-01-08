@extends('master')
@section('form_area')

        
<div id="myModal" class="reveal-modal" style="background: none;">

  <div class="popup-bg">
    <div class="popup-inner">

      <div class="popup-content-bg new-dating-bg">
        <div class="popup-header">
          <h2 class="text-shedow new-dating-icon">Fill details to join Group </h2>
        </div>

        <div class="new-dating">
          <h4>After joining you can participate in group events.</h4>
        </div>


        <div class="clear"></div>

        <div class="new-dating-content">

          <form>

            <div class="form-group">
              <label for="exampleInputName2">Your Name</label>
              <input type="text" class="form-control" id="exampleInputName2" placeholder="Name" />
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Your Email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" />
            </div>

            <div class="form-group">
              <label for="exampleInputName2">Contact</label>
              <input type="text" class="form-control" id="exampleInputName2" placeholder="Contact no." />
            </div>

            <div class="form-group">
              <label for="exampleInputName2">Address</label>
              <textarea class="form-control" rows="3" placeholder="Type your address here"></textarea>
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <a class="close-reveal-modal">&#215;</a>
</div>

<div class="inner-header upcoming-banner">
  <div class="container">
    <h1>
      <!--<i class="calendar-event-icon"><img src="images/upcoming-event-icon.png"  alt=""></i>-->Groups</h1>
  </div>
</div>

<div class="inner-contendbg">

  <div class="row">
    <a class="btn btn-default" href="{!! url() !!}/groups/{!! $groups['0'] -> groupID!!}" role="button" style="color: #FFF; background: #E21D24;float: right;margin-bottom: 10px;">Back</a>
  </div>
  <div class="container">

    <div class="row">

      @if($groups['0'] -> logged_in != 0) @include('new_leftsidebar') @endif

      <div class="col-md-9">

        <div class="middle-content-section">

          <div class="groups_cntent">

            <div class="row">
              <div class="col-md-7">
                <h2> About Group</h2>
                @if($groups['0'] -> groupType == "Public")
                <p>
                  <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> &nbsp;&nbsp; Open Group</p>
                @else
                <p>
                  <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> &nbsp;&nbsp; Closed Group</p>
                @endif
                <div class="row" style="margin-bottom: 2%;">
                  <div class="col-md-4">
                    <a href="#">
                      <div class="grup_member">
                        <div>
                          <img src="{!! url() !!}/images/groups/{!! $groups['0'] -> groupID !!}/{!! $groups['0'] -> image !!}" class="img-responsive"
                            alt="group memberadmin image" />
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="col-md-8">
                    <h4>Created By:</h4>
                    <p>{!! $groups['0'] -> groupAdmin !!}</p>
                  </div>
                </div>

                <p>
                  <b>Group Name: </b> {!! $groups['0'] -> group_name !!}</p>
                <p>
                  <b>Members in Group: </b>{!! $groups['0'] -> membersToAddCount !!}</p>
                <p>
                  <b>Group Description: </b>{!! $groups['0'] -> description !!}</p>
              </div>
              <div class="col-md-5">


              </div>
            </div>


            <h3>Add Members</h3>
            <br />
            <div class="row">
              @if($groups['0'] -> groupID != null) {!! Form::open( array( 'url' => 'groups/'.$groups["0"] -> groupID.'/addMember', 'novalidate'
              => 'novalidate', 'files' => true)) !!}


              <input type="hidden" name="groupID" value="{!! $groups['0'] -> groupID !!}"> @if($groups['0'] -> membersToAddCount > 0 )
              <div class="cell2">
                <input type="checkbox" id="checkAll" name="checkAll[]" value="checkALl">
                <label for="check-two">
                  <span></span>Check ALL</label>
              </div>
              @endif @foreach($groups['0'] -> membersToAdd as $group) @if($group -> alreadyMember != 1)


              <div class="col-md-2">

                <a href="{!! url() !!}/users/{!! $group -> username !!}">
                  <div class="grup_member">
                    <div>
                      <img src="{{$group->photo}}" class="img-responsive" alt="group member image"
                      />
                    </div>
                    <div class="member_name">
                      <div class="cell">
                        <input type="checkbox" id="membersCheckBox" name="members[]" value="{!! $group -> friend_id !!}">
                        <label for="check-two">
                          <span></span>
                        </label>
                      </div>
                      {!! $group -> firstName !!} {!! $group -> lastName !!}
                    </div>
                  </div>
                </a>

              </div>

              @endif @endforeach @if($groups['0'] -> membersToAddCount > 0 )
              <input type="submit" value="Add Member(s)" class="common-red-btn button" /> @else
              <h3> No Members To Add. </h3>
              @endif {!! Form::close() !!}
            </div>
            @endif
          </div>



        </div>

      </div>

    </div>

  </div>


</div>

@stop


