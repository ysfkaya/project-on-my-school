<a href = "https://proje-takip.000webhostapp.com/"> DEMO </a>

## CHANGE

<strong>database.php</strong>

```
define("dir",$_SERVER['DOCUMENT_ROOT'].'/proje/');
to
define("dir",$_SERVER['DOCUMENT_ROOT'].'/');


define("URL","http://".$_SERVER["SERVER_NAME"].'/proje');
to
define("URL","http://".$_SERVER["SERVER_NAME"]);
```
