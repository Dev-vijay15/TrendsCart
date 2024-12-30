@extends('backend.layouts.app')
@section('content')

        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Permission</h3>

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
                        <a href="{{ route('permission.list') }}">
                            <div class="text-tiny">Permissions</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit Permission</div>
                    </li>
                </ul>
            </div>

            <!-- form-edit-permission -->
            <form id="permission-form" class="tf-section-2 form-add-product" method="POST" action="">
                @csrf
                @method('PUT') <!-- Using PUT method for updating -->
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Permission Name  <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter Permission name"
                            name="name" id="permission-name" tabindex="0" value="{{ $permission->name }}">
                        <p id="name-error" class="tf-color-1"></p>
                    </fieldset>

                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Update Permission</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /main-content-wrap -->
    </div>
    <!-- /main-content-wrap -->



<!-- Include jQuery and SweetAlert -->
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#permission-form').on('submit', function(e) {
            e.preventDefault();
            $('#name-error').text('');

                // Validate the form before showing the confirmation dialog
                var name = $('#permission-name').val();

                if (!name) {
                    $('#name-error').text('Permission name is required.');
                    return; // Stop the process if validation fails
                }

                // Check if the name only contains alphabetic characters and spaces
                var regex = /^[a-zA-Z\s]+$/;
                if (!regex.test(name)) {
                    $('#name-error').text('Permission name must only contain letters and spaces.');
                    return; // Stop the process if validation fails
                }

                // Check if the name length is at least 3 characters
                if (name.length < 3) {
                    $('#name-error').text('Permission name must be at least 3 characters long.');
                    return; // Stop the process if validation fails
                }
            // Show confirmation alert
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update this permission!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with AJAX request
                    $.ajax({
                        url: "{{ route('permission.update', $permission->id) }}",
                        method: "POST",
                        data: $('#permission-form').serialize(),
                        success: function(response) {
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            ).then(() => {
                                window.location.href = "{{ route('permission.list') }}";
                            });
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                $('#name-error').text(xhr.responseJSON.errors.name[0]);
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
