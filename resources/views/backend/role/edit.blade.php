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
                    <h3>Edit Role</h3>

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
                            <a href="{{ route('role.list') }}">
                                <div class="text-tiny">Role</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Edit Role</div>
                        </li>
                    </ul>
                </div>

                <!-- form-edit-role -->
                <form id="role-form" class="tf-section-2 form-add-product" method="POST" action="">
                    @csrf
                    @method('PUT') <!-- Using PUT method for updating -->
                    <div class="wg-box">
                        <fieldset class="name">
                            <div class="body-title mb-10">Role Name <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter Role name" name="name" id="role-name"
                                tabindex="0" value="{{ $role->name }}">
                            <p id="name-error" class="tf-color-1"></p>
                        </fieldset>
                        <div class="checkbox-container">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <div class="checkbox-item">
                                        <input {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }}
                                            type="checkbox" class="permission-checkbox " name="permission[]"
                                            value="{{ $permission->name }}">

                                        <label for="">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            @else
                                <p>No permissions available.</p>
                            @endif
                        </div>

                        <div class="cols gap10">
                            <button class="tf-button w-full" type="submit">Update Role</button>
                        </div>
                    </div>
                </form>
                <!-- /form-edit-Role -->
            </div>
        </div>

    <!-- Include jQuery and SweetAlert -->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#role-form').on('submit', function(e) {
                e.preventDefault();
                $('#name-error').text('');

                // Validate the form before showing the confirmation dialog
                var name = $('#role-name').val();

                if (!name) {
                    $('#name-error').text('Role name is required.');
                    return; // Stop the process if validation fails
                }

                // Check if the name only contains alphabetic characters and spaces
                var regex = /^[a-zA-Z\s]+$/;
                if (!regex.test(name)) {
                    $('#name-error').text('Role name must only contain letters and spaces.');
                    return; // Stop the process if validation fails
                }

                // Check if the name length is at least 3 characters
                if (name.length < 3) {
                    $('#name-error').text('Role name must be at least 3 characters long.');
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
                    text: "You are about to update this role!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with AJAX request
                        $.ajax({
                            url: "{{ route('role.update', $role->id) }}",
                            method: "POST",
                            data: $('#role-form').serialize(),
                            success: function(response) {
                                Swal.fire(
                                    'Success!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    window.location.href =
                                        "{{ route('role.list') }}";
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
