<main style="padding-top: 110px">
    <h5 class="text-center"><hr>Lịch đặt phòng<hr></h5>
    <div class="row pt-3 mx-5">
    <p class="ms-2 fs-4"><strong>Dãy 1</strong></p>
    @foreach ($rooms->sortBy('room_number') as $room)
        <div class="col-lg-2">
            <a style="width: 20rem; height: 12rem" data-bs-toggle="modal" data-bs-target="#room_{{$room->room_id}}" 
                class="card mb-3 m-auto btn text-start
                @if ($room->status == 'Đang trống') empty
                @elseif ($room->status == 'Đã đặt trước') order
                @elseif ($room->status == 'Đang sử dụng') use
                @elseif ($room->status == 'Bảo trì') maintenance
                @elseif ($room->status == 'Đang dọn dẹp') clearUp
                @endif">
                {{-- <div class="card-header">Header</div> --}}
                <div class="card-body text mt-4">
                    <h2 class="card-title">P.{{$room->room_number}}</h2>
                    <small>
                        <strong><p class="card-text">{{$room->room_name}}</p></strong>
                        <p class="mt-3">{{$room->status}}</p>
                    </small>
                </div>
            </a>
        </div>

        <div class="modal fade" id="room_{{$room->room_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  {{$room->room_name}}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
    @endforeach
    </div>
</main>
