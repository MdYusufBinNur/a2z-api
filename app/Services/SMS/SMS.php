<?php


namespace App\Services\SMS;


interface SMS
{
    /**
     * send a text to a numbers
     *
     * @param mixed $toMobileNumber
     * @param string $text
     * @param array $options
     * @return mixed
     */
    public function send($toMobileNumber, string $text, array $options = []);

    /**
     * send a text to a multiple numbers
     * 
     * @param array $toMobileNumbers
     * @param string $text
     * @param array $options
     * @return mixed
     */
    public function bulkSend(array $toMobileNumbers, string $text, array $options = []);
}
