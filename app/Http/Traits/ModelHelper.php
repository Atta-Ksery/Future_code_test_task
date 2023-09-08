<?php

namespace App\Http\Traits;

use App\Constants\ApiMessages;
use App\Constants\Resources;
use App\Http\Traits\ApiResponder;
use Exception;

class ModelHelper
{
    public static function findByIdOrFail($model, $modelId, $type = 'male', $resource)
    {
        $modelInstance = $model::find($modelId);
        if (!$modelInstance) {
            $notFoundMessage = '';
            if ($type == 'female') {
                $notFoundMessage = ApiMessages::MSG_NOT_FOUNDF;
            } else {
                $notFoundMessage = ApiMessages::MSG_NOT_FOUND;
            }
            return ApiResponder::notFoundResourceResponse([], __($notFoundMessage, ['resource' => __($resource)]));
        }
        return $modelInstance;
    }

    public static function getModelInstancesDependingOnIds($model, $modelIds) {
        $modelInstances = collect();
        foreach ($modelIds as $modelId) {
            $modelInstance = $model::find($modelId);
            $modelInstances->push($modelInstance);
        }

        return $modelInstances;
    }
}
