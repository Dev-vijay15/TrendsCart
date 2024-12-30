@extends('backend.layouts.app')
@section('content')
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Add Permission</h3>

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
                            <div class="text-tiny">Permission</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Add Permission</div>
                    </li>
                </ul>
            </div>

            <!-- form-add-product -->
            <form id="permission-form" class="tf-section-2 form-add-product" method="POST">
                @csrf
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Permission Name <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter Permission name" name="name"
                            id="permission-name" tabindex="0" value="">
                        <p id="name-error" class="tf-color-1"></p>
                    </fieldset>
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Add Permission</button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#permission-form').on('submit', function(e) {
                e.preventDefault();

                // Clear any previous validation error message
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
                    text: "You are about to add this permission!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, add it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with AJAX request if confirmation is accepted
                        $.ajax({
                            url: "{{ route('permission.store') }}",
                            method: "POST",
                            data: $('#permission-form').serialize(),
                            success: function(response) {
                                Swal.fire(
                                    'Success!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    window.location.href =
                                        "{{ route('permission.list') }}";
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
