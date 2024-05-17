@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f5f7fa;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .custom_container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #4469d3b5;
            color: #fff;
            border-bottom: none;
            padding: 15px 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            min-height: 120px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btncustom {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btncustom:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .post {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fff;
        }

        .post:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .post-header {
            margin-bottom: 10px;
        }

        .post-header h5 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        .post-time {
            font-size: 14px;
            color: #999;
        }

        .post-content {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .post-options {
            margin-top: 10px;
        }

        .post-options .btn {
            margin-right: 10px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .post-options .btn:hover {
            transform: translateY(-2px);
        }

        .fa-upload-icon {
            cursor: pointer;
            animation: bounce 1s infinite alternate;
        }

        @keyframes bounce {
            from {
                transform: translateY(-10px);
            }

            to {
                transform: translateY(0px);
            }
        }

        .image-preview-container {
            position: relative;
            margin-top: 20px;
        }

        .image-preview {
            width: 300px;
            height: 400px;
            border: 2px solid #ddd;
            border-radius: 10px;
            object-fit: cover;
            display: none;
        }

        .postBtn {
            padding: 5px 20px;
        }

        .image-preview-container .cancel-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 576px) {
            .card {
                margin: 10px;
            }
        }

        .post {
            display: grid;
            grid-template-columns: 1fr;
            /* Adjust column widths as needed */
            gap: 10px;
            padding: 15px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .post-header {
            display: grid;
            grid-template-columns: auto 1fr;
            /* Adjust column widths as needed */
            align-items: center;
            gap: 10px;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
        }

        .post-time {
            color: #999;
            font-size: 14px;
        }

        .post-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .post-text {
            font-size: 16px;
        }

        .post-image img {
            width: 100%;
            max-height: 300px;
            /* Limit image height */
            border-radius: 10px;
        }

        .post-options {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>

    <div class="container custom_container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Create a Post
                    </div>
                    <div class="card-body">
                        <form method="POST" action="#" enctype="multipart/form-data">
                            <div class="form-group">
                                <textarea name="content" placeholder="What's on your mind?"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="photo" name="photo"
                                            accept="image/*">

                                    </div>
                                </div>
                            </div>
                            <div class="image-preview-container">
                                <img id="imagePreview" class="image-preview offset-md-4" src="" alt="Image Preview">
                                <button type="button" class="cancel-btn" style="  display: none;"
                                    id="cancelImage">&times;</button>
                            </div>
                            <button type="submit" class="btn btncustom postBtn">Post</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Timeline
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body" id="postContainer">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.postBtn').click(function(e) {
                e.preventDefault();

                var content  = $('textarea[name="content"]').val();
                var fileData = $('#photo').prop('files')[0];

                if (!content && !fileData) {
                    Swal.fire({
                        title: 'Error!',
                        text : 'Please fill out the post content or upload a photo.',
                        icon : 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                var formData = new FormData();
                formData.append('content', content);
                formData.append('photo', fileData);
                formData.append('_token', '{{ csrf_token() }}');

                Swal.fire({
                    title: 'Uploading...',
                    text : 'Please wait while your post is being uploaded.',
                    icon : 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url : '{{ url('new-post') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.close();
                        if (response.message === 'Post created successfully') {
                            Swal.fire({
                                title: 'Success!',
                                text : 'Post published successfully',
                                icon : 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text : 'An unexpected error occurred. Please try again.',
                                icon : 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text : 'An error occurred while uploading the post. Please try again.',
                            icon : 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $('#photo').on('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                        $('#cancelImage').show();
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('#cancelImage').on('click', function() {
                $('#imagePreview').attr('src', '').hide();
                $('#photo').val('');
                $(this).hide();
            });

            function fetchPosts() {
        $.ajax({
            url: "{{ url('fetch-posts') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.length > 0) {
                    $('#postContainer').empty();
                    $.each(response, function(index, post) {
                        var timeAgo = moment(post.created_at).fromNow();
                        var currentUserID = "{{ auth()->id() }}";

                        var postCard = `
                            <div class="post">
                                <div class="post-header">
                                    <div class="profile-info">
                                        <h5>User Name</h5>
                                        <span class="post-time">${timeAgo}</span>
                                    </div>
                                </div>
                                <div class="post-content">
                                    ${post.content ? `<div class="post-text">${post.content}</div>` : ''}
                                    ${post.photo ? `<div class="post-image"><img src="${post.photo}" class="img-fluid" alt="Post Image"></div>` : ''}
                                </div>
                                <div class="post-options">
                                    ${post.user_id == currentUserID ? `
                                        <a href="{{ url('edit-post/${post.id}') }}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ url('delete-post/${post.id}') }}" class="btn btn-danger btn-sm">Delete</a>
                                    ` : ''}
                                    <button class="btn btn-sm star-btn" data-post-id="${post.id}" style="background-color: #cbcb1cc4;">
                                        <i class="fa fa-star" aria-hidden="true"></i> ${post.likes_count}
                                    </button>
                                </div>
                            </div>`;
                        $('#postContainer').append(postCard);
                    });
                } else {
                    $('#postContainer').html('<p>No posts published yet.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('There was a problem with the fetch operation:', error);
            }
        });
    }

    fetchPosts();

    $(document).on('click', '.star-btn', function() {
        var postId        = $(this).data('post-id');
        var currentUserId = "{{ auth()->id() }}";
        var csrfToken     = $('meta[name="csrf-token"]').attr('content');

        var requestData = {
            user_id: currentUserId,
            post_id: postId,
            _token: csrfToken
        };

        $.ajax({
            url: "{{ url('like-post') }}",
            type: "POST",
            data: requestData,
            success: function(response) {
                if (response.message) {
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Success',
                    //     text: response.message
                    // });
                }
                fetchPosts();
            },
            error: function(xhr, status, error) {
                console.error('Error occurred while liking the post:', error);
            }
        });
    });

});
    </script>
@endsection
