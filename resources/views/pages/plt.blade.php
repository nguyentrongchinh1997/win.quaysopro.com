<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{asset('css/plt.css')}}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <title>Phúc lộc thọ</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>
        <div id="slot_screen">
            {{-- <div class="slot_inner"> --}}
                
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
                    @for ($i = 0; $i < 8; $i++)
                        <div class="col-lg-3">
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
                                <div class="winner_text winner_text{{$i}}"></div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="row" style="display: flex;
    justify-content: center;">
                    <div class="col-lg-3">
                        <div class="slot_box">
                            <div id="slotwrapper" class="slotwrapper8 d-flex justify-content-start">
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
                            <div class="winner_text winner_text8"></div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="slot_box">
                            <div id="slotwrapper" class="slotwrapper9 d-flex justify-content-start">
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
                            <div class="winner_text winner_text9"></div>
                        </div>
                    </div>
                </div>
                
                @endif
            {{-- </div> --}}
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="{{asset('js/slotmachine.min.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
    </body>
</html>