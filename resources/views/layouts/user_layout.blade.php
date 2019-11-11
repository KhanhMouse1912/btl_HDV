<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hướng dịch vụ</title>
    <!-- link font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <!-- link bootstrap 4 - css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <!-- link style main -->
    <link rel="stylesheet" type="text/css" href="../css/all.css">
</head>
<body>
    <div id="home">
        <!-- Start: Header -->
        <div class="header" id="header">
            <div class="wrapper p-3 d-flex align-items-center">
                <div class="logo mr-auto">
                    <div class="name">RELA</div>
                </div>
                <div class="ml-auto d-flex align-items-center justify-content-end">
                    <div class="notifications--newest pr-4 position-relative">
                        <div class="position-relative">
                            <span class="bell"><i class="fa fa-bell" aria-hidden="true"></i></span>
                            {{-- <span class="position-absolute number--notification">{{$reminder_now->count()}}</span> --}}
                        </div>
                        <div class="position-absolute detail--notification">
                            <div class="list--noti-newest">
                                {{-- @foreach($reminder_now as $index => $e)
                                <div class="items p-3">
                                    <ul>
                                        <li>
                                            <span>Chuẩn bị hẹn:</span>
                                            <span class="px-1"><b>{{$e->kindOfRelationship}}</b></span>
                                            <span class="name">{{$e->name}}</span>
                                        </li>
                                        <li>
                                            <span>Lúc:</span>
                                            <span class="time">{{$e->time}}</span>
                                        </li>
                                        <li>
                                            <span>Tại:</span>
                                            <span class="place">{{$e->place}}</span>
                                        </li>
                                        <li>
                                            <span>Lý do:</span>
                                            <span class="reason">{{$e->reason}}</span>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                    @if(Auth::user())
                    <div class="info--user position-relative ml-auto">
                        <div class="info d-flex align-items-center">
                            <div class="avt"></div>
                            <div class="name px-2">{{Auth::user()->name}}</div>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </div>
                        <!-- Start: More info when click avt -->
                        <div class="more--info p-3 position-absolute" id="more--info">
                            <div class="d-flex align-items-center pb-3">
                                <div>
                                    <div class="pb-1 name">{{Auth::user()->name}}</div>
                                    <div class="pb-1 mail">{{Auth::user()->email}}</div>
                                </div>
                                <div class="avt ml-auto"></div>
                            </div>
                            <div class="log--out text-right pt-2"><a href="/logout">Đăng xuất</a></div>
                        </div>
                        <!-- End: More info when click avt -->
                        <div></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- End: Header -->
        <!-- Start: Main -->
        <div class="main--home" id="main--home">
            <div class="tab">
                <a class="tablinks" href="{{route('user_relationship')}}" id="defaultOpen">
                    <i class="fa fa-handshake-o" aria-hidden="true"></i><span class="pl-2">Mối quan hệ</span>
                </a>
                <a class="tablinks" href="{{route('user_notification')}}" ><i class="fa fa-bell"
                    aria-hidden="true"></i><span class="pl-2">Thông báo</span>
                </a>
            </div>
            <div id="relationship" class="tabcontent">
               @yield('content')
            </div>
        </div>
        <!-- End: Main -->
        <!-- Start: Footer -->
        <div class="footer" id="footer">
        </div>
        <!-- End: Footer -->
    </div>

    <!-- link font awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- script jq -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- link js bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <!-- link js main -->
    <script src="../js/all.js"></script>
    <script src="../ajax/getDistrictByCity.js"></script>

</body>
</html>