<?php

if (!function_exists('humanize')) {
    /**
     * Humanize.
     *
     * Takes multiple words separated by the separator and changes them to spaces
     *
     * @param string $str       Input string
     * @param string $separator Input separator
     *
     * @return string
     */
    function humanize($str, $separator = '_')
    {
        $pattern = '/[' . preg_quote($separator) . ']+/';
        $subject = trim(extension_loaded('mbstring') ? mb_strtolower($str) : strtolower($str));
        return ucwords(preg_replace($pattern, ' ', $subject));
    }
}

if (!function_exists('json_file_to_array')) {
    /**
     * convert json file to array
     * @param $path
     *
     * @return mixed
     */
    function json_file_to_array($path)
    {
        return json_decode(file_get_contents($path), true);
    }
}

if (!function_exists("get_pagination_meta")) {
    /**
     * @OA\Schema(
     *  title="PaginationMeta",
     *  schema="ResourcePaginable",
     *  @OA\Property(property="current_page", type="number", example="1"),
     *  @OA\Property(property="from", type="number", example="1"),
     *  @OA\Property(property="to", type="number", example="10"),
     *  @OA\Property(property="last_page", type="number", example="3"),
     *  @OA\Property(property="path", type="string", example="http://crm-url/api/v1/<resource>"),
     *  @OA\Property(property="per_page", type="number", example="10"),
     *  @OA\Property(property="total", type="number", example="30"),
     * )
     * @param $object
     *
     * @return array
     */
    function get_pagination_meta($object): array
    {
        return [
            'current_page' => $object->currentPage(),
            'from'         => $object->firstItem(),
            'to'           => $object->lastItem(),
            'last_page'    => $object->lastPage(),
            'path'         => $object->path(),
            'per_page'     => (int) $object->perPage(),
            "total"        => $object->total()
        ];
    }
}

if (!function_exists("get_date_time_format")) {
    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    function get_date_time_format()
    {
        return config('app.date_time_format');
    }
}

if (!function_exists("get_date_time_validation_format")) {
    /**
     * Function gets needed date or date_time format for request fields validation.
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    function get_date_time_validation_format($key = 'date_format')
    {
        $available_keys = config('app.date_time_validation');
        return isset($available_keys[$key]) ? $available_keys[$key] : $available_keys['date_format'];
    }
}

