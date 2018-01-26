@include('admin.inc.header')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <strong id="{{ $group->id }}" class="groupName">{{ucfirst($group->name)}}</strong>
      <small>list of members</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url() }}/admin/group_management/group_lists">Group Management</a></li>
      <li class="active">Members</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
         <div class="box box-header">
          <a href="{{ url() }}/admin/group_management/group/{{$group->id}}/add_members"><button class="btn btn-success pull-left"><i class="fa fa-plus-square"></i> Add Member</button></a>
        </div>
        <div class="box-body">
          <table id="user_list_tbl" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>Username</th>
               <th>Real Name</th>
               <th>Email</th>
               <th>Verified</th>
               <th width="80px" class="text-center">Action</th>
             </tr>
           </thead>
           <tbody>
            @foreach($members as $member)
            @if(!$member->block)
            <tr>
              <td>
                <img src="{{$member->photo}}" class="img-circle " width="45" alt="">
                {{ ' '.$member->username }}
              </td>
              <td class="realName">{!! $member->firstName !!} {!! $member->lastName !!} </td>
              <td class="user_email_cell">{{$member->email}} </td>

              @if($member->verified == 1)
              <td><label class=" label label-success">Yes</label></td>
              @else
              <td><label class=" label label-danger">No</label></td>
              @endif
              <td  id="{{ $member->id }}">
                <div class="btn-group pull-right table-action custom"> <a class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span class="caret"></span> </a>
                  <ul role="menu" class="dropdown-menu">
                    <li>
                      <a href='{{ url() }}/admin/users/{!! $member->id !!}'> <i class="fa fa-eye"></i> View</a>
                    </li>
                    <li class="blockBtn">
                      <a href='#'> 
                        <i class="fa fa-user-times"></i> 
                        Block
                      </a>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>
            @endif
            @endforeach

          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <h3>
            Block list
          </h3>
          <table id="user_block_list_tbl" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>Username</th>
               <th>Real Name</th>
               <th>Email</th>
               <th>Verified</th>
               <th width="80px" class="text-center">Action</th>
             </tr>
           </thead>
           <tbody>
            @foreach($members as $member)
            @if($member->block)
            <tr>
              <td>
                <img src="{{$member->photo}}" class="img-circle " width="45" alt="">
                {{ ' '.$member->username }}
              </td>
              <td class="realName">{!! $member->firstName !!} {!! $member->lastName !!} </td>
              <td class="user_email_cell">{{$member->email}} </td>

              @if($member->verified == 1)
              <td><label class=" label label-success">Yes</label></td>
              @else
              <td><label class=" label label-danger">No</label></td>
              @endif
              <td id="{{ $member->id }}">
                <div class="btn-group pull-right table-action custom"> <a class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span class="caret"></span> </a>
                  <ul role="menu" class="dropdown-menu">
                    <li>
                      <a href='{{ url() }}/admin/users/{!! $member->id !!}'> <i class="fa fa-eye"></i> View</a>
                    </li>
                    <li class="unBlockBtn">
                      <a href='#'> 
                        <i class="fa fa-user-times"></i>
                        Unblock
                      </a>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>
            @endif
            @endforeach

          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
</section>
</div>

{{-- @include('admin.group_management.add_members_modal', ['group_name' => $group->name, 'group_id' => $group->id, 'non_members' => $non_members, 'users' => $users]) --}}
@include('admin.inc.footer')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! HTML::script('public/js/admin/group_management/memberlist.js') !!}
</body>
</html>
