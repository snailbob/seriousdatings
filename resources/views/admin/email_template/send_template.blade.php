@include('admin.inc.header')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Email Blast
            <small>lists</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Email Template Lists</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-body">
                        <h3 class="templateName">
                            {{$template->template_name}}
                        </h3>
                        <div class="row">
                            <div class="col-md-2">
                                <select class="form-control" id="select_user">
                                    <option value="all_user_email_tbl">All User</option>
                                    <option value="active_user_email_tbl">Active User</option>
                                    <option value="inactive_user_email_tbl">Inactive User</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <input type="checkbox" id="checkAll"> Select All
                            </div>
                        </div>
                        <table id="all_user_email_tbl" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><input type="checkbox" class="email_check" value="{{$user->id}}"></td>
                                    <td class="">
                                        <img src="{{$user->photo}}" class="img-circle " width="45" alt="">
                                        {{ ' '.$user->username }}
                                    </td>
                                    <td class="">{{ $user->email }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <table id="active_user_email_tbl" class="table table-bordered table-striped" style="display: none;">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                @if($user->verified)
                                <tr>
                                    <td><input type="checkbox" class="email_check" value="{{$user->id}}"></td>
                                    <td class="">
                                        <img src="{{$user->photo}}" class="img-circle " width="45" alt="">
                                        {{ ' '.$user->username }}
                                    </td>
                                    <td class="">{{ $user->email }} </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <table id="inactive_user_email_tbl" class="table table-bordered table-striped" style="display: none;">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                @if(!$user->verified)
                                <tr>
                                    <td><input type="checkbox" class="email_check" value="{{$user->id}}"></td>
                                    <td class="">
                                        <img src="{{$user->photo}}" class="img-circle " width="45" alt="">
                                        {{ ' '.$user->username }}
                                    </td>
                                    <td class="">{{ $user->email }} </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <button id="sendEmailBtn" class="btn btn-primary pull-right">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('admin.email_template.ckeditor_edit_modal')
@include('admin.inc.footer')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! HTML::script('public/js/admin/editable_email/template_list_actions.js') !!}
</body>
</html>
