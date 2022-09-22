<?php ini_set("default_charset", "UTF-8");

  function encodeForJSON($p) {
    return json_encode($p,
      JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
    );
  }
?>
<!doctype html>
<html>
<body>
<script id="init_data" type="application/json">
<?= encodeForJSON("<script>alert('foo');</script>"); ?>
</script>
<script type="text/javascript">
  var jsonText = document.getElementById('init_data').innerHTML;
  var initData = JSON.parse(jsonText);
  var text = document.createTextNode(initData);
  document.body.appendChild(text);
</script>
</body>
</html>
