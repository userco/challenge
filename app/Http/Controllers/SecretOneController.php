<?php

namespace App\Http\Controllers;

use lfkeitel\phptotp\{Base32,Totp};
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use View;
use App\Http\Controllers\Controller;
use App\Secret;

class SecretOneController extends Controller
{
// the first part of the challenge

	// view of the first part of the challenge
    public function firstpart(Request $request){
		return View::make('SecretOne/qrcode');
	}
   
	//the business logic in the first part of the challenge
    public function create(Request $request){
		// get the data that the user have entered
		$input = Input::get();
		$label = $input['label'];
		$username = $input['username'];
		
		//make the string for the qrCode
		$qrCode = $label.$username;
		$secretObject = Secret::where('username', $username)->get();
		$secretObject = $secretObject[0];
		//$secretObject = Secret::find($username);
		//encode the username
		$secret = Base32::encode($username);
		if(!$secretObject){
			//dd("here");
			
			$secretObject = new Secret;
			$secretObject->code = "";
			$secretObject->username = $username;
			$secretObject->save();
		
		}
		
		//make object of type Barcode
		$barcodeObject = new \Com\Tecnick\Barcode\Barcode();

		// generate a barcode
		$barcode = $barcodeObject->getBarcodeObj(
			'QRCODE,H',                     // barcode type and additional comma-separated parameters
			$qrCode,          				// data string to encode
			-4,                             // bar width (use absolute or negative value as multiplication factor)
			-4,                             // bar height (use absolute or negative value as multiplication factor)
			'black',                        // foreground color
			array(-2, -2, -2, -2)           // padding (use absolute or negative values as multiplication factors)
			)->setBackgroundColor('white'); // background color
	    $imageData = $barcode->getPngData();		
		$timestamp = time();
    
		file_put_contents($timestamp . '.png', $imageData);
		
		# Generate the current TOTP key
		$code = (new Totp())->GenerateToken($secret);
		if(!$secretObject){
			$secretObject = new Secret;
			$secretObject->code = $code;
			$secretObject->username = $username;
		}else{
			$secretObject->code = $code;
		}	
		$secretObject->save();
		return View::make('SecretOne/qrcodeview')->with(array('qrCode'=> $timestamp, 'key' => $code));
	}
	
//the second part of the challenge
	//view the second part of the challenge
	public function secondpart(Request $request){
		return View::make('SecretOne/qrcodetwo');
	}
	
	//the business logic of the second part of the challenge
	public function match(Request $request){
		
		//get the data that the user have entered
		$input = Input::get();
		$code = $input['code'];
		$username = $input['username'];
		$secretObject = Secret::where('username', $username)->get();
		//dd($secretObject);
		if(!isset($secretObject[0])){
			$sentence = "There is no secret for this username";
			return View::make('SecretOne/qrcode2')->with(array('sentence' => $sentence));
		}	
		//encode the username
		$token = $secretObject[0]->code;
	
		//verify if token matches  code
		$sentence = "The code does not match the username.";
		if($code == $token){
			$sentence = "The code matches the username.";
		}
		
		return View::make('SecretOne/qrcode2')->with(array('sentence' => $sentence));
	}
}
