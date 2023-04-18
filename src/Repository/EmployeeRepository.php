<?php

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Employee>
 *
 * @method Employee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employee[]    findAll()
 * @method Employee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeRepository extends ServiceEntityRepository
{
    public function __construct()
    {
        parent::__construct(Employee::class);
    }

    public function add(Employee $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Employee $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function getAllEmployees(): array
    {
        $contents = file_get_contents(__DIR__ . '/../Data/employees.json');
        $employees = json_decode($contents);

        return array_map(function ($employee) {
            $e = new Employee();
            $e->setId($employee->id);
            $e->setName($employee->name);

            return $e;
        }, $employees);
    }
    public function getEmployeeById(string $id): ?Employee
    {
        $employees = $this->getAllEmployees();
        foreach ($employees as $employee) {
            if ($employee->getId() === $id) {
                return $employee;
            }
        }

        return null;
    }
}
