<?php

namespace App\EntityConstraints;

use App\Enums\EntityType;
use App\Classes\Constant;
use App\Services\FileSystemService;
use App\EntityClasses\CustomValidator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

abstract class EntityConstraint
{
    public array $items = [];
    public string $prefix = "";

    public function createFields(Blueprint $table): void
    {
        foreach($this->items as $item){
            if($item->type == EntityType::STRING){
                if($item->isNullable) $table->string($item->name)->nullable();
                else if($item->value == null) $table->string($item->name);
                else $table->string($item->name)->default($item->value);
            }
            else if($item->type == EntityType::DATE){
                if($item->isNullable) $table->string($item->name)->nullable();
                else if($item->value == null) $table->date($item->name);
                else $table->date($item->name)->default($item->value);
            }
            else if($item->type == EntityType::BOOLEAN){
                if($item->isNullable) $table->boolean($item->name)->nullable();
                else if($item->value == null) $table->boolean($item->name);
                else $table->boolean($item->name)->default($item->value);
            }
            else if($item->type == EntityType::ENUM){
                $table->enum($item->name, $item->listEnum)->default($item->value);
            }
            else if($item->type == EntityType::FILE){
                if($item->isNullable) $table->string($item->name)->nullable();
                else if($item->value == null) $table->string($item->name);
                else $table->string($item->name)->default($item->value);
            }
            else if($item->type == EntityType::EMAIL){
                if($item->isNullable) $table->string($item->name)->nullable();
                else if($item->value == null) $table->string($item->name);
                else $table->string($item->name)->default($item->value);
            }
            else if($item->type == EntityType::INTEGER && $item->isForeignKey){
                if($item->isNullable) $table->unsignedBigInteger($item->name)->nullable();
                else if($item->value == null) $table->unsignedBigInteger($item->name);
                else $table->unsignedBigInteger($item->name)->default($item->value);
            }
            else if($item->type == EntityType::INTEGER){
                if($item->isNullable) $table->integer($item->name)->nullable();
                else if($item->value == null) $table->integer($item->name);
                else $table->integer($item->name)->default($item->value);
            }
            else if($item->type == EntityType::FLOAT){
                if($item->isNullable) $table->float($item->name)->nullable();
                else if($item->value == null) $table->float($item->name);
                else $table->float($item->name)->default($item->value);
            }
            if($item->isForeignKey){
                $table->foreign($item->name)
                    ->references($item->referenceKey)
                    ->on($item->referenceTable)->onDelete('cascade');
            }
        }
    }

    public function getRules(Request $request): CustomValidator
    {
        $rules = [];
        $messages = [];

        foreach($this->items as $item){
            if($item->isForeignKey) continue;
            if($item->value != null) continue;

            $rule = '';
            $isRequiredType = false;
            $requestName = $this->prefix ."". $item->name;

            if($item->type == EntityType::STRING && !$item->isFile){
                if($item->value != null || $item->isNullable)
                    $rule = 'bail|max:255';
                else {
                    $rule = 'bail|required|max:255';
                    $isRequiredType = true;
                }
            }
            else if($item->type == EntityType::DATE){
                if($item->value != null || $item->isNullable)
                    $rule = 'bail|date|max:255';
                else {
                    $rule = 'bail|required|date|max:255';
                    $isRequiredType = true;
                }
                $messages[$requestName.'.date'] = "{$item->value} n'est pas une date valide pour {$item->label}.";
            }
            else if($item->type == EntityType::BOOLEAN){
                if($item->value != null || $item->isNullable)
                    $rule = 'bail|boolean';
                else {
                    $rule = 'bail|required|boolean';
                    $isRequiredType = true;
                }
            }
            else if($item->type == EntityType::ENUM){
                if($item->value != null || $item->isNullable)
                    $rule = 'bail|in:'.implode(",", $item->listEnum);
                else {
                    $rule = 'bail|required|in:'.implode(",", $item->listEnum);
                    $isRequiredType = true;
                }
                $messages[$requestName.'.in'] = "{$item->value} n'est pas une valeur valide pour {$item->label}.";
            }
            // else if($item->type == EntityType::STRING && $item->isFile){
            //     if($item->value != null || $item->isNullable)
            //         $rule = 'bail|file';
            //     else {
            //         $rule = 'bail|required|file';
            //         $isRequiredType = true;
            //     }
            //     $messages[$requestName.'.file'] = "Le champ {$item->label} n'a pas un format de fichier valide.";
            // }
            else if($item->type == EntityType::EMAIL){
                if($item->value != null || $item->isNullable)
                    $rule = 'bail|email';
                else {
                    $rule = 'bail|required|email';
                    $isRequiredType = true;
                }
                $messages[$requestName.'.email'] = "{$item->value} n'est pas une adresse e-mail valide pour {$item->label}.";
            }

            if($isRequiredType){
                $messages[$requestName.'.required'] = "Le champ {$item->label} est obligatoire.";
            }
            $rules[$requestName] = $rule;
        }

        return new CustomValidator(rules: $rules, messages: $messages);
    }

    public function queryAfterSeach(Request $request, Builder $query)
    {
        return $query;
    }

    public function getStoringData(Request $request, array $keys = []): array
    {
        $data = array();
        foreach($this->items as $item){
            $requestName = $this->prefix ."". $item->name;
            if(!$request->has($requestName) &&
                !array_key_exists($item->name, $keys)) continue;

            if($item->isFile && FileSystemService::isFile($request, $item->name)){
                $fileName = FileSystemService::buildName($request, $item->name, Constant::PROFILE_IMAGE);
                FileSystemService::save($request, $item->name, $fileName);
                $data[$item->name] = $fileName;
            }
            else if($request->has($requestName)){
                $data[$item->name] = $request->input($requestName);
            }
            else{
                $data[$item->name] = $keys[$item->name];
            }
        }
        return $data;
    }

    public function jamModel(Request $request, Model $model): Model
    {
        foreach($this->items as $item){
            $requestName = $this->prefix ."". $item->name;
            if(!$request->has($requestName)) continue;
            // if($item->isFile){
            //     $result = $this->updateFile($request->input($requestName));
            //     $model[$item->name] = $result->fileName;
            // }
            // else{
            //     $model[$item->name] = $request->input($requestName) ?? $model[$item->name];
            // }
            $model[$item->name] = $request->input($requestName) ?? $model[$item->name];
        }
        return $model;
    }

    public function fillableProperties(): array
    {
        $properties = [];
        foreach($this->items as $item){
            $properties[] = $item->name;
        }
        return $properties;
    }

    public function setPrefix(string $value): void
    {
        $this->prefix = $value;
    }
}
