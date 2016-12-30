<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Ой, случилась ошибочка...<? echo $pageTitle ?></title>

    <? require_once "App/views/blocks/metaHeaders.php"; ?>

    <!--custom css-->
    <link rel="stylesheet" href="/resources/css/for_error.css">

</head>
<body>

<div id="block_error">
    <div>
        <h2><? echo $error["error_text"] ?></h2>
        <p>
            It apperrs that Either something went wrong or the page doesn't exist anymore..<br />
            This website is temporarily unable to service your request as it has exceeded it’s resource limit. Please check back shortly.
        </p>
        <p>
            If you are the owner of the account and are regularly seeing this error, please read more about it in our <a href="http://www.namecheap.com/support/knowledgebase/article.aspx/1128/103/what-happens-when-my-account-reaches-lve-limits-diagnosing-and-resolving">knowledgebase</a>.
            If you have any questions, please contact our Technical Support department.
        </p>
    </div>
</div>


<? require_once "App/views/blocks/scripts.php"; ?>
</body>
</html>