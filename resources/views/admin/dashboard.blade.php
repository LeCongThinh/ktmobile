@extends('admin.app')
@section('title', 'Admin - Báo cáo thống kê')
@section('header-route')
    @parent <li class="breadcrumb-item active" aria-current="page">Báo cáo thống kê</li>
@endsection
@section('dashboard-active', 'active')
@section('content-pages')
    <div class="row mb-3">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Tổng doanh thu
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($totalAmount, 0, ',', '.') }} VND</div>
                            {{-- <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                    3.48%</span>
                            </div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Tổng đơn hàng
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orderCount }} đơn</div>
                            {{-- <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                                    12%</span>
                            </div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New User Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Thành viên mới
                            </div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $memberCount }} khách</div>
                            {{-- <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                                    20.4%</span>
                            </div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Đơn hàng chưa
                                duyệt
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $invoiceIncompleteCount }} đơn</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Báo cáo doanh thu theo tháng</h6>
                    <div class="dropdown no-arrow">
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top 6 sản phẩm bán chạy nhất</h6>
                </div>
                <div class="card-body">
                    @foreach ($bestSellingProducts as $product)
                        <div class="mb-3">
                            <div class="small text-gray-500">{{ $product->product->name }}
                                <div class="small float-right"><b>{{ $product->total_quantity }} chiếc</b></div>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $product->total_quantity / 2 }}%"
                                    aria-valuenow="{{ $product->total_quantity / 2 }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                {{-- <div class="card-footer text-center">
                    <a class="m-0 medium text-primary card-link" href="#">Xem thêm <i
                            class="fas fa-chevron-right"></i></a>
                </div> --}}
            </div>
        </div>
        <!-- Invoice Example -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Hóa đơn mới nhất</h6>
                    <a class="m-0 float-right btn btn-danger btn-sm" href="#">Xem thêm <i
                            class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#">#HNT0YLZSX5</a></td>
                                <td>Lê Nguyễn Vinh Quang</td>
                                <td>0896325144</td>
                                <td><span class="badge badge-success">Đã duyệt</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Chi tiết</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">#JUL394O0I1</a></td>
                                <td>Trương Thanh An</td>
                                <td>0963565677</td>
                                <td><span class="badge badge-warning">Đang chờ duyệt</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Chi tiết</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">#L10U8TAIJF</a></td>
                                <td>Phạm Thái Nguyên</td>
                                <td>0977223616</td>
                                <td><span class="badge badge-warning">Đang chờ duyệt</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Chi tiết</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">RA1453</a></td>
                                <td>Indri Junanda</td>
                                <td>Hat Rounded</td>
                                <td><span class="badge badge-success">Đã duyệt</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Chi tiết</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">RA8568</a></td>
                                <td>Rivat Mahesa</td>
                                <td>Oblong T-Shirt</td>
                                <td><span class="badge badge-danger">Chưa duyệt</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Chi tiết</a></td>
                            </tr>
                            </tr>
                            <tr>
                                <td><a href="#">RA1998</a></td>
                                <td>Udin Cilok</td>
                                <td>Baby Powder</td>
                                <td><span class="badge badge-success">Đã duyệt</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Chi tiết</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    <script>
        // Chuyển đổi dữ liệu PHP thành JSON để sử dụng trong JavaScript
        var monthlyData = @json(array_values($monthlyData));
    </script>
@endsection
