<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Auth;

class StravaController extends Controller
{
  //26162
  //50970d1573958f75aa2b029edc71b73bfb6e5502
  private $api_url = "https://www.strava.com/oauth/authorize";
  private $oauth_url = "https://www.strava.com/oauth/";
  private $revoke_url = 'https://www.strava.com/oauth/deauthorize';
  private $client_id="28187";
  private $client_secret = "79b455bb51c7a1eaee4d252ff63ee9b5afbb8729";
  private $redirect_uri="http://localhost:8000/en/dashboard";
  private $response_type="code";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAuthToken($code)
    {
        $url = $this->oauth_url . '/token';

        //post fields
        $fields = array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'code' => $code
        );

        $parameters = "&" . http_build_query($fields);

        $ch = curl_init();

        curl_setopt_array($ch,array(
           CURLOPT_URL => $url,
           CURLOPT_POST => count($fields),
           CURLOPT_POSTFIELDS => $parameters,
           CURLOPT_RETURNTRANSFER => true
       ));

       $json_response = curl_exec($ch);
       $http_response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

       if ($http_response_code == 401) {
           throw new \Exception('Error: getOAuthToken() - Access has been revoked.');
       }

       curl_close($ch);
       return json_decode($json_response);
    }

    public function getStats(Request $request){
        $id = $request->get('id');
        $access_token = $request->get('access_token');
        $url = 'https://www.strava.com/api/v3/athletes/'.$id.'/stats?access_token='.$access_token ;

        $ch = curl_init();

        curl_setopt_array($ch,array(
           CURLOPT_URL => $url,
           CURLOPT_HTTPHEADER => array('Accept: application/json'),
           CURLOPT_RETURNTRANSFER => true,
       ));

       $json_response = curl_exec($ch);
       $http_response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

       if ($http_response_code == 401) {
           throw new \Exception('Error: getOAuthToken() - Access has been revoked.');
       }

       curl_close($ch);
       return response()->json(["success" => true, "data" => json_decode($json_response)]);
    }

    public function disconnect(Request $request){
        $user = Auth::user();
        //reset strava detail
        $user->strava_id = "";
        $user->strava_access_token = "";
        $user->strava_email = "";
        $user->save();

       return response()->json(["success" => true, "msg" => "your access has been revoke"]);
    }
}
