@if(session('success'))
  <script>
Swal.fire({
  position: 'top-mid',
  icon: 'success',
  title: 'Your work has been saved',
  showConfirmButton: false,
  timer: 1500
});
</script>
@endif

@if(session('warning'))
<div class="alert alert-warning" role="alert">
  {{ session('warning') }}
</div>
@endif

@if(session('message'))
<div class="container">
@if(session('error'))
<div class="alert alert-danger alert-dismissable" role="alert">
@else
<div class="alert alert-success alert-dismissable" role="alert">
@endif

<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
{{session ('message') }}
</div>
</div>
@endif
