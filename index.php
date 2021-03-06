<?php

/**
 * Application d'exemple Agence de voyages Silex
 */

// require_once __DIR__.'/vendor/autoload.php';
$vendor_directory = getenv ( 'COMPOSER_VENDOR_DIR' );
if ($vendor_directory === false) {
	$vendor_directory = __DIR__ . '/vendor';
}
require_once $vendor_directory . '/autoload.php';

// Initialisations
$app = require_once 'initapp.php';

require_once 'agvoymodel.php';

// Routage et actions

// circuitlist : Liste tous les circuits

$app->get ( '',
	function () use ($app)
	{

		return $app ['twig']->render ( 'menuslist.html.twig');
}
)->bind ( 'menulist' );

$app->get ( '/user/circuit',
    function () use ($app)
    {
    	$circuitslist = get_all_circuits ();
    	// print_r($circuitslist);

    	return $app ['twig']->render ( 'circuitslist.html.twig', [
    			'circuitslist' => $circuitslist
    	] );
    }
)->bind ( 'circuitlist' );

$app->get ( '/admin/circuit',
    function () use ($app)
    {
    	$circuitslist = get_all_circuits ();
    	// print_r($circuitslist);

    	return $app ['twig']->render ( 'circuitslistadmin.html.twig', [
    			'circuitslist' => $circuitslist
    	] );
    }
)->bind ( 'circuitlistadmin' );

// circuitshow : affiche les détails d'un circuit
$app->get ( '/user/circuit/{id}',
	function ($id) use ($app)
	{
		$circuit = get_circuit_by_id ( $id );
		// print_r($circuit);
		$programmations = get_programmations_by_circuit_id ( $id );
		//$circuit ['programmations'] = $programmations;

		return $app ['twig']->render ( 'circuitshow.html.twig', [
				'id' => $id,
				'circuit' => $circuit
			] );
	}
)->bind ( 'circuitshow' );

$app->get ( '/admin/circuit/{id}',
	function ($id) use ($app)
	{
		$circuit = get_circuit_by_id ( $id );
		// print_r($circuit);
		$programmations = get_programmations_by_circuit_id ( $id );
		//$circuit ['programmations'] = $programmations;

		return $app ['twig']->render ( 'circuitshowadmin.html.twig', [
				'id' => $id,
				'circuit' => $circuit
			] );
	}
)->bind ( 'circuitshowadmin' );

// programmationlist : liste tous les circuits programmés
$app->get ( '/programmation',
	function () use ($app)
	{
		$programmationslist = get_all_programmations ();
		// print_r($programmationslist);

		return $app ['twig']->render ( 'programmationslist.html.twig', [
				'programmationslist' => $programmationslist
			] );
	}
)->bind ( 'programmationlist' );

$app->run ();
