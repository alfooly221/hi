<?php
date_default_timezone_set('Asia/Baghdad');
$config = json_decode(file_get_contents('config.json'),1);
$id = $config['id'];
$token = $config['token'];
$config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
$screen = file_get_contents('screen');
exec('kill -9 ' . file_get_contents($screen . 'pid'));
file_put_contents($screen . 'pid', getmypid());
include 'index.php';
$accounts = json_decode(file_get_contents('accounts.json') , 1);
$cookies = $accounts[$screen]['cookies'];
$useragent = $accounts[$screen]['useragent'];
$users = explode("\n", file_get_contents($screen));
$uu = explode(':', $screen) [0];
$se = 100;
$i = 0;
$gmail = 0;
$hotmail = 0;
$yahoo = 0;
$mailru = 0;
$true = 0;
$false = 0;
$NotBussines = 0;
$BlackList = 0;
$NoRest = 0;
$edit = bot('sendMessage',[
    'chat_id'=>$id,
    'text'=>"لقد تم بدأ الفحص بواسطه بوت ماهر ",
    'parse_mode'=>'markdown',
    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>'Checked  : '.$i,'callback_data'=>'fgf']],
                [['text'=>'On User : '.$user,'callback_data'=>'fgdfg']],
				[['text'=>'On Mail : '.$mail,'callback_data'=>'fgdfg']],
                [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                [['text'=>'valid: '.$true,'callback_data'=>'gj'],['text'=>'not valid: '.$false,'callback_data'=>'dghkf']],
                [['text'=>'NotBussines: '.$NotBussines,'callback_data'=>'dgdge'],['text'=>'Bussines: '.$false,'callback_data'=>'dghkf']],
				[['text'=>'BlackList: '.$BlackList,'callback_data'=>'gj'],['text'=>'NoRest: '.$NoRest,'callback_data'=>'dghkf']],
            ]
        ])
]);
$se = 100;
$editAfter = 1;
foreach ($users as $user) {
    $info = getInfo($user, $cookies, $useragent);
    if ($info != false and !is_string($info)) {
        $mail = trim($info['mail']);
        $usern = $info['user'];
        $e = explode('@', $mail);
               if (preg_match('/(hotmail|outlook|yahoo|Yahoo|aol|Aol)\.(com)|(gmail)\.(com)|(mail|bk|yandex|inbox|list)\.(ru)/i', $mail,$m)) {
            echo 'check ' . $mail . PHP_EOL;
                    if(checkMail($mail)){
                        $inInsta = inInsta($mail);
                        if ($inInsta !== false) {
                            // if($config['filter'] <= $follow){
                                echo "True - $user - " . $mail . "\n";
                                if(strpos($mail, 'gmail.com')){
                                    $gmail += 1;
                                } elseif(strpos($mail, 'hotmail.com') or strpos($mail,'outlook.com')){
                                    $hotmail += 1;
                                } elseif(strpos($mail, 'yahoo.com')){
                                    $yahoo += 1;
                                } elseif(preg_match('/(mail|bk|yandex|inbox|list)\.(ru)/i', $mail)){
                                    $mailru += 1;
                                }
                                $follow = $info['f'];
                                $following = $info['ff'];
                                $media = $info['m'];
                                bot('sendMessage', ['disable_web_page_preview' => true, 'chat_id' => $id, 'text' => "⚠️🔰 🅰️ 🅱️ⓄⓉ ⒷⓎ Ⓜ️ⒽⓇ 🔰⚠️
━━━━━━━━━━━━
.†.ⓊⓈⒺⓇ 🕸📮 : [$usern](instagram.com/$usern)\n 
.†.ⒺⓂ️ⒶⒾⓁ 🕸📮 : [$mail]\n 
.†.ⒻⓄⓁⓁⓄⓌⒺⓇⓈ ♻️✅  : $follow\n 
.†.ⒻⓄⓁⓁⓄⓌⒾⓃⒼ ♻️✅ : $following\n 
.†.🅿️🅾️🆂🆃🆂 📛💢 : $media\n
.†.🅷🆄🅾️🆁🆂 : ".date("Y")."/".date("n")."/".date("d")." : " . date('g:i') . "\n" . " 
 
━━━━━━━━━━━━
 ➺ (BY :[ @MHRX1 ☕︎︎ ] ➺ CH :[ @MR_MHR0 ☕︎︎ ]",
                                
                                'parse_mode'=>'markdown']);
                                
                                bot('editMessageReplyMarkup',[
                                    'chat_id'=>$id,
                                    'message_id'=>$edit->result->message_id,
                                    'reply_markup'=>json_encode([
                                        'inline_keyboard'=>[
                                            [['text'=>'Checked  : '.$i,'callback_data'=>'fgf']],
                                            [['text'=>'On User : '.$user,'callback_data'=>'fgdfg']],
				                            [['text'=>'On Mail : '.$mail,'callback_data'=>'fgdfg']],
                                            [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                                            [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                                            [['text'=>'valid: '.$true,'callback_data'=>'gj'],['text'=>'not valid: '.$false,'callback_data'=>'dghkf']],
                                            [['text'=>'NotBussines: '.$NotBussines,'callback_data'=>'dgdge'],['text'=>'Bussines: '.$false,'callback_data'=>'dghkf']],
											[['text'=>'BlackList: '.$BlackList,'callback_data'=>'gj'],['text'=>'NoRest: '.$NoRest,'callback_data'=>'dghkf']],
                                        ]
                                    ])
                                ]);
                                $true += 1;
                            // } else {
                            //     echo "Filter , ".$mail.PHP_EOL;
                            // }
                            
                        } else {
							$NoRest +=1;
                          echo "No Rest $mail\n";
                        }
                    } else {
                        $false +=1;
                        echo "Not Vaild 2 - $mail\n";
                    }
        } else {
			$BlackList +=1;
          echo "BlackList - $mail\n";
        }
    } elseif(is_string($info)){
        bot('sendMessage',[
            'chat_id'=>$id,
            'text'=>"الحساب - `$screen`\n تم حظره من *الفحص*",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                        [['text'=>'نقل اللسته الي حساب اخر 🔄','callback_data'=>'moveList&'.$screen]],
                        [['text'=>'⛔ حذف الحساب','callback_data'=>'del&'.$screen]]
                    ]    
            ]),
            'parse_mode'=>'markdown'
        ]);
        exit;
    } else {
		$NotBussines +=1;
        echo "Not Bussines - $user\n";
    }
    usleep(750000);
    $i++;
    if($i == $editAfter){
        bot('editMessageReplyMarkup',[
            'chat_id'=>$id,
            'message_id'=>$edit->result->message_id,
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>'Checked  : '.$i,'callback_data'=>'fgf']],
                    [['text'=>'On User : '.$user,'callback_data'=>'fgdfg']],
				    [['text'=>'On Mail : '.$mail,'callback_data'=>'fgdfg']],
                    [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                    [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                    [['text'=>'valid: '.$true,'callback_data'=>'gj'],['text'=>'not valid: '.$false,'callback_data'=>'dghkf']],
                    [['text'=>'NotBussines: '.$NotBussines,'callback_data'=>'dgdge'],['text'=>'Bussines: '.$false,'callback_data'=>'dghkf']],
					[['text'=>'BlackList: '.$BlackList,'callback_data'=>'gj'],['text'=>'NoRest: '.$NoRest,'callback_data'=>'dghkf']],
                ]
            ])
        ]);
        $editAfter += 1;
    }
}
bot('sendMessage', ['chat_id' => $id, 'text' =>"انتهى الفحص : ".explode(':',$screen)[0]]);

