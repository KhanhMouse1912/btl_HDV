@extends('layouts.user_layout')

@section('content')

<div class="relationship" id="relationship">
    <!-- Start: Header -->
    <div class="header mt-3 d-flex align-items-center">
        <div class="d-flex align-items-center mr_auto">
            <button id="create--notification" class="create--notification p-2">Thêm lời nhắc</button>
        </div>
        <div class="input--search p-2 d-flex align-items-center justify-content-between ml_auto">
            <i class="fa fa-search" aria-hidden="true"></i>
            <form action="" method="GET" class="form--search">
              <input type="text" class="search--input" name="q" placeholder="Tìm kiếm..." value="{{ request('q') }}">
              <button type="submit" class="btn--submit-search">Search</button>
            </form>
            
        </div>
    </div>
    <!-- End: Header -->
    <!-- Start: Main -->
    <div class="main mt-3" id="main">
        <div class="wrapper">
            @if(count($reminder) == 0)
            <div class="text-center py-3">Không có thông báo nào!</div>
            @else
            @foreach($reminder as $index => $e)
            <div class="list--rela row m-0">
                <div class="items col-lg-6">
                    <div class="content--list--rela p-3 d-flex align-items-center position-relative">
                        <div class="avt--relationship pr-3 mr-3">
                            <img src="../Authorization/images/girl.jpg" height="100px" width="100px" alt="">
                        </div>
                        <div class="info--rela position-relative">
                            <p class="mb-1"><b>{{$e->kindOfRelationship}}</b> {{$e->name}} <span class="phone"> - {{$e->phoneNumber}}</span></p>
                            <p class="mb-1">Thời gian gặp: {{$e->time}}</p>
                            <p class="mb-1">Địa điểm: {{$e->place}}</p>
                            <p class="mb-1">Lý do gặp: {{$e->reason}}</p>
                        </div>
                        <div class="position-absolute dots dots--options">
                            <div class="position-relative">
                                <div class="show--actions"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></div>
                                <div class="actions--rela position-absolute">
                                    <p class="mb-0">Sửa</p>
                                    <p class="mb-0 actions--delete" data-id="{{$e->id_reminders}}">Xóa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <!-- End: Main -->
    <!-- Start: Footer -->
    <div class="footer" id="footer"></div>
    <!-- End: Footer -->

    <!-- Popup Create Relationships -->

    <form action="/reminder" method="post">
        @csrf
    <div class="modal--wrapper create--noti">
        <div class="modal--dialog d-flex justify-content-center align-items-center">
            <div class="modal--content px-3 py-4">
                <div class="modal--header">
                    <div class="title">Thêm lời nhắc</div>
                </div>
                <div class="modal--body my-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Loại quan hệ</label>
                            <div class="position-relative">
                                <select name="kindofrelationship" id="" class="options--choose-rela">
                                    <option value="Anh">Anh</option>
                                    <option value="Em">Em</option>
                                    <option value="Thầy">Thầy</option>
                                    <option value="Chú">Chú</option>
                                </select>
                                <!-- <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" style="width:90%" placeholder="Nhập loại quan hệ"> -->
                                {{-- <div class="plus position-absolute" style="top: 5px; right: 1rem; cursor: pointer">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </div> --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text"  name="name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Nhập tên" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="nmber" name="phone_number" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa điểm hẹn</label>
                            <input type="text" name="place" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Nhập địa chỉ" required>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label>Thời gian hẹn</label>
                            
                            <div id="datepicker1" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input class="form-control" name="time" type="text" readonly required/>
                                <span class="input-group-addon" style="height: 34px; width: 39px; line-height: 34px; padding: 0;"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ghi chú</label>
                            <textarea type="text" name="reason" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Thông tin khác" required></textarea>
                        </div>
                </div>
                <div class="modal--footer d-flex justify-content-between align-items-center">
                    <button class="btn--skip">HỦY</button>
                    <input class="btn--submit" type="submit" value="THÊM"/>
                </div>
            </div>
        </div>
    </div>
                    </form>
    
</div>

@endsection