@extends('layouts.app')

@section('content')
<section>
     <header>
     <div class="logo"><img src="{{ asset('img/logo.gif') }}"></div>
         <ul>
         <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->fname }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                      </div>
                </li>
                <li><a href="{{ url('category') }}" >Category</a></li>
                <li><a href="{{ url('appointment_history') }}" >Appointments</a></li>
                <li><a href="{{ url('exams_history') }}" class="active">Exam History</a></li>
             <li><a href="{{ url('home') }}">Home</a></li>
         </ul>
     </header>
     <div class="align-examscard">
     <div class="examscard">
                <div class="card-body">
                <table class="table table-striped">

   <thead>
   <div class="panel-body">
   <tr>
   <th colspan="3"><center><h2>Exams History</h2></center></th>
</tr>
   <tr>
<td><center>Exam Result </center></td>
<td><center>Date</center></td>
<td><center>Action </center></td>
</tr>
  </thead>
  <tbody id="dynamic-row">
  @foreach($myexams as $examhistory)
<tr>
<input type="hidden" class="btn_val_id" value="{{ $examhistory->id }}">
<td><center><p>{{ $examhistory->result_name }}</p></center></td>
<td><center><p>{{ date('d F, Y', strtotime($examhistory->created_at)) }} <p></center></td>
<td><center>
  <button type="button" class="btn btn-danger btn-sm del"><i class="fa fa-trash-o"></i></button>
</center></td>
</tr>
  @endforeach
  </tbody>

</table>

                    </div>
                </div>
            </div>
        </div>

</div>
<!-- DELETE EXAM HISTORY-->
<script>
$(document).ready(function(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $('.del').click(function (e){
    e.preventDefault();
var delete_id = $(this).closest("tr").find('.btn_val_id').val();
    const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})
swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    var data = {
      "_token": $('input[name=_token]').val(),
      "id": delete_id,
    };
    $.ajax({
      type: "DELETE",
      url: '/delete-history/'+delete_id,
      data: data,
      success: function (response) {
        swalWithBootstrapButtons.fire(
          response.status,
    )
    .then((result) => {
      location.reload();
    });
      }
    });


  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
   });
});
</script>

<!-- END FOR DELETE EXAM HISTORY -->

@endsection
