<?php

namespace App\Http\Controllers;

use SpotifyWebAPI;
use Illuminate\Http\Request;

class SpotifyController extends Controller
{
    public function search_songs(){
        $session = new SpotifyWebAPI\Session(
            "Kan je lekker toch niet zien",
            "Deze mag je ook niet zien hahah"
        );

        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();

        $api = new SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($accessToken);

        $query = $_POST['song_name'];
        $type = "track";

        $songs = $api->search($query, $type);

        $song_array = json_decode(json_encode($songs), true);

        $html = "";

        if (isset($song_array)){
            $html .= "<h2>Results</h2>";
            $html .= "<div id='results'>";

            $counter = 0;
            foreach($song_array['tracks']['items'] as $song){

                $image = $song['album']['images'][1]['url'];
                $name = $song['name'];
                $artist = $song['artists'][0]['name'];

                if ($counter % 3 == 0) {
                    $html .= '<div class="row text-center">';
                }

                $html .= "<div class='col-4'><div class='card mb-5 mx-3' style='width: 18rem;'><img class='card-img-top' src='$image' alt='Card image cap'><div class='card-body'><h5 class='card-title'>$name</h5><p class='card-text'>$artist</p></div></div></div>";

                if ($counter % 3 == 2) {
                    $html .= "</div>";
                }

                $counter++;
            }
        } else {
            $html .= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>No songs to show<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }
        return $html;
    }
}
