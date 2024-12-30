@extends('backend.layouts.app')
@section('content')
    <style>
        /* Custom Modal Styling */
        .modal-content {
            border-radius: 15px;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        #usersModal .row {
            font-size: 16px;
            padding: 8px 0;
        }

        .fw-bold {
            font-weight: 600;
        }
    </style>

 

        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>All Users</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="index.html">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">All Users</div>
                        </li>
                    </ul>
                </div>



                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <form class="form-search">
                                <fieldset class="name">
                                    <input type="text" placeholder="Search here..." class="" name="name"
                                        tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <div class="button-submit">
                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <a class="tf-button style-1 w208" href=" {{ route('users.create') }}">
                            <i class="icon-plus"></i>Add new</a>
                    </div>
                    <div class="table-responsive">
                        <table id="usersTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count() > 0)
                                    @foreach ($users as $users)
                                        <tr>
                                            <td>{{ $users->id }}</td>
                                            <td>{{ $users->first_name }} {{ $users->last_name }}</td>
                                            @if ( $users->role==1 )
                                            <td>Super Admin</td>
                                            @elseif ( $users->role==2)
                                            <td>Admin</td>
                                            @else
                                                <td>User</td>
                                            @endif
                                            <td>{{ $users->email }}</td>
                                            <td>{{ $users->mobile }}</td>
                                            <td>{{ \Carbon\Carbon::parse($users->created_at)->format('d M,Y') }}</td>
                                            <td>
                                                <div class="list-icon-function">
                                                    <button type="button" class="show" data-id="{{ $users->id }}">
                                                        <div class="item eye">
                                                            <i class="icon-eye"></i>
                                                        </div>
                                                    </button>
                                                    <a href="{{ route('users.edit', $users->id) }}">
                                                        <div class="item edit">
                                                            <i class="icon-edit-3"></i>
                                                        </div>
                                                    </a>
                                                    <button type="button" class="delete" data-id="{{ $users->id }}">
                                                        <div class="item text-danger">
                                                            <i class="icon-trash-2"></i>
                                                        </div>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>



                    </div>
                    <div>
                        {{-- {!! $users->withQueryString()->links('pagination::bootstrap-5') !!} --}}


                    </div>

                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">


                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Structure -->
        <div class="modal fade" id="usersModal" tabindex="-1" aria-labelledby="usersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content rounded-3 shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white" id="usersModalLabel">users Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">users Name:</div>
                            <div class="col-md-8" id="users-name"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Created At:</div>
                            <div class="col-md-8" id="users-created-at"></div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>





   


@endsection



@push('scripts')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                paging: false, // Disable pagination
                searching: false, // Disable searching
                info: false,
                ordering: true, // Enable column sorting
                responsive: true, // Enable responsive design

            });


        });
    </script>
    <script>
        $(document).ready(function() {
            // Handle delete button click
            $(document).on('click', '.delete', function() {
                var usersId = $(this).data('id'); // Get ID from data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform AJAX request to delete
                        $.ajax({
                            url: "{{ route('users.destroy', ':id') }}".replace(':id',
                                usersId),
                            method: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}" // CSRF Token
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    location
                                        .reload(); // Reload the page or update the DOM
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'Unable to delete. Please try again later.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Show users details in modal
            $(document).on('click', '.show', function() {
                var usersId = $(this).data('id');

                $.ajax({
                    url: "{{ route('users.show', ':id') }}".replace(':id', usersId),
                    method: "GET",
                    success: function(response) {
                        $('#users-name').text(response.name);
                        $('#users-created-at').text(response.created_at);
                        $('#usersModal').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error!', 'Unable to fetch users details.', 'error');
                    }
                });
            });
        });
    </script>
@endpush
