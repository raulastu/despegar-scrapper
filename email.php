<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rc
 * Date: 7/31/13
 * Time: 7:12 PM
 * To change this template use File | Settings | File Templates.
 */

function sendEmail($email, $subject){
    $message = $subject;

// In case any of our lines are larger than 70 characters, we should use wordwrap()
    $message = wordwrap($message, 70);

    $headers = "From: Despegar <no-reply@huahcoding.com>\n";
//    $subject = $username.' / '.$email.' has just registered';

    // Send

    $accepted = mail($email, $subject, $message, $headers);
//    $accepted = mail('erreauele@gmail.com', $subject, $message, $headers);
//     echo $accepted;
}
