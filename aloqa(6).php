<?php
define('API_KEY', '1497006899:AAEeb75zT1w8IaW7dnr-rK-YjIMYwE8AM1s');
$admin = "406823088"; // admin idsi
$channel = "@karonaism";
function del($nomi)
{
array_map('unlink', glob("$nomi"));
}

function put($fayl, $nima)
{
file_put_contents("$fayl", "$nima");
}

function get($fayl)
{
$get = file_get_contents("$fayl");
return $get;
}

function ty($ch)
{
return bot('sendChatAction', [
'chat_id' => $ch,
'action' => 'typing',
]);
}

function editMessageText(
$chatId,
$messageId,
$text,
$parseMode = null,
$disablePreview = false,
$replyMarkup = null,
$inlineMessageId = null
)
{
return bot('editMessageText', [
'chat_id' => $chatId,
'message_id' => $messageId,
'text' => $text,
'inline_message_id' => $inlineMessageId,
'parse_mode' => $parseMode,
'disable_web_page_preview' => $disablePreview,
'reply_markup' => $replyMarkup,
]);
}

function ACL($callbackQueryId, $text = null, $showAlert = false)
{
return bot('answerCallbackQuery', [
'callback_query_id' => $callbackQueryId,
'text' => $text,
'show_alert' => $showAlert,
]);
}

function bot($method, $datas = [])
{
$url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
$res = curl_exec($ch);
if (curl_error($ch)) {
var_dump(curl_error($ch));
} else {
return json_decode($res);
}
return null;
}

function joinchat($result){
     global $message_id;
     global $rasmiy_kanal;
     $ret = bot('getChatMember',[
         'chat_id'=>"-1001324701159",
         'user_id'=>$result,
         ]);
         $stat = $ret->result->status;
     $ret = bot('getChatMember',[
         'chat_id'=>"-1001241187009",
         'user_id'=>$result,
         ]);
         $stats = $ret->result->status;
         if(($stat=="creator" or $stat=="administrator" or $stat=="member") and ($stats=="creator" or $stats=="administrator" or $stats=="member")){
      return true;
         }else{
     bot("sendMessage",[
         "chat_id"=>$result,
         "text"=>" <b>⭕ Botimizda ISM yasashdan oldin kanallarimizni bariga a'zo bo'ling! 
Barchasiga a'zo bo'lib '✅Azo Boʼldim' tugmasini bosing!</b>",
         "parse_mode"=>"html",
         "reply_to_message_id"=>$message_id,
"disable_web_page_preview"=>true,
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"1️⃣ AZO BO'LISH","url"=>"https://t.me/BASSTVHD"],],
[["text"=>"2️⃣ AZO BO'LISH","url"=>"https://t.me/Undamunda"],],
[["text"=>"✅ Azo Boʼldim","callback_data"=>"result"],],
]
]),
]);  
return false;
}
}


$update = json_decode(get('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$uid = $message->from->id;
$cty = $message->chat->type;
$mid = $message->message_id;
$name = $message->chat->first_name;
$user = $message->from->username;
$tx = $message->text;

$data = $update->callback_query->data;
$chat_id = $update->callback_query->message->chat->id;
$id = $update->callback_query->id;
$from_id = $update->callback_query->from->id;
$firstname = $message->from->first_name;
$first_name = $update->callback_query->from->first_name;
$message_id = $update->callback_query->message->message_id;

$step = get("poster/$cid.stp");
$sreply = $message->reply_to_message->text;
$ent = $message->entities[0]->type;
mkdir("mega");

$stepp = file_get_contents("ariza/$cid.step");
mkdir("ariza");

if ($cty == 'group' || $cty == 'supergroup') {
$guruhlar = ['-1001350453298','-1001382402303','-1001207382634','-1001372796878'];
if (!in_array($cid, $guruhlar)){
bot('leaveChat', [
'chat_id' => $cid
]);
}
}

$lichka = file_get_contents("lichka.baza");
if($cty=="private"){
if(strpos($lichka,"$cid") !==false){
}else{
file_put_contents("lichka.baza","$lichka\n$cid");
}
} 

if($tx == '/code' and $cid == $admin){
bot('sendDocument',[
'chat_id'=>$cid,
'document'=>new CURLFile(__FILE__),
'caption'=>"[@Nikmegarobot] *code*",
'parse_mode'=>"markdown",
'reply_to_message_id'=>$mid,
]);
}

if($tx == "♻️Oddiy Xabar" && $cid == $admin){
file_put_contents("ariza/$cid.step","bc");
 bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>"Xabar matnini kiriting:",
    'parse_mode'=>'html',
  ]);
}

if($stepp == "bc" and $cid == $admin){
 $all_member = fopen("lichka.baza","r");
  while( !feof($all_member)){
    $user = fgets($all_member);
bot ('SendMessage', [
'chat_id'=> $user,
'text'=>$tx,
'parse_mode'=>"markdown",
]);
unlink("ariza/$cid.step");
  }
}

$new_chat_members = $message->new_chat_member->id;
$lan = $message->new_chat_member->language_code;
$ism = $message->new_chat_member->first_name;
$username = $message->from->username;
$first_name = $message->from->first_name;
$is_bot = $message->new_chat_member->is_bot;

    if (($new_chat_members != NUll)&&($is_bot!=true)) {
  if((stripos($lan,"fa")!== false) or (stripos($lan,"ar")!==false)){
      $vaqti = strtotime("+999999999999 minutes");
  bot('kickChatMember', [
      'chat_id' => $cid,
      'user_id' => $new_chat_members,
      'until_date'=> $vaqti,
    ]);
    }else{
      $test = "<b>👋Salom</b> <a href='tg://user?id=$new_chat_members'>$ism</a>

Hush kelibsiz 😊
Agarda gruppada hatolik yoki  biror nojoyi ish qilsez man bilan yuzlashasiz

☘️ @karonaism – <b>Adminlar jamoasi</b>";
       bot('sendmessage',[
       'chat_id'=>$cid,
       'text'=>$test,
       'parse_mode'=>'html'
     ]);
   }
    }

$soz = "🤖 Botdan foydalanganingiz uchun rahmat 👍😉

👨‍👩‍👧‍👦 Yaqinlaringiz va doʻstlaringizni ham ismlarini yozib ularga sovgʻa qilmoqchimsiz...😃

➖➖➖➖➖

❗️Unday boʻlsa botimiz ssilkasini kamida 5 ta doʻstingizga yuboring, va botimizdan cheksiz foydalaning 🤩🥳";

$key = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"1⃣"],['text'=>"2️⃣"],['text'=>"3️⃣"],['text'=>"4️⃣"],['text'=>"5️⃣"]],
[['text'=>"6️⃣"],['text'=>"7️⃣"],['text'=>"8️⃣"],['text'=>"9️⃣"],['text'=>"1⃣0⃣"]],
[['text'=>"1️⃣1️⃣"],['text'=>"1️⃣2️⃣"],['text'=>"1️⃣3️⃣"],['text'=>"1️⃣4️⃣"],['text'=>"1⃣5️⃣"]],
[['text'=>"1️⃣6️⃣"],['text'=>"1️⃣7️⃣"],['text'=>"1️⃣8️⃣"],['text'=>"1️⃣9️⃣"],['text'=>"2⃣0⃣"]],
]
]);

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"Statistika"],['text'=>"/code"],],
]
]);

$tugma = json_encode([
'inline_keyboard'=>[
[["text"=>"♻️Tarqatish","url"=> "http://telegram.me/share/url?url=%E2%9A%A0%EF%B8%8F+Biz+koronavirusga+qarshimiz+%F0%9F%A6%A0%0D%0A%0D%0Ahttps%3A%2F%2Ft.me%2Fismzakazrobot%0D%0A%0D%0A%F0%9F%91%86Ushbu+bot+orqali+o%27z+ismingizni+%23challange+rasmlarga+yozib+oling+%F0%9F%98%89"],],
[['text'=>"Boshqa Yasash",'callback_data'=>"otmen"]],
]
]);

$soz1 = "*Endi so'z yozing faqat lotin alifbosida*

(📑_Eslatma: So'zni behato yozing siz yozayotgan soʼz rasmga yoziladi_)";

if ($tx == "1⃣" or $tx == "1"){
file_put_contents("ariza/$cid.step","1"); 
bot ('SendMessage', [ 
'chat_id'=>$cid,
'text'=>$soz1,
'parse_mode' => "markdown",
]);
}

if ($stepp == "1"){
unlink("ariza/$cid.step");
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>"*Tayyorlanmoqda biroz kuting...* ",
'parse_mode' => "markdown",
]);
bot('SendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://nabiyev13.000webhostapp.com/EPhoto360/writeText?output=image&effect=https://en.ephoto360.com/cake-text-357.html&text=$tx",
'caption'=>"1️⃣ raqamli Logo Tayyor",
'parse_mode' => "markdown",
'disable_web_page_preview' => true,
]);
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>$soz,
'parse_mode' => "markdown",
"reply_markup"=>$tugma,
]);
}

if ($tx == "2️⃣" or $tx == "2"){
file_put_contents("ariza/$cid.step","2"); 
bot ('SendMessage', [ 
'chat_id'=>$cid,
'text'=>$soz1,
'parse_mode' => "markdown",
]);
}

if ($stepp == "2"){
unlink("ariza/$cid.step");
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>"*Tayyorlanmoqda biroz kuting...* ",
'parse_mode' => "markdown",
]);
bot('SendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://nabiyev13.000webhostapp.com/EPhoto360/writeText?output=image&effect=https://en.ephoto360.com/cake-text-158.html&text=$tx",
'caption'=>"2️⃣ raqamli Logo Tayyor",
'parse_mode' => "markdown",
'disable_web_page_preview' => true,
]);
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>$soz,
'parse_mode' => "markdown",
"reply_markup"=>$tugma,
]);
}

if ($tx == "3️⃣" or $tx == "3"){
file_put_contents("ariza/$cid.step","3"); 
bot ('SendMessage', [ 
'chat_id'=>$cid,
'text'=>$soz1,
'parse_mode' => "markdown",
]);
}

if ($stepp == "3"){
unlink("ariza/$cid.step");
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>"*Tayyorlanmoqda biroz kuting...* ",
'parse_mode' => "markdown",
]);
bot('SendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://nabiyev13.000webhostapp.com/EPhoto360/writeText?output=image&effect=https://en.ephoto360.com/cake-text-96.html&text=$tx",
'caption'=>"3️⃣ raqamli Logo Tayyor",
'parse_mode' => "markdown",
'disable_web_page_preview' => true,
]);
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>$soz,
'parse_mode' => "markdown",
"reply_markup"=>$tugma,
]);
}

if ($tx == "4️⃣" or $tx == "4"){
file_put_contents("ariza/$cid.step","4"); 
bot ('SendMessage', [ 
'chat_id'=>$cid,
'text'=>$soz1,
'parse_mode' => "markdown",
]);
}

if ($stepp == "4"){
unlink("ariza/$cid.step");
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>"*Tayyorlanmoqda biroz kuting...* ",
'parse_mode' => "markdown",
]);
bot('SendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://nabiyev13.000webhostapp.com/EPhoto360/writeText?output=image&effect=https://en.ephoto360.com/cake-text-194.html&text=$tx",
'caption'=>"4️⃣ raqamli Logo Tayyor",
'parse_mode' => "markdown",
'disable_web_page_preview' => true,
]);
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>$soz,
'parse_mode' => "markdown",
"reply_markup"=>$tugma,
]);
}

if ($tx == "5️⃣" or $tx == "5"){
file_put_contents("ariza/$cid.step","5"); 
bot ('SendMessage', [ 
'chat_id'=>$cid,
'text'=>$soz1,
'parse_mode' => "markdown",
]);
}

if ($stepp == "5"){
unlink("ariza/$cid.step");
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>"*Tayyorlanmoqda biroz kuting...* ",
'parse_mode' => "markdown",
]);
bot('SendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://nabiyev13.000webhostapp.com/EPhoto360/writeText?output=image&effect=https://en.ephoto360.com/cake-text-429.html&text=$tx",
'caption'=>"5️⃣ raqamli Logo Tayyor",
'parse_mode' => "markdown",
'disable_web_page_preview' => true,
]);
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>$soz,
'parse_mode' => "markdown",
"reply_markup"=>$tugma,
]);
}

if ($tx == "6️⃣" or $tx == "6"){
file_put_contents("ariza/$cid.step","6"); 
bot ('SendMessage', [ 
'chat_id'=>$cid,
'text'=>$soz1,
'parse_mode' => "markdown",
]);
}

if ($stepp == "6"){
unlink("ariza/$cid.step");
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>"*Tayyorlanmoqda biroz kuting...* ",
'parse_mode' => "markdown",
]);
bot('SendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://nabiyev13.000webhostapp.com/EPhoto360/writeText?output=image&effect=https://en.ephoto360.com/cake-text-104.html&text=$tx",
'caption'=>"6️⃣ raqamli Logo Tayyor",
'parse_mode' => "markdown",
'disable_web_page_preview' => true,
]);
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>$soz,
'parse_mode' => "markdown",
"reply_markup"=>$tugma,
]);
}

if ($tx == "7️⃣" or $tx == "7"){
file_put_contents("ariza/$cid.step","7"); 
bot ('SendMessage', [ 
'chat_id'=>$cid,
'text'=>$soz1,
'parse_mode' => "markdown",
]);
}

if ($stepp == "7"){
unlink("ariza/$cid.step");
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>"*Tayyorlanmoqda biroz kuting...* ",
'parse_mode' => "markdown",
]);
bot('SendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://nabiyev13.000webhostapp.com/EPhoto360/writeText?output=image&effect=https://en.ephoto360.com/cake-text-97.html&text=$tx",
'caption'=>"7️⃣ raqamli Logo Tayyor",
'parse_mode' => "markdown",
'disable_web_page_preview' => true,
]);
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>$soz,
'parse_mode' => "markdown",
"reply_markup"=>$tugma,
]);
}

if($tx == '/admin' and $cid == $admin){
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>"*Admin paneli*", 
'reply_markup'=>$panel,
'parse_mode'=>"markdown",
]);
}

if($tx=="Statistika" and $cid == $admin){
$soat = date('H:i', strtotime('2 hour'));
$sana = date('d-M Y',strtotime('2 hour'));
$lich = substr_count($lichka,"\n");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"📊<b>Botimiz a'zolari:</b> $lich ta

$sana $soat",
'parse_mode'=>'html',
]);
}

if($data=="result"){
if(joinchat($chat_id)=="true"){
bot("deleteMessage",[
"chat_id"=>$chat_id,
"message_id"=>$message_id,
]);
bot("answerCallbackQuery",[
"callback_query_id"=>$id,
"text"=>"Tabriklaymiz! Siz kanallarga obuna boʻldingiz!",
"show_alert"=>true,
]);
file_put_contents("ariza/$chat_id.step","limit");
bot("sendMessage",[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"*Logo raqamini tanlang👇* ",
'parse_mode' => "markdown",
'reply_markup'=>$key,
]);
}else{
bot("answerCallbackQuery",[
"callback_query_id"=>$id,
"text"=>"Siz hali to'liq obuna boʻlmadingiz!",
"show_alert"=>true,
]);
}
}

if ($data == "otmen"){
if(joinchat($from_id)=="true"){
file_put_contents("ariza/$chat_id.step","limit"); 
bot ('deleteMessage', [
'chat_id'=> $chat_id,
'message_id'=> $message_id,
]);
bot ('SendMessage', [
'chat_id'=> $chat_id,
'text'=>"*Logo raqamini tanlang👇* ",
'parse_mode' => "markdown",
'reply_markup'=>$key,
]);
}
}

if ($tx == "/start"){
if ($cty == "private") {
if(joinchat($uid)=="true"){
file_put_contents("ariza/$cid.step","limitt"); 
bot ('SendMessage', [ 
'chat_id'=> $cid,
'text'=>"*Logo raqamini tanlang👇* ",
'parse_mode' => "markdown",
'reply_markup'=>$key,
]);
}
}
}
