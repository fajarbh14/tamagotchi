<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6">
            <div id="user-activity" class="card">
                <div class="card-header border-0 pb-0 d-sm-flex d-block">
                    <div>
                        <h2 class="main-title mb-1">Earnings</h2>
                    </div>
                    <div class="card-action card-tabs mt-3 mt-sm-0">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#user" role="tab">
                                    Monthly
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#bounce" role="tab">
                                    Weekly
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#session-duration" role="tab">
                                    Today
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="user" role="tabpanel">
                            <canvas id="activity" class="chartjs"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="row">
                <div class="col-sm-6">
                    <div class="widget-card-1 card">
                        <div class="card-body">
                            <div class="media">
                                <img src="{{ asset('assets/images/food-icon/1.png') }}" alt="" class="me-4" width="80">
                                <div class="media-body">
                                    <h3 class="mb-sm-3 mb-2 text-black"><span class="counter ms-0">128</span></h3>
                                    <p class="mb-0">Total Menus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="widget-card-1 card">
                        <div class="card-body">
                            <div class="media">
                                <img src="{{ asset('assets/images/food-icon/2.png') }}" alt="" class="me-4" width="80">
                                <div class="media-body">
                                    <h3 class="mb-sm-3 mb-2 text-black"><span class="counter ms-0">400</span></h3>
                                    <p class="mb-0">Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="widget-card-1 card">
                        <div class="card-body">
                            <div class="media">
                                <img src="{{ asset('assets/images/food-icon/3.png') }}" alt="" class="me-4" width="80">
                                <div class="media-body">
                                    <h3 class="mb-sm-3 mb-2 text-black"><span class="counter ms-0">678</span></h3>
                                    <p class="mb-0">Items Sold</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="widget-card-1 card">
                        <div class="card-body">
                            <div class="media">
                                <img src="{{ asset('assets/images/food-icon/4.png') }}" alt="" class="me-4" width="80">
                                <div class="media-body">
                                    <h3 class="mb-sm-3 mb-2 text-black"><span class="counter ms-0">128</span></h3>
                                    <p class="mb-0">Total Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>