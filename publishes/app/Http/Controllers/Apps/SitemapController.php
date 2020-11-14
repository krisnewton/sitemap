<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class SitemapController extends Controller
{
    public $limit = 1000;

    public function skip($index)
    {
    	return ($index - 1) * $this->limit;
    }

    public function index()
    {
    	// Masukkan URL tiap sitemap ke dalam item $data[*]['url']
    	// * Contoh route:
    	// * Route::get('sitemaps.xml', 'Apps\SitemapController@index');

    	$data = [];

    	for ($i = 1; $i <= 30; $i++) {
    		$data[] = [
    			'url' => asset('sitemap-' . $i . '.xml')
    		];
    	}

    	return response()->view('sitemap.index', compact('data'), 200)->header('Content-Type', 'text/xml');
    }

    public function users($index = 1)
    {
    	// Masukkan URL tiap konten ke dalam item $data[*]['url']
    	// Masukkan lastmod tiap konten ke dalam item $data[*]['lastmod']
    	// * Contoh route:
    	// * Route::get('sitemap-users-{index}.xml', 'Apps\SitemapController@users');

    	if ($index > 0) {
    		$skip = $this->skip($index);

    		$users = User::orderBy('id', 'asc')->take($this->limit)->skip($skip)->get();

    		$data = [];
    		foreach ($users as $user) {
    			$data[] = [
    				'url' 		=> route('profile.show', ['user' => $user]),
    				'lastmod' 	=> $user->updated_at->format('Y-m-d')
    			];
    		}

    		return response()->view('sitemap.sitemap', compact('data'), 200)->header('Content-Type', 'text/xml');
    	}
    	else {
    		abort(404);
    	}
    }
}
