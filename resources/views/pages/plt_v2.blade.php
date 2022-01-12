<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/plt3.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>
<body id="slot_screen">
    @if (empty($type))
        <div class="slot_logo">
            <img src="{{asset('img/logo.png')}}">
        </div>
        <div class="slot_upload">
            <form method="POST" enctype="multipart/form-data" action="{{route('import-plt')}}">
                @csrf
                <label for="file_upload">Chọn file</label>
                <input id="file_upload" type="file" name="excel_file" accept=".xls,.xlsx">
            </form>
        </div>
    @else
        <div class="row">
            <div class="col-lg-12">
                <h1 style="text-align: center; margin-top: 30px; color: #fff">
                    KHÁCH HÀNG MAY MẮN
                </h1>
                <br>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr style="background: #4c9d2f; color: #fff">
                            <th>STT</th>
                            <th>Mã số</th>
                            <th>Khách hàng</th>
                        </tr>
                    </thead>
                    <tbody class="body-table">
                        @for ($i = 0; $i < 10; $i++)
                            <tr>
                                <td style="width: 5%; vertical-align: inherit; color: #fff" align="center">
                                    {{$i + 1}}
                                </td>
                                <td width="20%" align="center">
                                    {{-- <div id="slotwrapper" class="bg-spin">
                                        <div class="parent-slot slotwrapper{{$i}} d-flex justify-content-start">
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="slot_box">
                                        <div id="slotwrapper" class="slotwrapper{{$i}} d-flex justify-content-start">
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                            <div class="slot_item">
                                                <ul>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="winner_text winner_text{{$i}}"></div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{asset('js/slotmachine.min.js')}}"></script>
    <script src="{{asset('js/main2.js')}}"></script>
</body>
</html>