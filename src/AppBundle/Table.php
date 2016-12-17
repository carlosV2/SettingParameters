<?php

namespace AppBundle;

class Table
{
    public static function init(array $headers)
    {
        echo '<table>';
        echo '<tr><th>' . implode('</th><th>', $headers) . '</th></tr>';
    }

    public static function row(array $data)
    {
        echo '<tr><td>' . implode('</td><td>', $data) . '</td></tr>';
    }

    public static function close()
    {
        echo '</table>';
    }
}
