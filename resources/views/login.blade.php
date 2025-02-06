<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- You can link an external CSS file here if needed -->
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #5c6bc0;
        }

        .user-card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-card h2 {
            font-size: 24px;
            color: #333;
        }

        .user-card h3 {
            font-size: 20px;
            margin-top: 10px;
            color: #555;
        }

        .posts-list {
            list-style-type: none;
            padding-left: 0;
        }

        .posts-list li {
            padding: 10px;
            background-color: #fafafa;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .posts-list li strong {
            color: #3f51b5;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px 15px;
            margin: 0 5px;
            background-color: #3f51b5;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #2c387e;
        }

        .pagination .active {
            background-color: #2c387e;
        }
    </style>
</head>
<body>

<h1>Dashboard</h1>

@foreach ($users as $user)
    <div class="user-card">
        <h2>{{ $user->name }}</h2>

        <h3>Latest Posts:</h3>
        @if ($user->posts->isNotEmpty())
            <ul class="posts-list">
                @foreach ($user->posts as $post)
                    <li>
                        <strong>{{ $post->title }}</strong>: {{ $post->content }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>No posts available.</p>
        @endif
    </div>
@endforeach

{{-- Pagination links --}}
<div class="pagination">
    {{ $users->links() }}
</div>

</body>
</html>
