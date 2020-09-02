<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class RelationshipsConverter
{
    public static function newFromPagination(Pagination $pagination, array $arr): Pagination
    {
        $included = $pagination->included = self::includedWithKeys($arr['included']);
        foreach ($pagination->data as $datum) {
            if (!property_exists($datum, 'relationships')) {
                continue;
            }
            $datum->relationships = self::convertRelationships($datum->relationships, $included);
        }

        return $pagination;
    }

    public static function newFromObject(object $object, array $arr): object
    {
        $object->included = self::includedWithKeys($arr['included']);
        if (!property_exists($object, 'relationships')) {
            return $object;
        }
        $object->relationships = self::convertRelationships($object->relationships, $object->included);

        return $object;
    }

    public static function toArray(?array $relationships): array
    {
        $arr = [];
        if (is_null($relationships)) {
            return $arr;
        }
        foreach ($relationships as $key => $relationship) {
            if (!$relationship instanceof Relationship && !isset($relationship[0])) {
                continue;
            }
            elseif (is_array($relationship) && isset($relationship[0]) && $relationship[0] instanceof Relationship) {
                foreach ($relationship as $key2 => $sub) {
                    if (!$sub instanceof Relationship) {
                        continue;
                    }
                    $arr[$key]['data'][$key2] = $sub->toArray();
                }
            } else {
                $arr[$key]['data'] = $relationship->toArray();
            }
        }

        return $arr;
    }

    private static function convertRelationships(array $relationships, array $included): ?array
    {
        $objectRelationships = [];
        foreach ($relationships as $key => $relationship) {
            if (isset($relationship['data'])) {
                $relationship = $relationship['data'];
            }
            if (is_null($relationship)) {
                continue;
            }
            if (!isset($relationship['id'], $relationship['type']) && is_array($relationship)) {
                if (isset($relationship['meta']) && 0 === count($relationship['meta'])) {
                    $objectRelationships[$key] = null;
                } else {
                    $objectRelationships[$key] = self::convertRelationships($relationship, $included);
                }
            } else {
                $objectRelationships[$key] = self::convertRelationship($relationship, $included);
            }
        }

        return $objectRelationships;
    }

    private static function convertRelationship(array $relationship, array $included): ?Relationship
    {
        if (!isset($relationship['id'], $relationship['type'])) {
            return null;
        }
        $includeId = "{$relationship['type']}_{$relationship['id']}";
        if (!isset($included[$includeId])) {
            return null;
        }

        return Relationship::new($included[$includeId]);
    }

    private static function includedWithKeys(array $arr): array
    {
        $included = [];
        foreach ($arr as $include) {
            $included["{$include['type']}_{$include['id']}"] = $include;
        }

        return $included;
    }
}
