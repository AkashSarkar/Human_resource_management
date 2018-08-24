<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Performance extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'performance';
    protected $fillable = array(
        'source',

        'full_url',
        'query_number',
        'get',
        'post',

        'function_name',
        'caller_file_name',
        'caller_line_number',
        'memory',
        'seconds',
    );
    public $timestamps = true;

    static function log()
    {
        try {
            if (env("APP_ENV") == "local") {
//            ob_end_clean();
                $bt = debug_backtrace();
                $caller = array_shift($bt);
                $caller_file_name = $caller['file'];
                $caller_line_number = $caller['line'];
                $caller = array_shift($bt);
                $function_name = $caller['function'];
                $performance = new Performance();
                $performance->source = "back";
                $queries = DB::getQueryLog();
                $performance->full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $performance->get = json_encode($_GET);
                $performance->post = json_encode($_POST);
                $performance->query_number = count($queries);


                $performance->function_name = $function_name;
                $performance->caller_file_name = basename($caller_file_name);
                $performance->caller_line_number = $caller_line_number;
                $performance->memory = (memory_get_usage() - _PR_MEM_) / (1024 * 1024);
                $performance->seconds = microtime(TRUE) - _PR_TIME_;
                $performance->save();
            }
        } catch (\Exception $e) {
            ErrorR::efail($e);
        }
    }


}
