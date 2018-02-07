  @include('admin.inc.header')
  {{--{{dd($test)}}--}}
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Group Management
        <small>lists of group</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Group Management</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="groups_tbl" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Population</th>
                    <th>Created by</th>
                    <th width="80px" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($created as $group)
                  <tr>
                    <td class="">{{ $group['name'] }}</td>
                    <td class="">{{ $data[$group['id']]['population']}}</td>
                    <td>{{$group['created_by_id']}}</td>
                    <td id="{{ $group['id'] }}">
                      <div class="btn-group pull-right table-action custom"> <a class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span class="caret"></span> </a>
                        <ul class="dropdown-menu">
                         <li class="viewBtn">
                          <a href='{{ route("group_page", $group['id']) }}'> <i class="fa fa-eye"></i> View</a>
                        </li>
                        <li class="editBtn">
                          <a href='#'> <i class="fa fa-edit"></i> Edit</a>
                        </li>
                        <li class="blockBtn">
                          <a href='#' class="blockTxt">
                            <i class="fa fa-user-times"></i>
                            @if($group['block'])
                            Unblock
                            @else
                            Block
                            @endif
                          </a>
                        </li>
                        <li class="deleteBtn">
                          <a href='#'><i class="fa fa-trash-o"></i> Delete</a>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@include('admin.definable_flirt.ckeditor_edit_modal')
@include('admin.inc.footer')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! HTML::script('public/js/admin/group_management/grouplist.js') !!}
</body>
</html>
