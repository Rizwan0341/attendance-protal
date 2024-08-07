@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Scheduled') }}</div>
                <div class="row">
                    <div class="col-md-10 mx-auto">
    
                        @if (\Session::has('error'))
                            <div class="alert alert-danger " role="alert">
                                {{ \Session::get('error') }}
                            </div>
                        @elseif (\Session::has('success'))
                        
                            <div class="alert alert-success " role="alert">
                                {{ \Session::get('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('schedule.add') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <label for="shift_name" class="col-md-4 col-form-label text-md-end">{{ __('Shift Name') }}</label>

                            <div class="col-md-6">
                                <input id="shift_name" type="text" class="form-control" name="shift_name" value="{{ old('shift_name') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="start_time" class="col-md-4 col-form-label text-md-end">{{ __('Shift Start Time') }}</label>

                            <div class="col-md-6">
                                <input id="start_time" type="time" class="form-control" name="start_time" value="{{ old('start_time') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="end_time" class="col-md-4 col-form-label text-md-end">{{ __('Shift End Time') }}</label>

                            <div class="col-md-6">
                                <input id="end_time" type="time" class="form-control" name="end_time" value="{{ old('end_time') }}" required>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Scheduled') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Table Start -->

            <div class="card mt-5">
                <div class="card-header">{{ __('View Scheduled') }}</div>
                <div class="row">
                    <div class="col-md-10 mx-auto">
    
                        @if (\Session::has('errors'))
                            <div class="alert alert-danger " role="alert">
                                {{ \Session::get('errors') }}
                            </div>
                        @elseif (\Session::has('successs'))
                        
                            <div class="alert alert-success " role="alert">
                                {{ \Session::get('successs') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Shift Name</th>
                    <th scope="col">Shift Start Time</th>
                    <th scope="col">Shift End Time</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shiftss as $shift)
                    <tr>
                    <th scope="row">{{ $shift->id }}</th>
                    <td>{{ $shift->shift_name }}</td>
                    <td>{{ $shift->start_time }}</td>
                    <td>{{ $shift->end_time }}</td>
                    <td><button type="button" id="delete-{{ $shift->id }}" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button> <button type="button" id="edit-{{ $shift->id }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $shift->id }}" data-name="{{ $shift->shift_name }}" data-start="{{ $shift->start_time }}" data-end="{{ $shift->end_time }}">
                                <i class="bi bi-pencil-square"></i>
                            </button></td>
                    </tr>
                   
                    @endforeach
                    
                </tbody>
                </table>
                </div>
            </div>

            <!-- Table End  -->
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{ __('Edit Shift') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="shift_name">{{ __('Shift Name') }}</label>
                        <input type="text" class="form-control" id="shift_name" name="shift_name" required>
                    </div>

                    <div class="form-group">
                        <label for="start_time">{{ __('Shift Start Time') }}</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" required>
                    </div>

                    <div class="form-group">
                        <label for="end_time">{{ __('Shift End Time') }}</label>
                        <input type="time" class="form-control" id="end_time" name="end_time" required>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Update Shift') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('button[id^="delete-"]').on('click', function() {
            var shiftId = $(this).attr('id').split('-')[1];
            var url = `/schedule/${shiftId}`;
            var token = '{{ csrf_token() }}';

            if(confirm('Are you sure you want to delete this shift?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            location.reload(); // Reload the page to reflect the changes
                        } else {
                            alert('Something went wrong! Please try again.');
                        }
                    }
                });
            }
        });

        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var start = button.data('start');
            var end = button.data('end');
            var modal = $(this);

            modal.find('.modal-body #shift_name').val(name);
            modal.find('.modal-body #start_time').val(start);
            modal.find('.modal-body #end_time').val(end);

            var actionUrl = '/schedule/' + id;
            $('#editForm').attr('action', actionUrl);
        });
    });
</script>
@endsection
