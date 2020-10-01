<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container">

        <form action="" method="POST">
            <div class="row mt-4">
                <div class="col-8">
                    <div class="form-group">
                        <label for="song_name">Search song:</label>
                        <input type="text" class="form-control" id="song_name" name="song_name">
                    </div>
                </div>
                <div class="col-4">

                </div>
            </div>
        </form>

        <div id="songs"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $("#song_name").keyup(function() {
                let value = $("#song_name").val();
                $.ajax({
                    type: 'POST',
                    url: './get_songs.php',
                    data: {
                        song_name: value,
                    }, success: function (response){
                        console.log(response);
                        $( "#songs" ).html(response);
                    }
                });
            })
        })
    </script>
    </body>
</html>
