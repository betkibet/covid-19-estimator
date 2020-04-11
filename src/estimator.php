<?php

function covid19ImpactEstimator($data)
{
  return $data;
}
$inputData  = array( 
		'region' => array(       
			'name'=> "Africa",       
			'avgAge'=> 19.7,       
			'avgDailyIncomeInUSD'=> 5,       
			'avgDailyIncomePopulation'=> 0.71     
		),   
		'periodType'=> "days",   
		'timeToElapse'=> 58,   
		'reportedCases'=> 674.58,   
		'population'=> 66622705,   
		'totalHospitalBeds'=> 1380614 
);

$reportedCases = $inputData['reportedCases'];
$totalHospitalBeds = $inputData['totalHospitalBeds'];

$currentlyInfectedI =  intval($reportedCases * 10);
$infectionsByRequestedTimeI = intval($currentlyInfectedI * (2^9));
$severeCasesByRequestedTimeI = intval($infectionsByRequestedTimeI * 0.15);
$hospitalBedsByRequestedTimeI = intval(($totalHospitalBeds * 0.35) - $severeCasesByRequestedTimeI);
$casesForICUByRequestedTimeI = intval($infectionsByRequestedTimeI * 0.05);
$casesForVentilatorsByRequestedTimeI = intval($infectionsByRequestedTimeI * 0.02);
$dollarsInFlightI = intval(($infectionsByRequestedTimeI * 0.65 * 1.5) / 30);
 
$currentlyInfectedS =  intval($reportedCases * 50);
$infectionsByRequestedTimeS = intval($currentlyInfectedS * (2^9));
$severeCasesByRequestedTimeS = intval($infectionsByRequestedTimeS * 0.15);
$hospitalBedsByRequestedTimeS = intval($totalHospitalBeds * 0.35 - $severeCasesByRequestedTimeS);
$casesForICUByRequestedTimeS = intval($infectionsByRequestedTimeS * 0.05);
$casesForVentilatorsByRequestedTimeS = intval($infectionsByRequestedTimeS * 0.02);
$dollarsInFlightS = intval(($infectionsByRequestedTimeS * 0.65 * 1.5) / 30);

//Return Impact data
$impact = array(
	'currentlyInfected' => $currentlyInfectedI,
	'infectionsByRequestedTime' => $infectionsByRequestedTimeI,
	'severeCasesByRequestedTime' => $severeCasesByRequestedTimeI,
	'hospitalBedsByRequestedTime' => $hospitalBedsByRequestedTimeI,
	'casesForICUByRequestedTime' => $casesForICUByRequestedTimeI,
	'casesForVentilatorsByRequestedTime' => $casesForVentilatorsByRequestedTimeI,
	'dollarsInFlight' => $dollarsInFlightI,
);



//Return Severe Impact Data
$severeImpact = array (
	
	'currentlyInfected' => $currentlyInfectedS,
	'infectionsByRequestedTime' => $infectionsByRequestedTimeS,
	'severeCasesByRequestedTime' => $severeCasesByRequestedTimeS,
	'hospitalBedsByRequestedTime' => $hospitalBedsByRequestedTimeS,
	'casesForICUByRequestedTime' => $casesForICUByRequestedTimeS,
	'casesForVentilatorsByRequestedTime' => $casesForVentilatorsByRequestedTimeS,
	'dollarsInFlight' => $dollarsInFlightS,
);

//Output Data
$estimate = array(
	'impact' =>$impact,
	'severeImpact' => $severeImpact
);
$outputData = array(
	'data' => $inputData,
	'estimate' => $estimate,
);

$data = json_encode($outputData);
$ouputData = covid19ImpactEstimator($data);

//echo $data;