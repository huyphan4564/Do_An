@extends('auth.master')

@section('body')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Cài đặt
                    </div>
                    <h2 class="page-title">
                        Cấu hình Sao lưu CSDL
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <?php 
                                        $cd = new \App\Models\CaiDatModel();
                                        $cd->cau_hinh = \App\Models\CaiDatModel::FILE_NAME_DB;
                                        $data = $cd->chiTiet();
                                    ?>
                                    <label class="form-label">Tên file Backup</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control nameFile" placeholder="db-vlute-" autocomplete="off" value="{{$data->gia_tri ?? ""}}">
                                        <span class="input-group-text">
                                            Y-m-d-H-i-s
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?php 
                                        $cd->cau_hinh = \App\Models\CaiDatModel::FILE_PASS_DB;
                                        $data = $cd->chiTiet();
                                    ?>
                                    <label class="form-label">Đặt mật khẩu file backup</label>
                                    <input type="text" class="form-control passFile" value="{{$data->gia_tri ?? ""}}">

                                </div>

                                <div class="col-12">
                                    <label class="form-label">Thiết lập thời gian</label>
                                    <table class="w-100">
                                        <tr>
                                            <td class="minutes">Phút (0-59)</td>
                                            <td class="hours">Giờ (0-23)</td>
                                            <td class="days">Ngày (1-31)</td>
                                            <td class="months">Tháng (1-12)</td>
                                            <td class="weekdays">Thứ (0-6)</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-control minute" value="{{ $timeBackup[0] ?? "" }}">
                                            </td> 
                                            <td>
                                                <input class="form-control hour" value="{{ $timeBackup[1] ?? "" }}">
                                            </td>
                                            <td>
                                                <input class="form-control day" value="{{ $timeBackup[2] ?? "" }}">
                                            </td>
                                            <td>
                                                <input class="form-control month" value="{{ $timeBackup[3] ?? "" }}">
                                            </td>
                                            <td>
                                                <input class="form-control weekday" value="{{ $timeBackup[4] ?? "" }}">
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-2">
                                    <?php 
                                        $cd->cau_hinh = \App\Models\CaiDatModel::FILE_TIMESTORAGE_DB;
                                        $data = $cd->chiTiet();
                                    ?>
                                    <label class="form-label">Thời gian lưu file (ngày)</label>
                                    <input type="text" class="form-control timeFile" value="{{$data->gia_tri ?? ""}}">
                                </div>
                                <div class="col-2">
                                    <?php 
                                        $cd->cau_hinh = \App\Models\CaiDatModel::STORAGE_CAPACITY;
                                        $data = $cd->chiTiet();
                                    ?>
                                    <label class="form-label">Dung lượng lưu trữ (MB)</label>
                                    <input type="text" class="form-control storgeFile" value="{{$data->gia_tri ?? ""}}">
                                </div>

                            </div>
                            <div class="col-12">
                                <hr>
                                <button type="submit" class="btn btn-primary btnLuu">
                                    @component('auth.icons.save')@endcomponent
                                    Lưu thông tin
                                </button>

                                <button type="submit" class="btn btn-primary btnBackup">
                                    @component('auth.icons.save')@endcomponent
                                    Xuất file Backup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('script')
            <script>
                $(document).ready(function (){


                });
                

                $('.btnLuu').click(function (){
                    var month = $('.month').val();
                    var day = $('.day').val();
                    var hour = $('.hour').val();
                    var minute = $('.minute').val();
                    var weekday = $('.weekday').val();

                    var backup = `${minute} ${hour} ${day} ${month} ${weekday}`;
                    
                    $.ajax({
                        url: '{{ action('App\Http\Controllers\CaiDatController@postBackup') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            'FILE_NAME_DB': $('.nameFile').val(),
                            'FILE_PASS_DB': $('.passFile').val(),
                            'TIME_BACKUP_DB': backup,
                            'FILE_TIMESTORAGE_DB': $('.timeFile').val(),
                            'STORAGE_CAPACITY': $('.storgeFile').val(),
                        },
                        success: function (result) {
                            result = JSON.parse(result);
                            if (result.status === 200) {
                                toastr.success(result.message, "Thao tác thành công");
                                setTimeout(function () {
                                    location.reload();
                                }, 750);
                            } else {
                                toastr.error(result.message, "Thao tác thất bại");
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });

                $('.btnBackup').click(function(){

                    $.ajax({
                        url: '{{ action('App\Http\Controllers\CaiDatController@runBackup') }}',
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',

                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status === 200){
                                toastr.success(result.message, 'Thao tác thành công');
                            }
                            else{
                                toastr.error(result.message, "Thao tác thất bại");
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });



            </script>
@endsection
