<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class PageController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function getData(Request $request) {
        $path = File::select('path')->get()->first();
        $pattern = $request->search;
        $books = array();

        $dir = public_path($path->path);
        dump($dir);


        // Открыть известный каталог и начать считывать его содержимое
        // проверка если папка
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    echo "файл: $file : тип: " . filetype($dir . $file);
                    echo '<br>';
                    if ($file == "." || $file == ".." || (is_dir($dh."/".$file))) continue;
                    $books[] = $file;
                }
                closedir($dh);
            }
        }

        for ($i = 0; $i <= count($books); $i++){
            echo 'Hello';
            echo '<br>';
        }

        return view('data',['request' => $request, 'path' => $path]);
    }



}
