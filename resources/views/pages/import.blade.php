@extends('layouts.index')

@section('content')
<div class="container" style="margin-top: 100px">
    @if (session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    <div class="row">
        <a href="{{route('remove')}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger">Xóa dữ liệu để import lại</a>
    </div>
    <div class="row">
        <h2>Import khách hàng</h2>
        
        <div class="col-lg-12">
            <form method="POST" action="{{route('import')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Chọn file Excel</label>
                    <input type="file" name="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" />
                </div>
                <div class="form-check">
                    <input type="checkbox" name="remove" value="true" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Xóa danh sách cũ</label>
                  </div>
                <p style="color: red">
                    @error('file')
                        {{$message}}
                    @enderror
                </p>
                <button type="submit" class="btn btn-success">Import</button>
            </form>            
        </div>
    </div>
    <br>
    <div class="row">
        <h2>
            Thay background
        </h2>
        <div class="col-lg-12">
            <form method="POST" action="{{route('background')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Chọn ảnh</label>
                    <input type="file" name="background" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" />
                </div>
                <p style="color: red">
                    @error('background')
                        {{$message}}
                    @enderror
                </p>
                <button type="submit" class="btn btn-success">Xác nhận</button>
            </form>            
        </div>
    </div>
    <br>
    <div class="row">
        <h2>
            Thêm số trúng
        </h2>
        <div class="col-lg-12">
            <form method="POST" action="{{route('update-code')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nhập số</label>
                    <input type="number" name="code" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập số đã quay" />
                </div>
                <p style="color: red">
                    @error('background')
                        {{$message}}
                    @enderror
                </p>
                <button type="submit" class="btn btn-success">Xác nhận</button>
            </form>            
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Danh sách số đã quay
            </h2>
        </div>
        <br>
        <div class="col-lg-12" style="text-align: right">
            <a class="btn btn-danger" href="{{route('reset')}}">Reset để quay lại</a>
        </div>
        <div class="col-lg-12">
            <table class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr style="background: #4c9d2f; color: #fff">
                        <th>STT</th>
                        <th>Mã số</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                    </tr>
                </thead>
                <tbody class="body-table">
                    @foreach ($numbers as $key => $item)
                        <tr>
                            <td align="center">{{++$key}}</td>
                            <td align="center">{{$item->code}}</td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>
                                {{$item->address}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Danh sách số đã import
            </h2>
        </div>
        <br>
        <div class="col-lg-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr style="background: #4c9d2f; color: #fff">
                        <th>STT</th>
                        <th>Mã số</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                    </tr>
                </thead>
                <tbody class="body-table">
                    @foreach ($customers as $stt => $item)
                        <tr>
                            <td align="center">{{++$stt}}</td>
                            <td align="center">
                                {{$item->code}}
                            </td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>
                                {{$item->address}}
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "pageLength": "{{count($customers)}}"
        });        
    } );
</script>
@endsection