@extends('backend.layouts.app')
@section('content')

    <style>
        .checkbox-container {
            display: grid;
            grid-template-columns: repeat(4, minmax(150px, 1fr));
            gap: 15px;
            /* Adjust spacing between items */
            margin-top: 20px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 10px;
            /* Space between checkbox and label */
        }

        .permission-checkbox {
            width: 16px;
            /* Size of the checkbox */
            height: 16px;
        }

        .checkbox-item label {
            font-size: 12px;
            /* Font size for the label */
            margin: 0;
            /* Remove default margin */
            color: #333;
            /* Adjust label text color */
        }
    </style>

  
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Edit User</h3>

                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <a href="{{ route('users.list') }}">
                                <div class="text-tiny">User</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Edit User</div>
                        </li>
                    </ul>
                </div>

                <!-- form-edit-User -->
                <form id="User-form" class="tf-section-2 form-add-product" method="POST" action="">
                    @csrf
                    @method('PUT') <!-- Using PUT method for updating -->
                    <div class="wg-box">
                        <fieldset class="name">
                            <div class="body-title mb-10">User Name <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter User name" name="first_name" id="User-name"
                                tabindex="0" value="{{ $user->first_name }}">
                            <p id="name-error" class="tf-color-1"></p>
                        </fieldset>
                        <div class="checkbox-container">
                            @if ($roles->isNotEmpty())
                                @foreach ($roles as $role)
                                    <div class="checkbox-item">
                                        {{-- //{{ $hasRoles->contains($role->id) ? 'checked' : '' }} --}}
                                        <input {{ $hasRoles->contains($role->id) ? 'checked' : '' }}
                                            type="checkbox" class="permission-checkbox " id="role-{{ $role->id }}" name="role[]"
                                            value="{{ $role->name }}">

                                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            @else
                                <p>No Roles available.</p>
                            @endif
                        </div>

                        <div class="cols gap10">
                            <button class="tf-button w-full" type="submit">Update User</button>
                        </div>
                    </div>
                </form>
                <!-- /form-edit-User -->
            </div>
        </div>

    <!-- Include jQuery and SweetAlert -->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#User-form').on('submit', function(e) {
                e.preventDefault();
                $('#name-error').text('');

                // Validate the form before showing the confirmation dialog
                var name = $('#User-name').val();

                if (!name) {
                    $('#name-error').text('First Name name is required.');
                    return; // Stop the process if validation fails
                }

                // Check if the name only contains alphabetic characters and spaces
                var regex = /^[a-zA-Z\s]+$/;
                if (!regex.test(name)) {
                    $('#name-error').text('User name must only contain letters and spaces.');
                    return; // Stop the process if validation fails
                }

                // Check if the name length is at least 3 characters
                if (name.length < 3) {
                    $('#name-error').text('User name must be at least 3 characters long.');
                    return; // Stop the process if validation fails
                }

                // Validate if at least one permission is selected
                // var permissionsChecked = $('input[name="permission[]"]:checked').length;
                // if (permissionsChecked === 0) {
                //     Swal.fire(
                //         'Error!',
                //         'At least one permission must be selected.',
                //         'error'
                //     );
                //     return; // Stop form submission if validation fails
                // }

                // Show confirmation alert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to update this User!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with AJAX request
                        $.ajax({
                            url: "{{ route('users.update', $user->id) }}",
                            method: "POST",
                            data: $('#User-form').serialize(),
                            success: function(response) {
                                Swal.fire(
                                    'Success!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    window.location.href =
                                        "{{ route('users.list') }}";
                                });
                            },
                            error: function(xhr) {
                                if (xhr.status === 422) {
                                    $('#name-error').text(xhr.responseJSON.errors.name[
                                        0]);
                                    Swal.fire(
                                        'Error!',
                                        'Please fix validation errors.',
                                        'error'
                                    );
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Something went wrong. Try again later.',
                                        'error'
                                    );
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
