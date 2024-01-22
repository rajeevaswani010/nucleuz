<?php 

namespace App\Logging;
 

class CustomLogProcessor extends PsrLogMessageProcessor
{
    /**
     * @param  array $record
     * @return array
     */
    public function __invoke(LogRecord $logrecord): LogRecord
    {
        parent::__invoke(logrecord);
        
        $info = $this->findFile();
        $record['file_info'] = $info['file'] . ':' . $info['line'];
        return $logrecord->with(record: $record);
    }

    public function findFile() {
      $debug = debug_backtrace();
      return [
        'file' => $debug[3] ? basename($debug[3]['file']) : '',
        'line' => $debug[3] ? $debug[3]['line'] : ''
      ];
    }
}