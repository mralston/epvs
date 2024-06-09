<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Database\Eloquent\Model;

trait HydratesRelations
{
    public function fillAndHydrate(array $attributes, bool $persist = true): Model
    {
        $this->setRawAttributes(['id' => $attributes['id'] ?? null])
            ->fill($attributes)
            ->hydrateRelations($attributes, $persist);

        if ($persist) {
            $this->save();
        }

        return $this;
    }

    public function hydrateRelations(array $attributes, bool $persist = true): Model
    {
        if (!isset($this->hydrate) || !is_array($this->hydrate)) {
            return $this;
        }

        foreach ($attributes as $field => $relationAttributes) {
            if (
                is_array($relationAttributes) &&
                isset($this->hydrate[$field]) &&
                class_exists($class = $this->hydrate[$field])
            ) {
                $child = ($class::find($relationAttributes['id'] ?? null) ?? app($class))
                    ->fill($relationAttributes);

                if ($persist) {
                    $child->save();
                    $child->attributes[$field . '_id'] = $child->id;
                } else {
                    $this->attributes[$field] = $child;
                }

                if (method_exists($child, 'hydrate')) {
                    $child->hydrate($relationAttributes, $persist);
                }
            }
        }

        return $this;
    }
}