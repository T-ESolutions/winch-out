<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ url('admin/dist/') }}/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{ url('admin/dist/') }}/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->

<script src="{{ url('admin/dist/') }}/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="{{ url('admin/dist/') }}/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ url('admin/dist/') }}/assets/js/custom/widgets.js"></script>
<script src="{{ url('admin/dist/') }}/assets/js/custom/apps/chat/chat.js"></script>
<script src="{{ url('admin/dist/') }}/assets/js/custom/modals/upgrade-plan.js"></script>
<script src="{{ url('admin/dist/') }}/assets/js/custom/modals/create-app.js"></script>
<script src="{{ url('admin/dist/') }}/assets/js/custom/modals/users-search.js"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->



<?php
$errors = session()->get("errors");
?>
@if( session()->has("errors"))
    <?php
    $e = implode(' - ', $errors->all());
    ?>

    <script>
        Swal.fire({
            icon: 'warning',
            title: "برجاء التأكد من البيانات.",
            text: "{{$e}} ",
            type: "error",
            timer: 5000,
            showConfirmButton: false
        });
    </script>

@endif

@if( session()->has("error"))
    <?php
    $e = session()->get("error");
    ?>

    <script>
        Swal.fire({
            icon: 'warning',
            title: "برجاء التأكد من البيانات.",
            text: "{{$e}} ",
            type: "error",
            timer: 5000,
            showConfirmButton: false
        });
    </script>

@endif

@if( session()->has("success"))
    <?php
    $e = session()->get("success");
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: "تمت العملية بنجاح.",
            text: "{{$e}} ",
            type: "success",
            timer: 5000,
            showConfirmButton: false,
            dir:"row"
        });
    </script>

@endif

<script>
    $(".form-select").each(function() {
        $(this).select2({
            theme: "bootstrap3",
            dropdownParent: $(this).parent()
        });
    });
</script>
@yield('script')
