<?php

// Include Composer's autoload file
require_once __DIR__ . '/vendor/autoload.php';


use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QRMarkupSVG;
use chillerlan\QRCode\Output\QROutputInterface;
// Function to generate QR code data from input text
function genarateQrData($data, $size = 1,$css = "qrSvg") {
   $options = new QROptions;
$options->version              = 1;
$options->scale             = $size;
$options->outputType           = QROutputInterface::CUSTOM;
$options->outputInterface      = SVGConvert::class;
$options->outputBase64         = false;
$options->addQuietzone        = false;
$options->connectPaths        = true;
$options->cssClass             = $css;
$options->svgViewBoxSize      = 500;


$qrcode = new QRCode($options);

$output = $qrcode->render($data);

return $output;
}


class SVGConvert extends QRMarkupSVG{

	/** @inheritDoc */
	protected function header():string{
		[$width, $height] = $this->getOutputDimensions();

		// we need to specify the "width" and "height" attributes so that Imagick knows the output size
		$header = sprintf(
			'<svg xmlns="http://www.w3.org/2000/svg" class="qr-svg %1$s" viewBox="%2$s" preserveAspectRatio="%3$s" width="%5$s" height="%6$s">%4$s',
			$this->options->cssClass,
			$this->getViewBox(),
			$this->options->svgPreserveAspectRatio,
			$this->options->eol,
			//($width * 
            ($this->scale), // use the scale option to modify the size
			//($height * 
            ($this->scale)
		);

		if($this->options->svgAddXmlHeader){
			$header = sprintf('<?xml version="1.0" encoding="UTF-8"?>%s%s', $this->options->eol, $header);
		}

		return $header;
	}


}