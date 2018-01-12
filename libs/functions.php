<?php

	function checkForm($form){
        $get_keys = array_keys($form);
        $return = true;

        foreach ($get_keys as $k) {
            if ($form[$k] == '')
                $return = false;
        }

        return $return;
    }

    function error($text){
        echo '<div class="alert alert-danger">'.$text.'</div>';
    }

    function success($text){
        echo '<div class="alert alert-success">'.$text.'</div>';
    }

    function location($text){
        echo '<script>window.location="'.$text.'";</script>';
    }

    function clean($text){
        return str_replace('&nbsp;', ' ', $text);
    }

    function removeTag($text, $tag){
        return str_replace(array('<' . $tag . '>', '</' . $tag . '>'), array('', ''), $text);
    }

    function getParams($id){
        global $db;

        $permission = '*';

        return @$db->select('params', "id = '$id'", $permission)[0];
    }

    function tagReplacer($text){
        return str_replace(array('<b>', '</b>'), array('<strong>', '</strong>'), $text);
    }

    function user($id){
        global $db;

        $permission = '*';

        return @$db->select('user', "id = '$id'", $permission)[0];
    }

    function xss($data){
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    function getSite($hash){
        global $db;

        $item = $db->select('sites', "hash = '".$hash."'", '*');
        return @$item[0];
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    function future_time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'yıl',
            'm' => 'ay',
            'w' => 'hafta',
            'd' => 'gün',
            'h' => 'saat',
            'i' => 'dakika',
            's' => 'saniye',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . '' : 'az sonra';
    }

    function replaceVariables($input, $array){
        $output = $input;

        if(@$array){
            foreach ($array as $key => $value) {
                $output = preg_replace('/@'.$key.'/', $value.' ', $output);
            }
        }

        return $output;
    }

    function sendEmail($to, $title, $template, $array){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->CharSet = 'UTF-8';
        $mail->IsHTML(true);
        $mail->Username = "support@imagets.com";
        $mail->Password = "1c2c3c4c";
        $mail->SetFrom('support@imagets.com', 'WPTaslak');
        $mail->Subject = replaceVariables($title, $array);
        $mail->Body    = replaceVariables(file_get_contents('views/'.$template), $array);
        $mail->AddAddress($to);
        $mail->Send();
    }