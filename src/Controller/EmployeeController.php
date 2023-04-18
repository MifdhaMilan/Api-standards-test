<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Employee;
use App\Repository\EmployeeRepository;

class EmployeeController extends AbstractController
{

    /**
     * @Route("/api/get_employees/{id}", name="employee_list", methods={"GET"})
     */
    public function getEmployeeById($id): Response
    {
        $jsonData = file_get_contents(__DIR__.'/../Data/employees.json');
        $employees = json_decode($jsonData, true);

        foreach ($employees as $employee) {
            if ($employee['id'] == $id) {
                $response = new Response();
                $response->setContent(json_encode($employee));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }
        }

        throw $this->createNotFoundException('The employee with id '.$id.' does not exist');
    }

//    /**
//     * @var \EmployeeRepository
//     */
//    protected $employeeRepository;
//
//    /**
//     * @return EmployeeRepository
//     */
//    public function getEmployeeRepository() {
//        if (is_null($this->employeeRepository)) {
//            $this->employeeRepository = new EmployeeRepository();
//        }
//        return $this->employeeRepository;
//    }

//
//    /**
//     * @Route("/api/employees", name="employee_list", methods={"GET"})
//     */
//    public function list(): Response
//    {
//        $employees = $this->getEmployeeRepository()->getAllEmployees();
//
//        $data = [];
//        foreach ($employees as $employee) {
//            $data[] = [
//                'id' => $employee->getId(),
//                'name' => $employee->getName(),
//            ];
//        }
//
//        return new JsonResponse($data);
//    }

//    /**
//     * @Route("/api/employees/{id}", name="employee_get", methods={"GET"})
//     * @param string $id
//     * @param $employeeRepository
//     * @return Response
//     */
//    public function get(string $id): object
//    {
//        $employee = $this->getEmployeeRepository()->getEmployeeById($id);
//
//        if (!$employee) {
//            return new JsonResponse(['error' => 'Employee not found'], Response::HTTP_NOT_FOUND);
//        }
//
//        $data = [
//            'id' => $employee->getId(),
//            'name' => $employee->getName(),
//        ];
//
//        return $data;
//    }
}
