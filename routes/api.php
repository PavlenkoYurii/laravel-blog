<?php


Route::post('/auth/token', 'Api\AuthController@getAccessToken');
Route::post('/auth/reset-password', 'Api\AuthController@passwordResetRequest');
Route::post('/auth/change-password', 'Api\AuthController@changePassword');

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function() {
    Route::get('/tags', 'ListingController@tags');
    Route::get('/categories', 'ListingController@categories');
    Route::get('/users', 'ListingController@users')->middleware('admin');

    Route::resource('/posts', 'PostController', ['only' => ['index', 'show']]);
});

use Crew\Unsplash\HttpClient;

Route::get('image/{query}', function($query) {
    HttpClient::init([
        'applicationId'	=> '9f40273bc057a79490afdc297cb6ffb7d12e1d6f629126e1439e05718c36e09c',
        'secret'		=> 'eb41175f1489af90ac4cd4a5d22989772ca5b1479640bc936519eb52a4c20f71',
        'callbackUrl'	=> 'https://your-application.com/oauth/callback',
        'utmSource' => 'NAME OF YOUR APPLICATION'
    ]);

    $res = Crew\Unsplash\Search::photos($query)->getResults();

    $images = [];

    foreach ($res as $one) {
        $images[] = $one['urls']['raw'];
    }

    return response($images);
});