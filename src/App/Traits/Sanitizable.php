<?php

namespace Alexandra\App\Traits;

trait Sanitizable
{
    protected $sanitizationRules = [];

    /**
     * @param $key string
     * @param $value mixed
     * @return mixed
     * @throws \Exception
     */
    public function sanitizeData($key, $value)
    {
        if(empty($this->sanitizationRules)) {
            return $value;
        }

        if(!isset($this->schema[$key])) {
            throw new \Exception("{$key} is not a valid column");
        }

        if(!isset($this->sanitizationRules[$key])) {
            throw new \Exception("{$key} Sanitization rule is not defined");
        }

        return call_user_func($this->sanitizationRules[$key], $value);
    }

    /**
     * Sanitize All Data
     * @param $data array
     * @return array
     * @throws \Exception
     */
    public function sanitizeAll(array $data)
    {
        $sanitizedData = [];

        foreach ($data as $key => $value) {

            if(!$value) {
                $sanitizedData[$key] = null;
            }

            if(isset($this->schema[$key])) {
                $sanitizedData[$key] = $this->sanitizeData($key, $value);
            }
        }

        return $sanitizedData;
    }
}
