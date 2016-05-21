<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CURRENT_LANGUAGE</title>
    <style>
html, body {
    width: 100%;
    height: 100%;
    padding: 0;
    margin: 0;
}
    </style>
</head>
<body>
<div style="display:table; width: 100%; height: 100%;">
  <div style="display:table-cell;vertical-align:middle; width: 100%">
    <div id="CURRENT-LANGUAGE" style="text-align:center; "><?= file_get_contents("CURRENT_LANGUAGE.txt"); ?></div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/fittext/1.2/jquery.fittext.js"></script>
<script>
  jQuery("#CURRENT-LANGUAGE").fitText();
</script>
</body>
</html>