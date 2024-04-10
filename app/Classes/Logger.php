<?php 

namespace App\Classes;

use Illuminate\Support\Facades\Log;

class Logger {

    public function log($level, $message) {
        
        // try to add the message to the active user ID
        if(session()->has('user')) {
            $message = '['.session('user')->user. '] - '.$message;
        } else {
            $message = '[N/A] - '.$message;
        };

        // record an entry in the logs
        Log::channel('main')->$level($message);

    }
}
?>