<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ratings</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        form label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Bookstore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ratings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Insert Rating</h1>

        <!-- Rating Form -->
        <form method="POST" action="{{ route('rate.store') }}" class="row g-3 bg-white p-4 shadow-sm rounded">
            @csrf
            <div class="col-md-6">
                <label for="author" class="form-label">Book Author:</label>
                <select id="author" class="form-select" name="author_id">
                    <option value="">Select an author</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="book" class="form-label">Book Title:</label>
                <select id="book" class="form-select" name="book_id">
                    <option value="">Select a book</option>
                    <!-- Options will be populated dynamically based on selected author -->
                </select>
            </div>
            <div class="col-md-6">
                <label for="rating" class="form-label">Rating:</label>
                <select name="rating" class="form-select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </form>
    </div>

    <!-- jQuery for simplicity -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#author').on('change', function() {
                var authorID = $(this).val();
                if (authorID) {
                    $.ajax({
                        url: '/getBooks/' + authorID,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#book').empty();
                            $('#book').append('<option value="">Select a book</option>');
                            $.each(data, function(key, value) {
                                $('#book').append('<option value="' + value.id + '">' + value.title + '</option>');
                            });
                        }
                    });
                } else {
                    $('#book').empty();
                    $('#book').append('<option value="">Select a book</option>');
                }
            });
        });
    </script>

</body>
</html>
