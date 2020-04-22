@extends('app')

@section('content')
    <h5 class="text-center mt-3 mb-3">Calendar</h5>
    <button type="button" class="btn btn-outline-primary add mb-2 float-right"><i class="fas fa-plus"></i></button> 
    <table class="table table-bordered text-center">
        <thead>
            <th>Начало</th>
            <th>Конец</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($hours as $item)
                <tr id="item-{{$item->id}}">
                    <td>
                        @php
                           echo strftime('%H-%M', strtotime($item->begin));
                        @endphp
                    </td>
                    <td>
                        @php
                            echo strftime('%H-%M', strtotime($item->end));
                        @endphp
                    </td>
                    <td width='150px' class="text-center">
                        <button type="button" class="btn btn-outline-primary edit mr-2" data-id="{{$item->id}}"><i class="far fa-edit"></i></button>
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
                    <label for="begin" class='form-label'>Начало</label>
                    <input type="time" class="form-control" id="begin">
                </div>
                <div class="form-group">
                    <label for="end" class="form-label">Конец</label>
                    <input type="time" class="form-control" id="end">
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
<script src="{{ asset('js/calendar/hour.js') }}"></script>
@endsection