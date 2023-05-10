<?php


namespace App\Exceptions;


/**
 * Class NoteNotFoundException
 *
 * @package App\Exceptions
 */
class CustomException extends \Exception
{
    protected $message;
    protected $code;

    /**
     * @param $message
     * @param $code
     */
    public function __construct($message, $code = null)
    {
        $this->message = $message;
        $this->code = $code;
        parent::__construct();
    }

    public function __toString()
    {
        return $this->message;
    }
}
