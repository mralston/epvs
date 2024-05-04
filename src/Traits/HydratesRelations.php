<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Database\Eloquent\Model;

trait HydratesRelations
{
    public function hydrate(): Model
    {
        if (!isset($this->hydrate) || !is_array($this->hydrate)) {
            return $this;
        }

        foreach ($this->getAttributes() as $key => $value) {
            if (
                is_array($value) &&
                isset($this->hydrate[$key]) &&
                class_exists($this->hydrate[$key])
            ) {
                $child = app($this->hydrate[$key])->forceFill($value);

                if (method_exists($child, 'hydrate')) {
                    $child->hydrate();
                }

                $this->setAttribute($key, $child);
            }
        }

        return $this;
    }
}