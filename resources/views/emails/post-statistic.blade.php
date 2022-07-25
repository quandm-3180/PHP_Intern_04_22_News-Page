<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('News356') }}</title>
</head>

<body style="display: flex;justify-content: center;">
<div style="width: 70%;padding: 10px; margin: 0 auto">
    <div class="img">
        <img src="http://news365htmllatest.bdtask.com/Demo/DemoNews365/images/logo.png" alt="logo"
            width="50%">
    </div>
    <h1 style="color: rgb(5, 215, 215)">{{ __('Weekly report email') }}</h1>
    @if (count($posts) > 0)
        <p>{{ __('Hello') }}, <b style="color: rgb(240, 84, 84)">{{ $writer->name }}</b></p>
        <p>{{ __('You contributed :number posts in this week', ['number' => count($posts)]) }}</p>

        <table border="1" style="border-collapse: collapse" cellpadding="10px">
            <thead>
                <tr>
                    <th style="background-color: aquamarine"></th>
                    <th style="background-color: aquamarine">{{ __('Title') }}</th>
                    <th style="background-color: aquamarine">{{ __('Author') }}</th>
                    <th style="background-color: aquamarine">{{ __('Status') }}</th>
                    <th style="background-color: aquamarine">{{ __('Created at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a style="text-decoration: none; color: rgb(43, 78, 233)"
                                href="{{ route('client.post-details', [
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
</div>
</body>

</html>
