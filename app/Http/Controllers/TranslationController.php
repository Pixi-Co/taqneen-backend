<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TranslationController extends Controller
{

    private $langs = [
        "ar",
        "en"
    ];

    public function index() { 
        return view('settings.translation');
    }

    public function get() {
        $lang = request()->lang;
        $response = $this->getLangResponse($lang);
        
        return mb_convert_encoding($response, 'UTF-8', 'UTF-8');
    }

    public function getLangPath() { 
        return base_path() . "/resources/lang";  
    }

    public function readLangFiles($lang) { 
        $langPath = $this->getLangPath() . "/$lang"; 
        $files = [];
        
        if ($handle = opendir($langPath)) { 

            while (false !== ($entry = readdir($handle))) {
                Str::contains($entry, ".php")? $files[] = $entry : null; 
            }

            closedir($handle);
        }

        return $files;
    }

    public function getLangFileContent($lang, $filename) {
        $path = $this->getLangPath() . "/$lang/$filename"; 
        $res = file_get_contents($path);

        //return $res;
        $res = include_once($path);

        return $res;
    }

    public function getWordsKeyWithFileName($words, $filename) {
        $arr = [];
        foreach($words as $key => $value) { 
            $arr[$key] = $filename;
        } 

        return $arr;
    }

    public function getLangResponse($lang) {
        $response = [];

        // read all files of lang
        $files = $this->readLangFiles($lang);

        // read file by file
        foreach ($files as $file) {
            // get words from file
            $words = $this->getLangFileContent($lang, $file);

            // set all words in one array
            foreach ($words as $key => $word) {
                $response[$key] = [
                    "value" => is_array($word)? $word : addslashes($word),
                    "filename" => $file,
                ]; 
            }
        }

        return $response;
    }

    public function writeOnLangFile($lang, $filename, $content) {
        try {
            $filePath = $this->getLangPath() . "/$lang/$filename";
            $file = fopen($filePath, "w"); 
            fwrite($file, $content); 
            fclose($file);

            return true;
        } catch (\Exception $th) {
        }   
        return false;
    }

    public function updateTrans($lang, $filename, $key, $value) {
        $words = $this->getLangFileContent($lang, $filename);
        $newFileContent = "<?php return [" . PHP_EOL;
        
        foreach($words as $k => $v) {
            if ($k == $key) {
                // update item of array
                $v = $value;
                $words[$k] = $v;
            }

            $newFileContent .= ' "'.$k.'" => "'.$v.'",' . PHP_EOL;
        }

        $newFileContent .= "];"; 
        return $this->writeOnLangFile($lang, $filename, $newFileContent);
    }

    public function update(Request $request) {
        $words = json_decode($request->words, true);
        $lang = $request->lang;

        foreach ($words as $key => $value) {
            $v = $value['value'];
            $v = str_replace('"', "'", $v);

            $this->updateTrans($lang, $value['filename'], $key, $v);
        }

        $output = [
            'success' => true,
            'msg' => 'done'
        ];

        return $output;
    }



}
