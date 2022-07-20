<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('News356') }}</title>
</head>

<body>
    <h1>{{ __('Weekly report email') }}</h1>
    @if (count($posts) > 0)
        <p>{{ __('Hello') }}, <b>{{ $writer->name }}</b></p>
        <p>{{ __('You contributed :number posts in this week', ['number' => count($posts)]) }}</p>

        <table border="1" style="border-collapse: collapse" cellpadding="10px">
            <thead>
                <tr>
                    <th></th>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Author') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Created at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('client.post-details', [
                                'categorySlug' => $post->category->slug,
                                'postSlug' => $post->slug,
                            ]) }}"
                                target="_blank">
                                {{ $post->name }}
                            </a>
                        </td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->status }}</td>
                        <td>{{ $post->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>{{ __('Thank you for your contribution') }}.</p><br>
    @else
        <p>{{ __('You have no post this week') }}</p>
    @endif

    <p>{{ __('From :name', ['name' => config('app.name')]) }}</p>
</body>

</html>
