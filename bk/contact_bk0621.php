<?php
//変数の初期化
$page_flag = 0;

if( !empty($_POST['btn_confirm'])) {
  $page_flag = 1;

} elseif ( !empty($_POST['btn_submit'])) {
  $page_flag = 2;

  // 変数とタイムゾーンを初期化
$header = null;
$auto_reply_subject = null;
$auto_reply_text = null;
date_default_timezone_set('Asia/Tokyo');





//請求者が請求を完了した日時を取得
$time = date('Y-m-d');
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$firstname_furigana = $_POST['firstname_furigana'];
$lastname_furigana = $_POST['lastname_furigana'];
$radio02 = $_POST['radio02'];
$year = $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];
$tel_m = $_POST['tel_m'];
$tel_h = $_POST['tel_h'];
$zip11 = $_POST['zip11'];
$addr11 = $_POST['addr11'];
$address = $_POST['address'];
$selectName1 = $_POST['selectName1'];
$selectName2 = $_POST['selectName2'];
$textarea = $_POST['textarea'];

//文字コード変換
$formdata = array($time, $firstname, $lastname, $firstname_furigana, $lastname_furigana, $year, $month, $day, $radio02, $selectName1, $selectName2, $zip11, $addr11, $address, $tel_m, $tel_h, $textarea);
mb_convert_variables('SJIS-win', 'UTF-8', $formdata);

// メモリバッファを開く
$buf = fopen('information.csv', 'a+');

// データを出力
fputcsv($buf, $formdata);
fclose($buf);






// ヘッダー情報を設定
$header = "MIME-Version: 1.0\n";
$header .= "From: スタートアップクラス <stup@nichinare.co.jp>\n";
///$header .= "Reply-To: スタートアップクラス事務局 <yamasaki@nichinare.co.jp>\n";

// 運営側へ送るメールの件名
$admin_reply_subject = "資料請求を受け付けました";

// 本文を設定
$admin_reply_text = "下記の内容で資料請求がありました。\n\n";
$admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
$admin_reply_text .= "お名前：" . $_POST['firstname'] . $_POST['lastname'] . "\n";
$admin_reply_text .= "フリガナ：" . $_POST['firstname_furigana'] .$_POST['lastname_furigana'] .  "\n";
$admin_reply_text .= "性別：" . $_POST['radio02'] . "\n";
$admin_reply_text .= "生年月日：" . $_POST['year'] ."年". $_POST['month'] ."月". $_POST['day'] ."日". "\n";
$admin_reply_text .= "郵便番号：" . $_POST['zip11'] . "\n";
$admin_reply_text .= "住所：" . $_POST['addr11'] . $_POST['address'] .  "\n";
$admin_reply_text .= "携帯電話番号：" . $_POST['tel_m'] . "\n";
$admin_reply_text .= "固定電話番号：" . $_POST['tel_h'] . "\n";
$admin_reply_text .= "学年：" . $_POST['selectName1'] .$_POST['selectName2'] . "\n";
$admin_reply_text .= "弊所を知ったキッカケ：" . $_POST['textarea'];

// 運営側へメール送信
//mb_send_mail( 'stup@nichinare.co.jp', $admin_reply_subject, $admin_reply_text, $header);
mb_send_mail( 'yamasaki@nichinare.co.jp', $admin_reply_subject, $admin_reply_text, $header);

} else {
  $page_flag = 0;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="日本ナレーション演技研究所（日ナレ）のスタートアップクラス特設サイトからの資料請求フォームです。">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="スタートアップクラス">
    <meta property="og:title" content="お問い合わせ | スタートアップクラス">
    <meta property="og:url" content="https://startupclass.jp">
    <meta property="og:description" content="日本ナレーション演技研究所（日ナレ）のスタートアップクラス特設サイトからの資料請求フォームです。">
    <meta property="og:image" content="https://startupclass.jp/images/thumbnail.jpg">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="お問い合わせ | スタートアップクラス">
    <meta name="twitter:description" content="日本ナレーション演技研究所（日ナレ）のスタートアップクラス特設サイトからの資料請求フォームです。">
    <meta name="twitter:image" content="https://startupclass.jp/images/thumbnail.jpg">
    <title>お問い合わせ | スタートアップクラス</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="apple-touch-icon-precomposed" href="images/icon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/validationEngine.jquery.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js"></script>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <script src="js/jquery.validationEngine.js"></script>
    <script src="js/languages/jquery.validationEngine-ja.js"></script>
    <script src="js/jquery.autoKana.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript">
        if ((navigator.userAgent.indexOf('iPhone') > 0) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
            //iPhone、iPod、Androidの設定
            document.write('<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />');
        }else{
            //それ以外（PC、iPadなど）の設定
            document.write('<meta name="viewport" content="980" />');
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.fn.autoKana('#firstname', '#firstname-furigana', {
                katakana : true  //true：カタカナ、false：ひらがな（デフォルト）
            });
            $.fn.autoKana('#lastname', '#lastname-furigana', {
                katakana : true  //true：カタカナ、false：ひらがな（デフォルト）
            });
        });
    </script>
    <script>
        jQuery(document).ready(function(){
            jQuery("#theForm").validationEngine({
                validateNonVisibleFields: true,
                promptPosition: "topLeft",//エラー文の表示位置
                showArrowOnRadioAndCheckbox: true,//エラー箇所の図示
                focusFirstField: false,//エラー時に一番文頭の入力フィールドにフォーカスさせるかどうか
            });
        });
    </script>
    <script>
        function functionName()
        {
            var select1 = document.forms.formName.selectName1; //変数select1を宣言
            var select2 = document.forms.formName.selectName2; //変数select2を宣言

            select2.options.length = 0; // 選択肢の数がそれぞれに異なる場合、これが重要

            if (select1.options[select1.selectedIndex].value == "--")
            {
                select2.options[0] = new Option("--");
            }

            if (select1.options[select1.selectedIndex].value == "高校生")
            {
                select2.options[0] = new Option("1年生");
                select2.options[1] = new Option("2年生");
                select2.options[2] = new Option("3年生");
                select2.options[3] = new Option("4年生");
                select2.options[4] = new Option("その他");
            }

            else if (select1.options[select1.selectedIndex].value == "大学生")
            {
                select2.options[0] = new Option("1年生");
                select2.options[1] = new Option("2年生");
                select2.options[2] = new Option("3年生");
                select2.options[3] = new Option("4年生");
                select2.options[4] = new Option("その他");
            }

            else if (select1.options[select1.selectedIndex].value == "社会人")
            {
                select2.options[0] = new Option("--");
            }

            else if (select1.options[select1.selectedIndex].value == "その他")
            {
                select2.options[0] = new Option("--");
            }

            else if (select1.options[select1.selectedIndex].value == "中学生")
            {
                select2.options[0] = new Option("1年生");
                select2.options[1] = new Option("2年生");
                select2.options[2] = new Option("3年生");
            }

            else if (select1.options[select1.selectedIndex].value == "専門学校生")
            {
                select2.options[0] = new Option("1年生");
                select2.options[1] = new Option("2年生");
                select2.options[2] = new Option("3年生");
                select2.options[3] = new Option("4年生");
                select2.options[4] = new Option("その他");
            }

            else if (select1.options[select1.selectedIndex].value == "短大生")
            {
                select2.options[0] = new Option("1年生");
                select2.options[1] = new Option("2年生");
                select2.options[2] = new Option("3年生");
                select2.options[3] = new Option("4年生");
                select2.options[4] = new Option("その他");
            }
        }
    </script>
    <script>
        $(function(){
            $(".henkan").blur(function(){
                charChange($(this));
            });


            charChange = function(e){
                var val = e.val();
                var str = val.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){return String.fromCharCode(s.charCodeAt(0)-0xFEE0)});

                if(val.match(/[Ａ-Ｚａ-ｚ０-９]/g)){
                    $(e).val(str);
                }
            }
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="header_inner">
                <div class="arrow"><a href="index.html"><i class="fas fa-chevron-left"></i></a></div>
                <h1 class="text_center">資料請求フォーム</h1>
            </div>
        </header>

        <main class="wall">
            <section class="box_others">

                <?php if( $page_flag === 1):?>
                    <form action="" id="flag1" method="post" class="formArea">
                        <input type="hidden" name="firstname" value="<?php echo $firstname; ?>">
                        <input type="hidden" name="lastname" value="<?php echo $lastname; ?>">
                        <input type="hidden" name="firstname_furigana" value="<?php echo $firstname_furigana; ?>">
                        <input type="hidden" name="lastname_furigana" value="<?php echo $lastname_furigana; ?>">
                        <input type="hidden" name="radio02" value="<?php echo $radio02; ?>">
                        <input type="hidden" name="year" value="<?php echo $year; ?>">
                        <input type="hidden" name="month" value="<?php echo $month; ?>">
                        <input type="hidden" name="day" value="<?php echo $day; ?>">
                        <input type="hidden" name="zip11" value="<?php echo $zip11; ?>">
                        <input type="hidden" name="addr11" value="<?php echo $addr11; ?>">
                        <input type="hidden" name="address" value="<?php echo $address; ?>">
                        <input type="hidden" name="tel_m" value="<?php echo $tel_m; ?>">
                        <input type="hidden" name="tel_h" value="<?php echo $tel_h; ?>">
                        <input type="hidden" name="selectName1" value="<?php echo $selectName1; ?>">
                        <input type="hidden" name="selectName2" value="<?php echo $selectName2; ?>">
                        <input type="hidden" name="textarea" value="<?php echo $textarea; ?>">


                        <div class="form_inner form_confirm">
                            <dl>
                                <dt class="text_bold">お名前<span class="must text_bold">必須</span></dt>
                                <dd>
                                    <p><?php echo $_POST['firstname']; ?>　<?php echo $_POST['lastname']; ?></p>
                                </dd>
                                <dt class="text_bold">フリガナ<span class="must text_bold">必須</span></dt>
                                <dd>
                                    <p><?php echo $_POST['firstname_furigana']; ?>　<?php echo $_POST['lastname_furigana']; ?></p>
                                </dd>
                                <dt class="text_bold">性別<span class="must text_bold">必須</span></dt>
                                <dd>
                                    <p><?php echo $_POST['radio02']; ?></p>
                                </dd>
                                <dt class="text_bold">生年月日<span class="must text_bold">必須</span></dt>
                                <dd>
                                    <p><?php echo $_POST['year']; ?>年<?php echo $_POST['month']; ?>月<?php echo $_POST['day']; ?>日</p>
                                </dd>
                                <dt class="text_bold">郵便番号<span class="must text_bold">必須</span></dt>
                                <dd>
                                    <p><?php echo $_POST['zip11']; ?></p>
                                </dd>
                                <dt class="text_bold">住所<span class="must text_bold">必須</span></dt>
                                <dd>
                                    <p><?php echo $_POST['addr11']; ?><?php echo $_POST['address']; ?></p>
                                </dd>
                                <dt class="text_bold">電話番号<span class="must text_bold">どちらか必須</span></dt>
                                <dd>
                                    <p>携帯電話：<?php echo $_POST['tel_m']; ?><br>固定電話：<?php echo $_POST['tel_h']; ?></p>
                                </dd>
                                <dt class="text_bold">学年<span class="must text_bold">必須</span></dt>
                                <dd>
                                    <p><?php echo $_POST['selectName1']; ?> <?php echo $_POST['selectName2']; ?></p>
                                </dd>
                                <dt class="text_bold">知ったキッカケ</dt>
                                <dd>
                                    <p><?php echo $_POST['textarea']; ?></p>
                                </dd>
                            </dl>
                            <div class="btns h_item">
                                <input type="button" value="内容を修正する" onclick="history.back(-1)" class="btn btn_gray">
                                <input type="submit" value="送信する" class="submitBtn" name="btn_submit">
                                <input type="hidden" name="firstname" value="<?php echo $_POST['firstname']; ?>">
                                <input type="hidden" name="lastname" value="<?php echo $_POST['lastname']; ?>">
                                <input type="hidden" name="firstname_furigana" value="<?php echo $_POST['firstname_furigana']; ?>">
                                <input type="hidden" name="lastname_furigana" value="<?php echo $_POST['lastname_furigana']; ?>">
                                <input type="hidden" name="radio02" value="<?php echo $_POST['radio02']; ?>">
                                <input type="hidden" name="year" value="<?php echo $_POST['year']; ?>">
                                <input type="hidden" name="month" value="<?php echo $_POST['month']; ?>">
                                <input type="hidden" name="day" value="<?php echo $_POST['day']; ?>">
                                <input type="hidden" name="zip11" value="<?php echo $_POST['zip11']; ?>">
                                <input type="hidden" name="addr11" value="<?php echo $_POST['addr11']; ?>">
                                <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
                                <input type="hidden" name="tel_m" value="<?php echo $_POST['tel_m']; ?>">
                                <input type="hidden" name="tel_h" value="<?php echo $_POST['tel_h']; ?>">
                                <input type="hidden" name="selectName1" value="<?php echo $_POST['selectName1']; ?>">
                                <input type="hidden" name="selectName2" value="<?php echo $_POST['selectName2']; ?>">
                                <input type="hidden" name="textarea" value="<?php echo $_POST['textarea']; ?>">
                            </div>
                        </div>
                    </form>

                <?php elseif( $page_flag === 2): ?>

                <div class="textComp h_item">
                    <p>送信が完了しました。</p>
                </div>

                <?php else: ?>

                <form action="#contact" id="theForm" method="post" name="formName" class="formArea">
                    <p class="formText"><i class="fas fa-pen-square"></i><strong>スタートアップクラス専用の資料請求フォーム</strong>です。<br>（株）日本ナレーション演技研究所の<strong>スタートアップクラス以外</strong>の資料請求は<a href="https://nichinare.com/request/form.cgi" target="_blank">こちら<i class="fas fa-external-link-alt"></i></a>からお願いします。</p>
                    <div class="form_inner">
                        <dl>
                            <dt class="text_bold">お名前<span class="must text_bold">必須</span></dt>
                            <dd class="h_item h_itemName">
                                <input type="text" name="firstname" id="firstname" placeholder="姓" class="validate[required] text-input">
                                <input type="text" name="lastname" id="lastname" placeholder="名" class="validate[required] text-input" />
                            </dd>
                            <dt class="text_bold">フリガナ<span class="must text_bold">必須</span></dt>
                            <dd class="h_item h_itemName">
                                <input type="text" name="firstname_furigana" id="firstname-furigana" placeholder="セイ" class="validate[required] text-input" />
                                <input type="text" name="lastname_furigana" id="lastname-furigana" placeholder="メイ" class="validate[required] text-input" />
                            </dd>
                            <dt class="text_bold">性別<span class="must text_bold">必須</span></dt>
                            <dd>
                                <input type="radio" name="radio02" class="radio02-input" id="radio02-01" value="男性" checked>
                                <label for="radio02-01">男性</label>
                                <input type="radio" name="radio02" class="radio02-input" id="radio02-02" value="女性">
                                <label for="radio02-02">女性</label>
                            </dd>
                            <dt class="text_bold">生年月日<span class="must text_bold">必須</span></dt>
                            <dd class="h_item">
                                <select name="year" class="validate[required]">
                                    <option value="">--</option>
                                    <?php foreach(range(2016,1940) as $year): ?>
                                    <option value="<?=$year?>"><?=$year?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p>年</p>
                                <select name="month" class="validate[required]">
                                    <option value="">--</option>
                                    <?php foreach(range(1,12) as $month): ?>
                                    <option value="<?=str_pad($month,2,0,STR_PAD_LEFT)?>"><?=$month?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p>月</p>
                                <select name="day" class="validate[required]">
                                    <option value="">--</option>
                                    <?php foreach(range(1,31) as $day): ?>
                                    <option value="<?=str_pad($day,2,0,STR_PAD_LEFT)?>"><?=$day?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p>日</p>
                            </dd>
                            <dt class="text_bold">
                                郵便番号<span class="must text_bold">必須</span>
                                <p class="red">ハイフン無しでご記入ください。</p>
                            </dt>
                            <dd>
                                <input type="tel" name="zip11" size="10" maxlength="7" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');" placeholder="1234567" class="validate[required,custom[integer],maxSize[7]] text-input" oninput="check_numtype(this)">
                            </dd>
                            <dt class="text_bold">
                                住所<span class="must text_bold">必須</span>
                                <p class="red">番地・建物名・部屋番号まで必ずご記入ください。</p>
                            </dt>
                            <dd class="addInput">
                                <input type="text" name="addr11" size="60" placeholder="東京都渋谷区代々木1-22-1" class="validate[required] text-input henkan">
                                <input type="text" name="address" placeholder="代々木1丁目ビル 12" class="text-input banchi">
                            </dd>
                            <dt class="text_bold">電話番号<span class="must text_bold">どちらか必須</span></dt>
                            <dd>
                                <p>携帯電話</p>
                                <input type="tel" placeholder="080********" name="tel_m" class="validate[groupRequired[payments],,maxSize[11],custom[integer]] text-input" oninput="check_numtype(this)" pattern="\d*" maxlength="11">
                                <p>固定電話</p>
                                <input type="tel" placeholder="03********" name="tel_h" class="validate[groupRequired[payments],maxSize[10],custom[integer]] text-input" oninput="check_numtype(this)" pattern="\d*" maxlength="10">
                            </dd>
                            <dt class="text_bold">学年<span class="must text_bold">必須</span></dt>
                            <dd class="twoSelects">
                                <select name = "selectName1" onChange="functionName()" class="validate[required]" data-promptPosition="inline">
                                    <option value="--">--
                                    <option value="中学生">中学生
                                    <option value = "高校生">高校生
                                    <option value = "短大生">短大生
                                    <option value = "大学生">大学生
                                    <option value="専門学校生">専門学校生
                                    <option value = "社会人">社会人
                                    <option value="その他">その他
                                </select>
                                <select name = "selectName2" class="validate[required]">
                                </select>
                            </dd>
                            <dt class="text_bold">弊所を知ったキッカケ</dt>
                            <textarea name="textarea" id="ta" placeholder="例）
検索サイト（サイト名）で検索して
CM（番組名）を見て
チラシ（店舗名）を見て
雑誌（雑誌名）を見て 等"></textarea>
                        </dl>
                        <div class="theList">
                            <p class="formText"><i class="fas fa-pen-square"></i>資料請求にあたってご提供いただく皆様の個人情報につきましては、入所案内や入所関連情報の送付またはお電話でのご確認のみに使用し、ご本人様の承諾なしに第三者への提供は一切行いません。<br>詳しくは「<a href="privacy_policy.html">個人情報の取り扱いについて</a>」をご覧ください。</p>
                            <p class="formText"><i class="fas fa-pen-square"></i>弊所では、ご提供いただきました個人情報をもとにした「電話」「SNS」による個別の勧誘を一切いたしませんのでご安心ください。<br><span>※ご郵送先など不明な点がある場合のみ、ご連絡させていただくことがあります。</span></p>
                            <p class="formText"><i class="fas fa-pen-square"></i>資料の発送は日本国内のみとさせていただきます。</p>
                        </div>
                        <input type="submit" value="入力内容を確認する" class="text_bold submitBtn" name="btn_confirm">
                    </div>
                </form>

                <?php endif; ?>

            </section>
        </main>

        <footer class="footer">
            <div class="footer_inner">
                <div class="logo">
                    <a href="https://nichinare.com/" target="blank">
                        <img src="images/logo.png" alt="日本ナレーション演技研究所">
                    </a>
                </div>
                <p>TEL：03-3372-5671<br>受付日時：月～日/10:00～19:00</p>
                <p>〒151-0053<br>東京都渋谷区代々木1-22-1　代々木1丁目ビル 12<br>日本ナレーション演技研究所　入所センター</p>
                <small class="text_center">Copyright &copy; 日本ナレーション演技研究所 All Rights Reserved.</small>
            </div>
        </footer>

        <!--固定ボタン-->
        <ul class="fixedBtns h_item">
            <li class="fixedBtns_item">
                <a href="contact.php" class="h_item text_bold h_item">
                    <i class="far fa-file-alt"></i>
                    <span>スタートアップクラス専用<br>資料請求（無料）はこちら</span>
                </a>
            </li>
            <li class="fixedBtns_item">
                <a href="mangalist.html" class="h_item">
                    <i class="fas fa-book-open"></i>
                    <span>まんが<br>「明日を変える」を読む</span>
                </a>
            </li>
        </ul>
        <!--//固定ボタン-->

    </div><!--//.wrapper-->

</body>

</html>
