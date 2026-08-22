<?php

$source = getenv('ASSOCIATION_SOURCE_PATH');
if (!$source || !is_file($source . '/base/association.php')) {
	fwrite(STDERR, "ASSOCIATION_SOURCE_PATH doit pointer vers le socle Association 4.\n");
	exit(2);
}

define('_ECRIRE_INC_VERSION', 1);
require $source . '/base/association.php';
$legacy = association_declarer_tables_principales(array());

unset($GLOBALS['association_schema_test_loaded']);
require dirname(__DIR__) . '/base/association_adhesions.php';
$module = association_adhesions_declarer_tables_principales(array());

$erreurs = array();
foreach (array('spip_asso_categories_adherents', 'spip_asso_cotisations') as $table) {
	if (($legacy[$table] ?? null) !== ($module[$table] ?? null)) {
		$erreurs[] = 'schéma différent pour ' . $table;
	}
}

if ($erreurs) {
	fwrite(STDERR, implode("\n", $erreurs) . "\n");
	exit(1);
}

echo "OK: schémas Adhésions identiques au socle Association 4.\n";
