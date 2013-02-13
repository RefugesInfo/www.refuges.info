<pre><?php

require_once ('modeles/config.php');
require_once ('modeles/fonctions_bdd.php');
$result=mysql_query("show tables");
while($tables = mysql_fetch_array($result)) 
{
foreach ($tables as $key => $value) 
 {
  mysql_query("ALTER TABLE $value COLLATE utf8_unicode_ci");
 }
}
echo "The collation of your database has been successfully changed!";
?>
</pre>