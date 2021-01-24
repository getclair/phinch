<?php

namespace Phinch\Products;

use Phinch\Paginated;

class Deduction extends BaseProduct
{
    protected const PREFIX = 'employer/deduction';

    public function create($name, $type, $frequency): array
    {
        return $this->client->post(self::PREFIX.'/company/create', [
            'name' => $name,
            'type' => $type,
            'frequency' => $frequency,
        ]);
    }

    public function viewDeductions(): Paginated
    {
        return new Paginated($this->client->post(self::PREFIX.'/company/list', []));
    }

    public function enroll($deduction_id, $individual_id, array $employee_deduction, array $company_contribution): array
    {
        return $this->client->post(self::PREFIX.'/individual/create', [
            'deduction_id' => $deduction_id,
            'individual_id' => $individual_id,
            'employee_deduction' => $employee_deduction,
            'company_contribution' => $company_contribution,
        ]);
    }

    public function viewEnrollment($deduction_id, $individual_id): array
    {
        return $this->client->post(self::PREFIX.'/individual/get', [
            'deduction_id' => $deduction_id,
            'individual_id' => $individual_id,
        ]);
    }

    public function unenroll($deduction_id, $individual_id): array
    {
        return $this->client->post(self::PREFIX.'/individual/delete', [
            'deduction_id' => $deduction_id,
            'individual_id' => $individual_id,
        ]);
    }
}
