{{-- =================================== add ======================================= --}}
<script>
  document.addEventListener('add', function(e) {
    Swal.fire({
      title: "@lang('lang.add_success')",
      icon: "success",
      iconColor: 'success',
      timer: 3000,
      toast: true,
      position: 'top-right',
      showConfirmButton: false,
    });
  });
</script>
{{-- =================================== edit ======================================= --}}
<script>
  document.addEventListener('edit', function(e) {
    Swal.fire({
      title: "@lang('lang.edit_success')",
      icon: "success",
      iconColor: 'success',
      timer: 3000,
      toast: true,
      position: 'top-right',
      showConfirmButton: false,
    });
  });
</script>
{{-- =================================== delete ======================================= --}}
<script>
  document.addEventListener('delete', function(e) {
    Swal.fire({
      title: "@lang('lang.delete_success')",
      icon: "success",
      iconColor: 'success',
      timer: 3000,
      toast: true,
      position: 'top-right',
      showConfirmButton: false,
    });
  });
</script>
{{-- =================================== something-went-wrong ======================================= --}}
<script>
  document.addEventListener('something_went_wrong', function(e) {
    Swal.fire({
      title: "@lang('lang.something_went_wrong')",
      icon: "error",
      iconColor: 'danger',
      timer: 3000,
      toast: true,
      position: 'top-right',
      showConfirmButton: false,
    });
  });
</script>
{{-- =================================== can_not_delte ======================================= --}}
<script>
  document.addEventListener('can_not_delete', function(e) {
    Swal.fire({
      title: "@lang('lang.Cannot_deleted_because_still_active')",
      icon: "error",
      iconColor:  'danger',
      timer: 3000,
      toast: true,
      position: 'top-right',
      showConfirmButton: false,
    });
  });
</script>
{{-- =================================== login_failded ======================================= --}}
<script>
  document.addEventListener('login_faild', function(e) {
    Swal.fire({
      title: "@lang('lang.Invalid phone number or password')",
      icon: "error",
      iconColor:  'danger',
      timer: 3000,
      toast: true,
      position: 'top-right',
      showConfirmButton: false,
    });
  });
</script>
{{-- =================================== already-data ======================================= --}}
<script>
  document.addEventListener('already_data', function(e) {
    Swal.fire({
      title: '@lang("lang.already_data")',
      icon: "warning",
      iconColor:  'warning',
      timer: 3000,
      toast: true,
      position: 'top-right',
      showConfirmButton: false,
    });
  });
  //phone is already
  document.addEventListener('phone_is_already', function(e) {
    Swal.fire({
      title: '@lang("lang.phone_is_already")',
      icon: "error",
      iconColor:  'danger',
      timer: 3000,
      toast: true,
      position: 'top-right',
      showConfirmButton: false,
    });
  });
  // required_patient
  document.addEventListener('required_patient', function(e) {
    Swal.fire({
      title: '@lang("lang.required_patient")',
      icon: "warning",
      iconColor:  'warning',
      timer: 3000,
      toast: true,
      position: 'top-right',
      showConfirmButton: false,
    });
  });
  
</script>