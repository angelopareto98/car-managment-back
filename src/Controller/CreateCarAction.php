<?php
namespace App\Controller;

use App\Entity\Car;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
class CreateCarAction extends AbstractController{
    public function __invoke(Request $request): Car
    {
        $uploadedFile = $request->files->get('image');

        if (!$uploadedFile) {
            throw new BadRequestHttpException('"File" is required');
        }

        // create a new entityt and set its values
        $car = new Car();
        $car->setNumberCar( $request->get('numberCar'));
        $car->setMark($request->get('mark'));
        $car->setPriceUnit($request->get('priceUnit'));
        $car->setStock($request->get('stock'));
        $car->image = $uploadedFile;


     
        return $car;
    }
}