<?php

namespace App\Traits;

trait Codeable
{
    public function createCode($code = null)
    {
        $this->update([
            'code' => $code ?? \Illuminate\Support\Str::random(4),
        ]);

        return $this;
    }

    public function codeExists($code)
    {
        return $this->code === $code;
    }

    public function deleteCode()
    {
        return $this->update([
            'code' => null,
        ]);
    }
}
