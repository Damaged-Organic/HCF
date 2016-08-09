<?php
// src/AppBundle/Service/ImageCreatorShortcut.php
namespace AppBundle\Service;

class ImageCreatorShortcut
{
    const TICKET_IMAGE = "../src/AppBundle/Resources/ticket/ticket.jpg";
    const FONT_FILE    = "../src/AppBundle/Resources/public/fonts/OpenSans-Regular.ttf";

    public function generateSignedTicket($prefixedTicketId, $companyName)
    {
        $ticketImage = imagecreatefromjpeg(self::TICKET_IMAGE);

        $fontSize   = 12;
        $fontAngle  = 0;
        $whiteColor = imagecolorallocate($ticketImage, 255, 255, 255);

        imagettftext($ticketImage, $fontSize, $fontAngle, 20, 30, $whiteColor, self::FONT_FILE, $prefixedTicketId);

        $coordinateX = $this->getRightFloatedCoordinateX($ticketImage, $companyName, $fontSize, $fontAngle);

        imagettftext($ticketImage, $fontSize, $fontAngle, $coordinateX, 30, $whiteColor, self::FONT_FILE, $companyName);

        ob_start();
        imagejpeg($ticketImage, NULL, 100);
        $ticketResource = ob_get_contents();

        return $ticketResource;
    }

    public function getRightFloatedCoordinateX($image, $string, $fontSize, $fontAngle)
    {
        $dimensions = imagettfbbox($fontSize, $fontAngle, self::FONT_FILE, $string);

        return imagesx($image) - (abs($dimensions[4] - $dimensions[0])) - 20;
    }
}