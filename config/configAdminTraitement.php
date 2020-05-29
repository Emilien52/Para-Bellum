<?php 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['actions']['editTheme'] == true) 
{
	//About SECTION
	$ecritureTheme['About']['main-title'] = htmlspecialchars($_POST['about-main-title']);
	$ecritureTheme['About']['desc-top'] = htmlspecialchars($_POST['about-desc-top']);

	$ecritureTheme['About']['icon1'] = htmlspecialchars($_POST['about-icon1']);
	$ecritureTheme['About']['icon2'] = htmlspecialchars($_POST['about-icon2']);
	$ecritureTheme['About']['icon3'] = htmlspecialchars($_POST['about-icon3']);

	$ecritureTheme['About']['title1'] = htmlspecialchars($_POST['about-title1']);
	$ecritureTheme['About']['title2'] = htmlspecialchars($_POST['about-title2']);
	$ecritureTheme['About']['title3'] = htmlspecialchars($_POST['about-title3']);

	$ecritureTheme['About']['desc1'] = htmlspecialchars($_POST['about-desc1']);
	$ecritureTheme['About']['desc2'] = htmlspecialchars($_POST['about-desc2']);
	$ecritureTheme['About']['desc3'] = htmlspecialchars($_POST['about-desc3']);

	$ecritureTheme['About']['desc-bottom'] = htmlspecialchars($_POST['about-desc-bottom']);


	//News SECTION
	$ecritureTheme['News']['main-title'] = htmlspecialchars($_POST['news-main-title']);
	$ecritureTheme['News']['desc-top'] = htmlspecialchars($_POST['news-desc-top']);


	//Staff SECTION
	$ecritureTheme['Staff']['main-title'] = htmlspecialchars($_POST['staff-main-title']);
	$ecritureTheme['Staff']['desc-top'] = htmlspecialchars($_POST['staff-desc-top']);

	$ecritureTheme['Staff']['number'] = htmlspecialchars($_POST['staff-number']);
	for ($numberStaff=1 ; $numberStaff < $ecritureTheme['Staff']['number']+1 ; $numberStaff++ ) { 
		$ecritureTheme['Staff']['name'.$numberStaff] = htmlspecialchars($_POST['staff-name'.$numberStaff]);
		$ecritureTheme['Staff']['grade'.$numberStaff] = htmlspecialchars($_POST['staff-grade'.$numberStaff]);
	}


	//Footer SECTION
	$ecritureTheme['Footer']['icon1'] = htmlspecialchars($_POST['footer-icon1']);
	$ecritureTheme['Footer']['icon2'] = htmlspecialchars($_POST['footer-icon2']);
	$ecritureTheme['Footer']['icon3'] = htmlspecialchars($_POST['footer-icon3']);

	$ecritureTheme['Footer']['link-icon1'] = htmlspecialchars($_POST['footer-link-icon1']);
	$ecritureTheme['Footer']['link-icon2'] = htmlspecialchars($_POST['footer-link-icon2']);
	$ecritureTheme['Footer']['link-icon3'] = htmlspecialchars($_POST['footer-link-icon3']);

	//Other SECTION

		//Colors

		$ecritureTheme['Other']['main-color'] = (!isset($_POST['other-main-color'])) ? "#d82c2e" : htmlspecialchars($_POST['other-main-color']);


	$ecriture = new Ecrire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml', $ecritureTheme);
}
