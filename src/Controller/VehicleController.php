<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Vehicle;
use App\Form\VehicleType;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;

#[Route('/vehicle')]
class VehicleController extends AbstractController
{
    public const ROUTE_INDEX = 'vehicle_index';
    public const ROUTE_NEW = 'vehicle_new';
    public const ROUTE_EDIT = 'vehicle_edit';
    public const ROUTE_SHOW = 'vehicle_show';
    public const ROUTE_DELETE = 'vehicle_delete';

    #[Required]
    public EntityManagerInterface $entityManager;

    #[Route('/', name: self::ROUTE_INDEX, methods: ['GET'])]
    public function index(VehicleRepository $vehicleRepository): Response
    {
        return $this->render('vehicle/index.html.twig', [
            'vehicles' => $vehicleRepository->findAll(),
        ]);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/new', name: self::ROUTE_NEW, methods: ['GET', 'POST'])]
    public function new(Request $request, VehicleRepository $vehicleRepository): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicleRepository->add($vehicle);
            return $this->redirectToRoute(self::ROUTE_INDEX, [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicle/new.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: self::ROUTE_SHOW, methods: ['GET'])]
    public function show(Vehicle $vehicle): Response
    {
        return $this->render('vehicle/show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/{id}/edit', name: self::ROUTE_EDIT, methods: ['GET', 'POST'])]
    public function edit(Request $request, Vehicle $vehicle, VehicleRepository $vehicleRepository): Response
    {
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicleRepository->add($vehicle);
            return $this->redirectToRoute(self::ROUTE_INDEX, [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicle/edit.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form,
        ]);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/{id}/delete', name: self::ROUTE_DELETE, methods: ['POST'])]
    public function delete(Request $request, Vehicle $vehicle, VehicleRepository $vehicleRepository): Response
    {
        $relatedBookings = $this->entityManager->getRepository(Booking::class)->findBy(['vehicle' => $vehicle->getId()]);

        if ($relatedBookings) {
            $bookingIds = [];

            foreach ($relatedBookings as $booking) {
                $bookingIds[] = $booking->getId();
            }

            $this->addFlash('error', 'This vehicle is used on booking(s) with id: ' . implode(', ', $bookingIds));

            return $this->redirectToRoute(self::ROUTE_SHOW, ['id' => $vehicle->getId()], Response::HTTP_SEE_OTHER);
        }

        if ($this->isCsrfTokenValid('delete'.$vehicle->getId(), $request->request->get('_token'))) {
            $vehicleRepository->remove($vehicle);
        }

        return $this->redirectToRoute(self::ROUTE_INDEX, [], Response::HTTP_SEE_OTHER);
    }
}
