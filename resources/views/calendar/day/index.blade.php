@extends('app')

@section('content')
    <h5 class="text-center mt-3 mb-3">Calendar</h5>
    <button type="button" class="btn btn-outline-primary add mb-2 float-right"><i class="fas fa-plus"></i></button>
    <table class="table table-bordered text-center">
        <thead>
            <th>Day</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($week as $item)
                <tr id="item-{{$item->id}}">
                    <td>
                        <a href="{{route('calendar.hour.show', $item->id)}}">
                        @php
                           setlocale(LC_ALL, 'rus_RUS.utf-8');
                            $date = strftime('%b-%d-%a', strtotime($item->day));
                            echo $date;
                        @endphp
                        </a>
                    </td>
                    <td width='150px' class="text-center">
                        <button type="button" class="btn btn-outline-primary edit mr-2" data-id="{{$item->id}}" data-date='{{$item->day}}'><i class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-outline-danger delete"  data-id="{{$item->id}}"><i class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="btn btn-outline-danger"  id='close'>
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <div class="alert-danger mt-3 mb-3"></div>
             <form>
                @csrf
                <div class="form-group">
                    <input type="date" class="form-control" id="date">
                </div>
             </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary save">Сохранить</button>
            </div>
          </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/calendar/day.js') }}"></script>
@endsection