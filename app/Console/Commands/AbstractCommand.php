<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\VarDumper;

abstract class AbstractCommand extends Command
{
    /**
     * Validate data and print error message
     */
    protected function validateData(array $data, array $rules, array $messages = [], array $attributes = []): bool
    {
        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return false;
        }

        return true;
    }
}
