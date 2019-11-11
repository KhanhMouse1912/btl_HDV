@extends('layouts.user_layout')

@section('content')
    
<div class="relationship" id="relationship">
    <!-- Start: Header -->
    <div class="header mt-3 d-flex align-items-center">
        <div class="d-flex align-items-center mr_auto">
            <button id="create--relationship" class="create--relationship p-2">Tạo mối quan hệ</button>
            <button id="kindof--relationship" class="kindof--relationship p-2 ml-3">Tạo loại quan hệ</button>
        </div>
        <div class="input--search p-2 d-flex align-items-center justify-content-between ml_auto">
            <i class="fa fa-search" aria-hidden="true"></i>
            <form action="" method="GET" class="form--search">
              <input type="text" class="search--input" name="q" placeholder="Tìm kiếm...">
              <button type="submit" class="btn--submit-search">Search</button>
            </form>
            
        </div>
    </div>
    <!-- End: Header -->
    <!-- Start: Main -->
    @if(count($relationships) == 0)
        <div class="text-center py-3">Không có mối quan hệ nào!</div>
    @else
    @foreach($relationships as $relationship)
        <div class="main mt-3" id="main">
            <div class="wrapper">
                <div class="list--rela row m-0">
                    <div class="items col-lg-6">
                        <div class="content--list--rela p-3 d-flex align-items-center position-relative">
                            <div class="avt--relationship pr-3 mr-3">
                                <img src="../Authorization/images/girl.jpg" height="100px" width="100px" alt="">
                            </div>
                            <div class="info--rela position-relative">
                                <p class="mb-1"><b class="nameKindOf">{{$relationship->kindOfRelation['nameOfRelationship']}}</b> <span  id="name-relationship" class="name-relationship">{{$relationship->name}}</span> <span>-</span><span class="phone" id="phone-number"> {{$relationship->phoneNumber}}</span></p>
                                <p class="mb-1" id="time-met">Thời gian gặp: {{$relationship->time_met}}</p>
                                <p class="mb-1">Địa điểm: {{$relationship->addresses['ward_name']}}, {{$relationship->addresses['district_name']}}, {{$relationship->addresses['city_name']}}</p>
                                <p class="mb-1">Thông tin khác: {{$relationship->note}}</p>
                            </div>
                            <div class="position-absolute dots dots--options">
                                <div class="position-relative">
                                    <div class="show--actions"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></div>
                                    <div class="actions--rela position-absolute">
                                        <p class="mb-0"> <a class="update_button" value="{{$relationship}}">Sửa</a></p>
                                        <p class="mb-0"><a onclick="myConfirm({{$relationship->id_relationship}})">Xóa</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif
    {{$relationships->links()}}
    <!-- End: Main -->
    <!-- Start: Footer -->
    <div class="footer" id="footer"></div>
    <!-- End: Footer -->

    <!-- Popup Create Relationships -->
    <div class="modal--wrapper create--rela">
        <div class="modal--dialog d-flex justify-content-center align-items-center">
            <div class="modal--content px-3 py-4">
                <div class="modal--header">
                    <div class="title" id="title">Mối quan hệ</div>
                </div>
                <div class="modal--body my-3">
                    <form action="{{url('/relationship/create')}}" methods="POST" id="form-relationship">
                        @csrf
                        @method('Post')
                        <div class="form-group">
                            <div id="infor"></div>
                            <label for="exampleInputEmail1">Loại quan hệ</label>
                            <div class="position-relative">
                                <select name="kindOfRelationShip_id" id="kindOfRelationShip_id" value ="{{$kindOfRelationships}}"  class="options--choose-rela">
                                    @foreach($kindOfRelationships as $kind)
                                        <option value="{{$kind->id_kindOfRelationship}}">{{$kind->nameOfRelationship}}</option>
                                        @endforeach

                                </select>
                                <!-- <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" style="width:90%" placeholder="Nhập loại quan hệ"> -->
{{--                                <div class="plus position-absolute" style="top: 5px; right: 1rem; cursor: pointer">--}}
{{--                                    <i class="fa fa-plus" aria-hidden="true"></i>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" class="form-control" id="name-relationship-noti"
                                aria-describedby="emailHelp" placeholder="Nhập tên" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="tel" pattern="\d{3}[\-]\d{3}[\-]\d{4}" class="form-control" id="phone-number-noti"
                                aria-describedby="emailHelp" placeholder="032-601-2999" name="phoneNumber" required>
                        </div>
                        <div for="" class="m-3"><b>Địa chỉ</b></div>
                        <div class="d-flex align_items_center">
                            <div class="form-group mr-2">
                                <label for="">Thành phố</label>
                                <select name="city" id="address" value="{{json_encode($cities['LtsItem'])}}" class="item--create" required>
                                    @foreach($cities['LtsItem'] as $city)
                                        <option value="{{$city['ID']}}">{{$city['Title']}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <label for="">Quận/Huyện</label>
                                <select name="district" id="district" class="item--create" required>
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <label for="">Xã</label>
                                <select name="ward" id="ward" class="item--create" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label>Thời gian gặp</label>
                            <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                                <input class="form-control" id="time-met-noti" type="text" readonly name="time_met" />
                                <span class="input-group-addon" style="height: 34px; width: 39px; line-height: 34px; padding: 0;"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ghi chú</label>
                            <textarea type="text" class="form-control"
                                aria-describedby="emailHelp" placeholder="Thông tin khác" name="note" id="note_relationship-noti"></textarea>
                        </div>
                        <div class="modal--footer d-flex justify-content-between align-items-center">
                            <button class="btn--skip" type="button" id="btn-close">HỦY</button>
                            <button class="btn--submit" type="submit">Cập Nhật</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Popup Create Relationships -->
    <div class="modal--wrapper kindof--rela">
        <div class="modal--dialog d-flex justify-content-center align-items-center">
            <div class="modal--content px-3 py-4">
                <div class="modal--header">
                    <div class="title">Tạo mối quan hệ</div>
                </div>
                <div class="modal--body my-3">
                    <form action="{{url('/createKindOfRelationship')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nhập tên loại quan hệ</label>
                            <input type="text" class="form-control" id="" name="nameOfRelationship"
                                   aria-describedby="" placeholder="Nhập tên loại quan hệ">
                            @if ($errors->has('nameOfRelationship'))
                                <script>
                                    alert('Loại Quan Hệ Này Đã Tồn Tại Vui Lòng Thử Lại');
                                </script>
                            @endif
                        </div>
                        <div class="modal--footer d-flex justify-content-between align-items-center">
                            <button class="btn--skip" type="button">HỦY</button>
                            <button class="btn--submit" type="submit">TẠO</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


{{--     popop Delete --}}
    <div class="modal--wrapper delete--rela">
        <div class="modal--dialog d-flex justify-content-center align-items-center">
            <div class="modal--content px-3 py-4">
                <div class="modal--header">
                    <div class="title">Xóa mối quan hệ</div>
                </div>
                <div class="modal--body my-3 text-center">
                    <div class="desc">
                        Toàn bộ dữ liệu liên quan đến mối quan hệ
                    </div>
                    <div
                        class="modal--footer d-flex justify-content-between align-items-center"
                    >
                        <button class="btn--skip">HỦY</button>
                        <button class="btn--submit btn-warn">XÓA</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function myConfirm(id) {
        var txt;
        var r = confirm("Bạn có muốn xoá mối quan hệ này không!");
        if (r == true) {
            txt = "Mối quan hệ đã được xoá!";
            location.href = "/relationship/delete/"+id;
        }
        document.getElementById("demo").innerHTML = txt;
    }
</script>

@endsection