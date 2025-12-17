<?php

namespace app\controllers;

//use Flight;
use flight\Engine;
use Flight;
use app\models\BeneficePeriodeModel;


class ApiExampleController {

	protected Engine $app;

	public function __construct($app) {
		$this->app = $app;
	}

	// public function home(){
	// 	$product=new ProductModel(Flight::db());

	// 	$produit=$product->getProduit();
	// 	//$data=['titre'=>$produit];
	// 	Flight::render('index',['product'=>$produit]);

	// }

	public function AllBenefice(){
		$Benefice=new BeneficePeriodeModel(Flight::db());
		$Jour=$Benefice->getBeneficeParJour();
		$Mois=$Benefice->getBenenficeParMois();
		$Annee=$Benefice->getBenenficeParAn();

		Flight::render('index',['Jour'=>$Jour,'Mois'=>$Mois,'Annee'=>$Annee]);
	}
	

	public function updateUser($id) {
		// You could actually update data from the database if you had one set up
		// $statement = $this->app->db()->runQuery("UPDATE users SET email = ? WHERE id = ?", [ $this->app->data['email'], $id ]);
		$this->app->json([ 'success' => true, 'id' => $id ], 200, true, 'utf-8', JSON_PRETTY_PRINT);
	}
}