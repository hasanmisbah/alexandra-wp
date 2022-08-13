<?php

namespace Alexandra\Provider;

class ViewProvider
{
    /**
     * @param $file
     * @param array $parameter
     * @return null|string
     * @throws \Exception
     */
    public function render($file, $parameter = array())
    {
        $fileWithPath = ALEXANDRA_PATH . 'src/resource/view/' . $file . '.php';

        if(!file_exists($fileWithPath)) {
            throw new \Exception("File {$file} not found");
        }

        $output = null;

        extract($parameter);

        ob_start();

        require_once($fileWithPath);

        $output = ob_get_clean();

        return $output;
    }
}
