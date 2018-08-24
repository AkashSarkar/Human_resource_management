<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorR extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'errorr';
    protected $fillable = array(
        'source',
        'message',
        'file_name',
        'function_name',
        'line_number',
        'caller_file_name',
        'caller_line_number',
        'memory',
        'seconds',
    );
    public $timestamps = true;

    static public function getSource($source = "back")
    {
        return $source;
    }

    static public function efail(\Exception $e)
    {
        try {
            if (env("APP_ENV") == "local") {
                ob_end_clean();
                $bt = debug_backtrace();
                $caller = array_shift($bt);
                $caller_file_name = $caller['file'];
                $caller_line_number = $caller['line'];
                $caller = array_shift($bt);
                $function_name = $caller['function'];
                $error = new ErrorR();
                $error->source = ErrorR::getSource();
                $error->message = $e->getMessage();
                $error->file_name = basename($e->getFile());
                $error->function_name = $function_name;
                $error->line_number = $e->getLine();
                $error->caller_file_name = basename($caller_file_name);
                $error->caller_line_number = $caller_line_number;
                $error->memory = (memory_get_usage() - _PR_MEM_) / (1024 * 1024);
                $error->seconds = microtime(TRUE) - _PR_TIME_;
                $error->save();
            }
        } catch (\Exception $e) {

        }
    }

    static public function rfail(\Exception $e)
    {
        try {
            if (env("APP_ENV") == "local") {
                ob_end_clean();
                $bt = debug_backtrace();
                $caller = array_shift($bt);
                $caller_file_name = $caller['file'];
                $caller_line_number = $caller['line'];
                $error = new ErrorR();
                $error->source = ErrorR::getSource();
                $error->message = $e->getMessage();
                $error->file_name = preg_replace('/[^A-Za-z0-9\-.]/', '', basename($e->getMessage(), ".php") . PHP_EOL);
                if (request()->route()) {
                    $error->function_name = request()->route()->getActionName();
                } else {
                    $error->function_name = "Laravel protected function";
                }
                $error->line_number = $e->getLine();
                $error->caller_file_name = basename($caller_file_name);
                $error->caller_line_number = $caller_line_number;
                $error->memory = (memory_get_usage() - _PR_MEM_) / (1024 * 1024);
                $error->seconds = microtime(TRUE) - _PR_TIME_;
                $error->save();
            }
        } catch (\Exception $e) {

        }
    }
}
