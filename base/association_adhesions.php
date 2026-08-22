<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Déclare les tables appartenant au domaine Adhésions.
 *
 * @param array $tables
 * @return array
 */
function association_adhesions_declarer_tables_principales($tables) {
	$tables['spip_asso_categories_adherents'] = array(
		'field' => array(
			'id_categorie' => "INT NOT NULL",
			'valeur' => 'TINYTEXT NOT NULL',
			'statut' => 'TINYTEXT NOT NULL',
			'cotisation' => "FLOAT NOT NULL DEFAULT '0'",
			'devise' => "VARCHAR(3) NOT NULL DEFAULT ''",
			'paiement_en_ligne' => 'BOOLEAN default 0',
			'commentaires' => 'TEXT NOT NULL',
			'maj' => 'TIMESTAMP NOT NULL',
		),
		'key' => array('PRIMARY KEY' => 'id_categorie'),
	);

	$tables['spip_asso_cotisations'] = array(
		'field' => array(
			'id_cotisation' => 'BIGINT NOT NULL',
			'id_compte' => "BIGINT NOT NULL DEFAULT '0'",
			'id_auteur' => "BIGINT NOT NULL DEFAULT '0'",
			'id_categorie' => "INT NOT NULL DEFAULT '0'",
			'id_transaction' => "BIGINT NOT NULL DEFAULT '0'",
			'inscription' => "VARCHAR(32) NOT NULL DEFAULT ''",
			'statut' => "VARCHAR(32) NOT NULL DEFAULT 'attente'",
			'date_creation' => "DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'",
			'date_debut_validite' => 'DATE NULL DEFAULT NULL',
			'date_fin_validite' => 'DATE NULL DEFAULT NULL',
			'montant' => "DECIMAL(20,6) NOT NULL DEFAULT '0'",
			'devise' => "VARCHAR(3) NOT NULL DEFAULT ''",
			'maj' => 'TIMESTAMP NOT NULL',
		),
		'key' => array(
			'PRIMARY KEY' => 'id_cotisation',
			'UNIQUE KEY id_compte' => 'id_compte',
			'KEY id_auteur' => 'id_auteur',
			'KEY id_transaction' => 'id_transaction',
		),
	);

	return $tables;
}
