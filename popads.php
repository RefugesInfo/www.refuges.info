<!--<?php

/* Bibliothèque de récupération de codes publicitaires simples PopAds, deuxième révision + correctif 2017-03
 * Compatible avec PHP4-8
 *
 * Utilisation :
 * dans votre modèle, entre <head> et </head>, insérez :
 * <?php include('<chemin-vers-ce-fichier>/popads.php'); ?>
 *
 * Attention : cela ne fonctionnera pas avec les systèmes de modèles comme Smarty ! Pour le faire fonctionner :
 * - supprimer <!-- du début et $pa_orep = error_reporting(0); phrase
 * - supprime tout à partir du commentaire /* 8<---- à la fin
 * - change var $verbose = true ; à var $verbose = false;
 * - inclure ce fichier, créer un nouvel objet PopAdsAdcode() et obtenir le code publicitaire via la méthode read(), puis le lier au modèle
 * N'utilisez pas les méthodes get_* directement sans mise en cache de votre côté.
 *
 */

$pa_orep = erreur_reporting(0);

classe PopAdsAdcode {

	/* Identique à celui du générateur de code */
	var $minBid = 0;
	var $popundersPerIP = '0';
	var $delayBetween = 0;
	var $defaultPerDay = 0;
	var $topmostLayer = 'auto';
    var $blockedCountries = null;
	/* URL ou Javascript codé en Base64 */
	var $default = false;
	/* Vos paramètres attribués individuellement */
	var $key = 'c2c7470ae19ee770a2d53045f83b49d77bb1e698';
	var $siteId = 5033718;
	/* Il est préférable de laisser ce qui suit tel quel, vraiment */
	var $antiAdblock = 1;
	var $obfuscate = 1;

	/* Défini sur vrai, si votre serveur prend correctement en charge SSL (OpenSSL ou équivalent installé et résolution IPv6 désactivée -
	   il est connu que cela peut causer des problèmes lors de la tentative de résolution de notre domaine sur certaines configurations) */
	var $ssl = faux;
	/* Définir sur false pour supprimer la sortie des informations de débogage */
	var $verbose = true;
	/* Définir pour remplacer le répertoire de cache des codes publicitaires */
	var $adcodeDir = false;
	
	/* Paramètres avancés */
	
	/* Délai d'expiration de la connexion cURL (secondes) */
	var $curlTimeout = 5;
	var $curlConnectTimeout = 2;
	/* TRUE pour détecter automatiquement cURL, définir sur FALSE pour activer les méthodes de secours et ignorer la vérification de cURL (il vaut mieux laisser tel quel) */
	var $curlInstalled = true;
	
	/* Délai d'expiration du FGC (secondes) */
	var $fgcTimeout = 5;
	/* TRUE pour détecter automatiquement le FGC, définir sur FALSE pour activer les méthodes de secours et ignorer la vérification du FGC (il est préférable de laisser tel quel) */
	var $fgcInstalled = vrai;
	
	/* fsockopen/stream_* délais d'attente (secondes) */
	var $fsockTimeout = 5;
	var $fsockConnectTimeout = 2;
	/* TRUE pour détecter automatiquement fsockopen/stream_*, définir sur FALSE pour activer les méthodes de secours et ignorer la vérification (il vaut mieux laisser tel quel) */
	var $fsockInstalled = vrai;
	
	/* socket_* timeout (secondes) */
	var $sockTimeout = 5;
	/* TRUE pour détecter automatiquement socket_*, définir sur FALSE pour activer les méthodes de secours et ignorer la vérification socket_* (il est préférable de laisser tel quel) */
	var $sockInstalled = vrai;

	fonction getCurl($url) {
		/* Capacités de test */
		si ((!extension_loaded('curl')) || (!function_exists('curl_version'))) {
			$this->curlInstalled = false; /* définir sur FALSE pour activer les méthodes de secours */
			renvoie faux ; /* cURL n'existe pas */
		}
		/* Initialiser l'objet */
		curl_setopt_array($curl = curl_init(), tableau(
			CURLOPT_RETURNTRANSFER => 1,			
			CURLOPT_USERAGENT => 'PopAds CGAPIL2 A',
			CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,	
			CURLOPT_FOLLOWLOCATION => faux,
			CURLOPT_FAILONERROR => vrai,
			CURLOPT_SSL_VERIFYPEER => vrai,			
			CURLOPT_HEADER => faux,
			CURLOPT_HTTPHEADER => array('Accepter : text/plain,application/json ; q=0.9'),
			CURLOPT_TIMEOUT => $this->curlTimeout,	
			CURLOPT_CONNECTTIMEOUT => $this->curlConnectTimeout
		));
		/* Capacités de test pour HTTPS */
		si ($this->ssl && (($version = curl_version()) && ($version['features'] & CURL_VERSION_SSL))) {
			curl_setopt($curl, CURLOPT_URL, 'https://www.popads.net' . $url);
			si (($code = curl_exec($curl)) && (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200)) {
				curl_close($curl);
				retourner $code;
			}
		}
		/* Procéder via HTTP */
		curl_setopt($curl, CURLOPT_URL, 'http://www.popads.net' . $url);
		$code = curl_exec($curl);
		si (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200)
			$code = faux;
		curl_close($curl);
		retourner $code; /* Faux en cas d'échec */
	}

	/* Non recommandé ; n'envoie pas d'en-tête Accept, aucun contrôle sur la vérification des homologues SSL, peut essayer de résoudre IPV6 */
	fonction getFgc($url) {
		/* Capacités de test */
		si ( (!function_exists('file_get_contents')) || (!ini_get('allow_url_fopen')) || ((function_exists('stream_get_wrappers')) && (!in_array('http', stream_get_wrappers()))) ) {
			$this->fgcInstalled = false;
			renvoie false; /* file_get_contents n'existe pas ou ne prend pas du tout en charge la récupération d'URL */
		}
		$headers = tableau(
			"Accepter : texte/plain, application/json ; q = 0,9 ",
			Agent utilisateur : PopAds CGAPIL2 B
		);
		$options = tableau(
			'http' => tableau(
				'timeout' => $this->fgcTimeout,
				'header' => (!defined('PHP_VERSION_ID') || (constant('PHP_VERSION_ID') < 50210)) ? join("\r\n", $headers) : $headers,
			)
		);
		si (constante('PHP_VERSION_ID') > 50304)
			$options['http']['follow_location'] = 0;
		sinon si (constant('PHP_VERSION_ID') > 50100)
			$options['http']['max_redirects'] = 1;
		$context = stream_context_create($options);
		/* Capacités de test pour HTTPS (PHP5+) */
		si ($this->ssl && ((!function_exists('stream_get_wrappers')) || (in_array('https', stream_get_wrappers())))) {
			$code = file_get_contents('https://www.popads.net' . $url, false, $context);
			si ($code)
				retourner $code;
		}
		/* Procéder via HTTP */
		return file_get_contents('http://www.popads.net' . $url, false, $context); /* False en cas d'échec */
	}

	/* Non recommandé ; aucun contrôle sur la vérification des homologues SSL, peut essayer de résoudre IPV6 si vous utilisez HTTPS */
	fonction getFsock($url) {
		si ((function_exists('stream_get_wrappers')) && (!in_array('http', stream_get_wrappers()))) { /* Peu probable */
			$this->fsockInstalled = false;
			renvoie faux ;
		}
		$enum = $estr = $in = $out = '';
		/* Capacités de test */
		si ($this->ssl && ((!function_exists('stream_get_wrappers')) || (in_array('https', stream_get_wrappers())))) {
			$fp = fsockopen('ssl://' . 'www.popads.net', 443, $enum, $estr, $this->fsockConnectTimeout);
		}
		/* Initialiser la connexion simple */
		si ((!$fp) && (!($fp = fsockopen('tcp://' . gethostbyname('www.popads.net'), 80, $enum, $estr, $this->fsockConnectTimeout))))
			renvoie faux ;
		stream_set_timeout($fp, $this->fsockTimeout);
		$out .= "GET " . $url . " HTTP/1.1\r\n";
		$out .= "Hôte : www.popads.net\r\n";
		$out .= "User-Agent: PopAds CGAPIL2 C\r\n";
		$out .= "Accepter : text/plain,application/json ;q=0.9\r\n";
		$out .= "Connexion : fermer\r\n\r\n";
		fwrite($fp, $out);
		tandis que (!feof($fp)) {
			$in .= fgets($fp, 1024);
		}
		fclose($fp);
		retourner substr($in, strpos($in, "\r\n\r\n") + 4);
	}

	/* Non recommandé ; aucun support SSL du tout */
	fonction getSock($url) {
		si (!function_exists('socket_create')) {
			$this->sockInstalled = false;
			renvoie faux ;
		}
		$in = $out = '';
		/* HTTP uniquement, dernier recours */
		si (!($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)))
			renvoie faux ;
		socket_set_block($chaussette);
		socket_set_option($sock, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $this->sockTimeout, 'usec' => 0));
		si (!socket_connect($sock, gethostbyname('www.popads.net'), 80))
			renvoie faux ;
		$out .= "GET " . $url . " HTTP/1.1\r\n";
		$out .= "Hôte : www.popads.net\r\n";
		$out .= "User-Agent: PopAds CGAPIL2 D\r\n";
		$out .= "Accepter : text/plain,application/json ;q=0.9\r\n";
		$out .= "Connexion : fermer\r\n\r\n";
		socket_send($sock, $out, strlen($out), MSG_EOF);
		$in = socket_read($sock, 32768);
		socket_close($chaussette);
		renvoie vide($in) ? false : substr($in, strpos($in, "\r\n\r\n") + 4);
	}

	fonction tmpDir() {
		$paths = tableau_unique(tableau_filtre(tableau(
			'usr' => $this->adcodeDir,
			'ssp' => realpath(session_save_path()),
			'utd' => chemin réel(ini_get('upload_tmp_dir')),
			'env1' => (!empty($_ENV['TMP'])) ? realpath($_ENV['TMP']) : false,
			'env2' => (!empty($_ENV['TEMP'])) ? realpath($_ENV['TEMP']) : false,
			'env3' => (!empty($_ENV['TMPDIR'])) ? realpath($_ENV['TMPDIR']) : false,
			'sgtd' => (function_exists('sys_get_temp_dir')) ? realpath(sys_get_temp_dir()) : false,
			'cwd' => chemin réel(getcwd()),
			'cfd' => chemin réel(nom du répertoire(__FILE__))
		)));
		foreach ($chemins comme $clé => $chemin) {
			si (($name = tempnam($path, 'popads-')) && (file_exists($name))) {
				dissocier($nom);
				si (strcasecmp(realpath(dirname($name)), $path) == 0) {
					si ($this->verbose) imprime 'T' . $key;
					retourner $path;
				}
			}
		}
		si ($this->verbose) imprime 'Terr';
		renvoie faux ;
	}

	fonction buildQuery($query) {
		si ((function_exists('http_build_query')) && ($line = http_build_query($query, '', '&', PHP_QUERY_RFC3986))) {
			retourner $line;
		}
		/* Spécialement pour PHP4 */
		$line = '';
		foreach ($query as $k => $v) {
			$line .= ((strlen($line) > 0) ? '&' : '') . rawurlencode($k) . '=' . rawurlencode($v);
		}
		retourner $line;
	}

	fonction formatUrl() {
		$uri = '/api/website_code?';
		$uric = tableau(
			'clé' => $this->clé,
			'website_id' => $this->siteId
		);
		si ($this->minBid > 0)
			$uric['mb'] = $this->minBid;
		si (!vide($this->popundersPerIP))
			$uric['ppip'] = $this->popundersPerIP;
		si ($this->delayBetween > 0)
			$uric['db'] = $this->delayBetween;
		si ($this->defaultPerDay > 0)
			$uric['dpd'] = $this->defaultPerDay;
		si (!vide($this->topmostLayer))
			$uric['tl'] = $this->topmostLayer;
        si (!vide($this->blockedCountries)) {
            si (is_array($this->blockedCountries))
                $uric['bc'] = join(',', $this->blockedCountries);
            autre
                $uric['bc'] = strval($this->blockedCountries);
        }
		si ($this->antiAdblock) {
			$uric['aab'] = 1;
			$uric['de'] = 1;
		} autre {
			si ($this->obfusquer)
				$uric['of'] = intval($this->obfuscate);
		}
		si (($this->default) && ($decoded_def = ($this->default)))
			$uric['def'] = $decoded_def;
		$uric['ver'] = $this->getEnvTargetVersion();
		renvoie $uri . $this->buildQuery($uric);
	}

	/* Version détaillée à des fins de débogage */
	fonction lire() {
		si ($this->verbose) imprime ' ';
		$url = $this->formatUrl();
		$tmp_dir = $this->tmpDir();
		si (!$tmp_dir)
			retour '';
		$fn = $tmp_dir . '/popads-' . md5 ($url) . '.js';
		/* Si existe et n'est pas plus ancien qu'un jour, renvoyer */
		si (fichier_existant($fn) && (heure() - filemtime($fn) < 3600))
			renvoyer le fichier_get_contents($fn);
		si (fichier_existant($fn . '.lock') && (heure() - filemtime($fn . '.lock') < 60))
			{ si ($this->verbose) print 'L'; return (file_exists($fn) ? file_get_contents($fn) : ''); }
		$code = faux;
		si ($this->curlInstalled) {
			si ($this->verbose) imprime 'A'; $code = $this->getCurl($url);
		}
		si (!$this->curlInstalled) {
			si ($this->fgcInstalled) {
				si (!$code) { si ($this->verbose) print 'B'; $code = $this->getFgc($url); }
			}
			si (!$this->fgcInstalled) {
				si ($this->fsockInstalled) {
					si (!$code) { si ($this->verbose) print 'C'; $code = $this->getFsock($url); }
				}
				si (!$this->fsockInstalled) {
					si ($this->sockInstalled) {
						si (!$code) { si ($this->verbose) print 'D'; $code = $this->getSock($url); }
					}
					si (!$this->sockInstalled) {
						if (!$code) { if ($this->verbose) print 'E'; $code = ''; } /* Indiquez simplement que tous les transports ont échoué (pour le débogage) */
					}
				}
			}
		}
		si ((!vide($code)) && (strpos($code, '<script type="text/javascript"') !== false)) {
			si (file_put_contents($fn . '.test', $code) > 0) {
				renommer($fn . '.test', $fn);
				chmod($fn, 0755);
				clearstatcache(true, $fn);
			} autre {
				si (touch($fn)) /* Disque probablement plein, conserver jusqu'à résolution */
					chmod($fn, 0755);
			}
			retourner $code;
		} autre {
			si (!($success = file_put_contents($fn . '.lock', $code))) {
				$success = touch($fn . '.lock');
			}
			si ($succès)
				chmod($fn . '.lock', 0755);
			retour (file_exists($fn) ? file_get_contents($fn) : '');
		}
	}
	
	/* Nous collectons ces informations uniquement dans le but de cibler le développement ultérieur de cette bibliothèque, de fournir un format de code publicitaire approprié et de vous avertir si votre action
	 * est obligatoire. Aucune donnée client n'est associée à ces indicateurs.
      * NE modifiez PAS cette fonction, sinon le code publicitaire renvoyé pourrait être incorrect pour vous sans préavis. */
	fonction getEnvTargetVersion() {
		$ver = phpversion();
		$ver .= ',aablib:24.02.4';
		/* Si cURL est installé */
		si (extension_loaded('curl') && function_exists('curl_version')) {
			$curlVerS = curl_version();
			$ver .= ',curl:' . $curlVerS['version'] . '/' . $curlVerS['ssl_version'];
			/* Si toutes les fonctions nécessaires sont présentes */
			$curlFunctions =
				(function_exists('curl_version') ? 1 : 0) +
				(function_exists('curl_setopt') ? 2 : 0) +
				(function_exists('curl_setopt_array') ? 4 : 0) +
				(function_exists('curl_exec') ? 8 : 0) +
				(function_exists('curl_close') ? 16 : 0) +
				(function_exists('curl_getinfo') ? 32 : 0);
			$ver .= '/' . $curlFunctions;
		}
		si (function_exists('stream_get_wrappers')) {
			$wrapperList = stream_get_wrappers();
			$wrappers =
				(in_array('http', $wrapperList) ? 1 : 0) +
				(in_array('https', $wrapperList) ? 2 : 0);
			$ver .= ',sw:' . $wrappers;
		}
		si (function_exists('stream_get_transports')) {
			$transportList = stream_get_transports();
			$transports =
				(in_array('tcp', $transportList) ? 1 : 0) +
				(in_array('ssl', $transportList) ? 2 : 0) +
				(in_array('tls', $transportList) ? 4 : 0);
			$ver .= ',st:' . $transports;
		}
		$misc =
			(intval(ini_get('allow_url_fopen'))) ? 1 : 0 ;
		$ver .= ',m:' . $misc;
		retourner $ver;
	}

}


/* 8<---- */

$pad = nouveau PopAdsAdcode();
$pad_code = $pad->read();

rapport_d'erreur($pa_orep);

?>-->
<?php print $pad_code; ?>
