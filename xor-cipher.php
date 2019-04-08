<?php

function xorMessage(string $message, string $key): string
{
    // extend key lenght if necessry
    while(strlen($message) > strlen($key))
    {
        $key .= $key;
    }

    // xor every letter of the message

    $result = '';

    for ($i = 0; $i < strlen($message); $i++)
    {
        $result .= $message[$i] ^ $key[$i];
    }

    return $result;
}

function crypt64(string $message, string$key): string
{
    return base64_encode(xorMessage($message, $key));
}

function decrypt64(string $message, string $key): string
{
    return xorMessage(base64_decode($message), $key);
}

$key = 'secrectKey';
$originalMessage = 'Hello World!';
$cryptedMessage = crypt64($originalMessage, $key);
$uncryptedMessage = decrypt64($cryptedMessage,$key);

echo 'Key:' . $key . "\n";
echo 'Original Message:' . $originalMessage . "\n";
echo 'Crypted Message:' . $cryptedMessage . "\n";
echo 'Uncrypted Message:' . $uncryptedMessage . "\n";
echo 'Original=Uncrypted?:' . (($originalMessage === $uncryptedMessage) ? 'yes' : 'no') . "\n";

/*
Outputs:
Key:secrectKey
Original Message:Hello World!
Crypted Message:OwAPHgpDIyQXFRdE
Uncrypted Message:Hello World!
Original=Uncrypted?:yes
*/
