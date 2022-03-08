<?php

namespace App\Services;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;

class DictionaryService
{
    /**
     *
     * @param string $key
     * @param string $value
     * @param string $locale
     * @throws FileNotFoundException
     */
    public function saveLangFile(string $key, string $value, string $locale) {

        App::setLocale($locale);
        $config = Lang::get('cms');
        $config[$key] = $value;

        $lang_config_file = resource_path() . '/lang/'.$locale.'/cms.php';

        if (File::isFile($lang_config_file)) {
            File::put($lang_config_file,'<?php '.PHP_EOL.PHP_EOL.' return '.var_export($config,true).';');
        } else {
            throw new FileNotFoundException("File does not exist at path {$lang_config_file}.");
        }

    }
}
