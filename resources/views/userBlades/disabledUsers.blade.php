@extends('Layout.dashboard2')
@section('content')
<div class="row justify-content-between mb-4">
    <div class="col-xl-3 col-lg-4">

    </div>

</div>
<div class="sals-boxes">
<table class="table table-bordered" id="disabledUsersTable">
    <tr>
        <th><input type ="checkbox" name ="checkbox[]" onchange="checkAll(this)" id="checkAll"></th>
        <th>Username</th>
        <th>email</th>
        <th>Action</th>
    </tr>

    <input type="hidden" value="{{ $i = 0 }}">

    @foreach ($disabledUsers as $userData)
    <tr>


        <td ><input type="checkbox" class="checkboxes"  onchange='checkChange();' value="{{ $userData->id }}"></td>
        <td>{{ $userData->username }}</td>
        <td>{{ $userData->email }}</td>


        <td>
            <form action="{{ route('admin-actions.destroy',$userData->id) }}" method="POST">

                <a class="btn" href="{{ route('admin-actions.show',$userData->id) }}"><span><i class="far fa-address-card" aria-hidden="true"></i></a>
                    @csrf
                {{ method_field('DELETE') }}

                <button type="submit" class="btn delete" onclick="if (!confirm('{{ $userData->firstname }} will be enabled, are you sure?')) { return false }">
                  <span><i class="fas fa-user" aria-hidden="true"></i></button>


            </form>
        </td>
    </tr>
    @endforeach
  </table>
  <!-- End table  -->
</div>
  @endsection
