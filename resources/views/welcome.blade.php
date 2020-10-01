<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Song request</title>

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

        <div id="songs">
            <?php
//            if (isset($song_array)){
//                echo "<h2>Results</h2>";
//                echo "<div id='results'>";
//
//                $counter = 0;
//                foreach($song_array['tracks']['items'] as $song){
//
//                    $image = $song['album']['images'][1]['url'];
//                    $name = $song['name'];
//                    $artist = $song['artists'][0]['name'];
//
//                    if ($counter % 3 == 0) {
//                        echo <<<RESULTS
//                            <div class="row text-center">
//                        RESULTS;
//                    }
//
//                    echo <<<RESULTS
//                        <div class="col-4">
//                           <div class="card mb-5 mx-3" style="width: 18rem;">
//                              <img class="card-img-top" src="$image" alt="Card image cap">
//                              <div class="card-body">
//                                <h5 class="card-title">$name</h5>
//                                <p class="card-text">$artist</p>
//                              </div>
//                           </div>
//                        </div>
//                    RESULTS;
//
//                    if ($counter % 3 == 2) {
//                        echo "</div>";
//                    }
//
//                    $counter++;
//                }
//            } else {
//                echo <<<RESULTS
//                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
//                        No songs to show
//                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                            <span aria-hidden="true">&times;</span>
//                        </button>
//                    </div>
//                RESULTS;
//            }
//            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $("#song_name").keyup(function() {
                let value = $("#song_name").val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: './get_songs',
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
