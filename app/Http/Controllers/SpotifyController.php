<?php

namespace App\Http\Controllers;

use SpotifyWebAPI;
use Illuminate\Http\Request;
use App\Models\Key;

class SpotifyController extends Controller
{
    public function search_songs(){
        $clientId = Key::where('name', 'clientID_noLogin')->first();
        $clientSecret = Key::where('name', 'clientSecret_noLogin')->first();

        $session = new SpotifyWebAPI\Session(
            $clientId->key,
            $clientSecret->key
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

                $html .= "<div class='row song_container'><div class='col-4'><img src='$image' alt='song_thumbnail' class='song_thumbnail'></div><div class='col-8 song_text_container'><div class='song_info'><h5>$name</h5><p>$artist</p></div></div></div>";

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

    public function connect_spotify(){
        $clientId = Key::where('name', 'clientID_noLogin')->first();
        $clientSecret = Key::where('name', 'clientSecret_noLogin')->first();
        $redirectUri = "http://localhost:80/spotify_song_request/public/get_token";

        $session = new SpotifyWebAPI\Session(
            $clientId->key,
            $clientSecret->key,
            $redirectUri
        );

        $options = [
            'scope' => [
                'playlist-modify-private',
                'user-read-private',
            ],
            'auto_refresh' => true,
        ];

        header('Location: ' . $session->getAuthorizeUrl($options));
        die();
    }

    public function get_token(){
        $clientId = Key::where('name', 'clientID_noLogin')->first();
        $clientSecret = Key::where('name', 'clientSecret_noLogin')->first();
        $redirectUri = "http://localhost:80/spotify_song_request/public/get_token";

        $session = new SpotifyWebAPI\Session(
            $clientId->key,
            $clientSecret->key,
            $redirectUri
        );

        // Request a access token using the code from Spotify
        $session->requestAccessToken($_GET['code']);

        $accessToken = $session->getAccessToken();
        $refreshToken = $session->getRefreshToken();

        // Store the access and refresh tokens somewhere. In a database for example.

        $api = new SpotifyWebAPI\SpotifyWebAPI();

        $api->setAccessToken($accessToken);

        $data = $api->me();

        $profile_data = json_decode(json_encode($data), true);

        return view('test')->with("profile_data", $profile_data);
    }
}
