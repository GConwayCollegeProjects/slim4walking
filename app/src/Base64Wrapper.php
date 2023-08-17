<?php
/**
 * Wrapper class for the Base 64 encoding/decoding library
 *
 * Methods available are:
 *
 * Encode/Decode the given string with base 64 encoding
 *
 * @author CF Ingrams <cfi@dmu.ac.uk>
 *
 * Modifications for the current project
 * @author G Conway <p2613423@my365.dmu.ac.uk>
 *
 * @copyright De Montfort University
 */

namespace Telemetry;

class Base64Wrapper
{
    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    /**
     * Encodes with Base64 to protect data
     *  during communication processes
     *
     * @param $string_to_encode
     * @return string
     */
    public function encode_base64($string_to_encode)
    {
        $encoded_string = false;
        if (!empty($string_to_encode)) {
            $encoded_string = base64_encode($string_to_encode);
        }
        return $encoded_string;
    }

    /**
     * Reverses Base64 encoding to return
     * a string ready for decryption.
     *
     * @param $string_to_decode
     * @return string
     */
    public function decode_base64($string_to_decode)
    {
        $decoded_string = false;
        if (!empty($string_to_decode)) {
            $decoded_string = base64_decode($string_to_decode);
        }
        return $decoded_string;
    }
}
