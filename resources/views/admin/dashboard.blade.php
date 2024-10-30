@extends('admin.template.layout')
@section('title', 'Dashboard')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Welcome Back {{ $user->username }}! 🎉</h5>
                                <p class="mb-4">
                                    Ready to share your next story with the world?"
                                </p>

                                <a href="javascript:;" class="btn btn-sm btn-outline-primary">Create Blog</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                    src="../admin-assets/img/illustrations/man-with-laptop-light.png"
                                    height="140"
                                    alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../admin-assets/img/icons/unicons/chart-success.png" alt="total blogs"
                                         class="rounded"/>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Blogs</span>
                            <h3 class="card-title mb-2">0</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../admin-assets/img/icons/unicons/wallet-info.png"
                                         alt="active blogs" class="rounded"
                                    />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Active Blogs</span>
                            <h3 class="card-title text-nowrap mb-1">0</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../admin-assets/img/icons/unicons/paypal.png" alt="blog category"
                                         class="rounded"/>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Blog Category</span>
                            <h3 class="card-title text-nowrap mb-2">0</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../admin-assets/img/icons/unicons/cc-primary.png" alt="inactive blogs"
                                         class="rounded"/>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Inactive Blogs</span>
                            <h3 class="card-title mb-2">0</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Recent Blogs</h5>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="../admin-assets/img/icons/unicons/paypal.png" alt="User"
                                         class="rounded"/>
                                </div>
                                <div
                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Paypal</small>
                                        <h6 class="mb-0">Send money</h6>
                                    </div>
{{--                                    <div class="user-progress d-flex align-items-center gap-1">--}}
{{--                                        <h6 class="mb-0">+82.6</h6>--}}
{{--                                        <span class="text-muted">USD</span>--}}
{{--                                    </div>--}}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
