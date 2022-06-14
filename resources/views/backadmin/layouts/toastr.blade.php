@if (session()->has('success'))
<script>
    toastr.success("{{ session('success')}}", "Sukses")
</script>
@endif

@if ($errors->any())
<script>
    toastr.error("Silakan periksa kembali data yang diinputkan", "Terjadi Kesalahan");
</script>
@endif

@if (session()->has('error'))
<script>
    toastr.error("{{ session('error')}}", "Terjadi Kesalahan")
</script>
@endif