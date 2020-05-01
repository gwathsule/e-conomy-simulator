<?php

namespace App\Support;

use App\Support\Exceptions\ValidationException;
use Exception;

abstract class Service
{
    /**
     * Performs all validations for this service to run correctly.
     *
     * @param array $data
     * @return array
     * @throws ValidationException
     */
    abstract public function validate(array $data);

    /**
     * Performs the service logic.
     *
     * @param array $data
     * @param array $columns
     * @param array $relations
     * @return mixed
     * @throws Exception
     */
    abstract protected function perform(array $data, array $columns = ['*'], array $relations = []);

    /**
     * Handle the service logic.
     *
     * @param array $data
     * @param array $columns
     * @param array $relations
     * @return mixed
     * @throws ValidationException
     * @throws Exception
     */
    public function handle(array $data, array $columns = ['*'], array $relations = [])
    {
        $this->validate($data);
        return $this->perform($data, $columns, $relations);
    }
}
