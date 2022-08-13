<?php

namespace Alexandra\Provider;

class ViewProvider
{
    /**
     * @param $file
     * @param array $parameter
     * @param bool $print
     * @return false|string
     * @throws \Exception
     */
    public function render($file, $parameter = array(), $print = true)
    {
        $fileWithPath = ALEXANDRA_PATH . 'src/resource/view/' . $file;

        if(!file_exists($fileWithPath)) {
            throw new \Exception("File {$file} not found");
        }

        $output = null;

        if($parameter && is_array($parameter)) {
            extract($parameter);
        }

        ob_start();

        require_once($fileWithPath);

        $output = ob_get_clean();

        if($print) {
            echo $output;
        }

        return $output;
    }
}
