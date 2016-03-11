<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1280, user-scalable=no">

    <link rel="stylesheet" href="css/vendor/vegas.css">
    <link rel="stylesheet" href="css/vendor/ticker.css">
    <link rel="stylesheet" href="css/player.css">
</head>
<body>
    
    <input type="hidden" name="client_id" id="client_id" class="form-control" value="{{ $client }}">
    <input type="hidden" name="updated_at" id="updated_at" class="form-control" value="{{ $updated_at }}">
    
    @if( count($screens) > 0)
        <ul id="screens" style="display: none;">
            @foreach ($screens as $element)
                <li src="{{ $element['image'] }}"></li>
            @endforeach
        </ul>
    @endif
    
    @include('player.ticker')

    <script src="/js/vendor/jquery-2.1.3.min.js"></script>
    <script src="/js/vendor/vegas.min.js"></script>
    <script src="/js/vendor/ticker.js"></script>
    <script src="/js/player.js"></script>
</body>
</html>