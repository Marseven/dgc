@if ($message = Session::get('success'))
    <!--begin::Alert-->
    <div class="alert alert-success d-flex align-items-center p-5">
        <!--begin::Icon-->
        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span
                class="path2"></span></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column">
            <!--begin::Title-->
            <h4 class="mb-1 text-dark">{{ $message }}</h4>
            <!--end::Title-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Close-->

        <!--end::Close-->
    </div>
    <!--end::Alert-->
@endif

@if ($message = Session::get('error'))
    <!--begin::Alert-->
    <div class="alert alert-danger d-flex align-items-center p-5">
        <!--begin::Icon-->
        <i class="ki-duotone ki-shield-cross fs-2hx text-danger me-4"><span class="path1"></span><span
                class="path2"></span><span class="path3"></span></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column">
            <!--begin::Title-->
            <h4 class="mb-1 text-dark">{{ $message }}</h4>
            <!--end::Title-->
        </div>
        <!--end::Wrapper-->

    </div>
    <!--end::Alert-->
@endif

@if ($message = Session::get('warning'))
    <!--begin::Alert-->
    <div class="alert alert-warning d-flex align-items-center p-5">
        <!--begin::Icon-->
        <i class="ki-duotone ki-information fs-2hx text-warning me-4"><span class="path1"></span><span
                class="path2"></span><span class="path3"></span></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column">
            <!--begin::Title-->
            <h4 class="mb-1 text-dark">{{ $message }}</h4>
            <!--end::Title-->
        </div>
        <!--end::Wrapper-->

    </div>
    <!--end::Alert-->
@endif

@if ($message = Session::get('info'))
    <!--begin::Alert-->
    <div class="alert alert-info d-flex align-items-center p-5">
        <!--begin::Icon-->
        <i class="ki-duotone ki-information fs-2hx text-info me-4"><span class="path1"></span><span
                class="path2"></span><span class="path3"></span></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column">
            <!--begin::Title-->
            <h4 class="mb-1 text-dark">{{ $message }}</h4>
            <!--end::Title-->
        </div>
        <!--end::Wrapper-->

    </div>
    <!--end::Alert-->
@endif

@if ($errors->any())
    <!--begin::Alert-->
    <div class="alert alert-danger d-flex align-items-center p-5">
        <!--begin::Icon-->
        <i class="ki-duotone ki-shield-cross fs-2hx text-danger me-4"><span class="path1"></span><span
                class="path2"></span><span class="path3"></span></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column">
            <!--begin::Title-->
            <h4 class="mb-1 text-dark">{{ $errors->first() }}</h4>
            <!--end::Title-->
        </div>
        <!--end::Wrapper-->

    </div>
    <!--end::Alert-->
@endif
