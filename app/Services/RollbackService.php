<?php

namespace App\Services;

use App\Classes\Constant;
use Exception;


class RollbackService
{
    private static array $rolls = [];

    public static function save(string $action, string $objectCode, mixed $value): void
    {
        self::$rolls[] = new Rollback($action, $objectCode, $value);
    }
    
    public static function reset(): void
    {
        deleteModels();
        deleteFiles();
        restoreModels();
        restoreFiles();
    }
    
    private static function deleteModels(): void
    {
        foreach(self::$rolls as $roll){
            if($roll->action != RollbackEnum::SAVE_MODEL) continue;
            $id = $roll->value;
            if($roll->objectCode == RollbackEnum::BANK){
                Bank::destroy($id);
            }
            else if($roll->objectCode == RollbackEnum::APPLICANT){
                Applicant::destroy($id);
            }
            else if($roll->objectCode == RollbackEnum::APPLICANT){
                Entitled::destroy($id);
            }
            else if($roll->objectCode == RollbackEnum::OLDESS_PENSION){
                OldessPension::destroy($id);
            }
            else if($roll->objectCode == RollbackEnum::INVALIDITY_PENSION){
                InvalidityPension::destroy($id);
            }
            else if($roll->objectCode == RollbackEnum::ANTICIPED_PENSION){
                AnticipedPension::destroy($id);
            }
            else if($roll->objectCode == RollbackEnum::SURVIVOR_PENSION){
                SurvivorPension::destroy($id);
            }
            else if($roll->objectCode == RollbackEnum::PASSPORT_REQUEST){
                PassportRequest::destroy($id);
            }
        }
    }
    
    private static function deleteFiles(): void
    {
        foreach(self::$rolls as $roll){
            if($roll->action != RollbackEnum::SAVE_FILE) continue;
            $fillPath = $roll->value;
            FileSystemService::delete($fillPath);
        }
    }
    
    private static function restoreModels(): void
    {
        foreach(self::$rolls as $roll){
            if($roll->action != RollbackEnum::UPDATE_MODEL) continue;
            $sender = $roll->value; //de type UpdateModelSender
            $id = $sender->id;
            $oldModel = $sender->value;
            if($roll->objectCode == RollbackEnum::BANK){
                $model = Bank::find($id);
                $model = (new BankConstraint())->updatingData($model, $oldModel);
                $model->save();
            }
            else if($roll->objectCode == RollbackEnum::APPLICANT){
                $model = Applicant::find($id);
                $model = (new ApplicantConstraint())->updatingData($model, $oldModel);
                $model->save();
            }
            else if($roll->objectCode == RollbackEnum::APPLICANT){
                $model = Entitled::find($id);
                $model = (new EntitledConstraint())->updatingData($model, $oldModel);
                $model->save();
            }
            else if($roll->objectCode == RollbackEnum::OLDESS_PENSION){
                $model = OldessPension::find($id);
                $model = (new OldessPensionConstraint())->updatingData($model, $oldModel);
                $model->save();
            }
            else if($roll->objectCode == RollbackEnum::INVALIDITY_PENSION){
                $model = InvalidityPension::find($id);
                $model = (new InvalidityPensionConstraint())->updatingData($model, $oldModel);
                $model->save();
            }
            else if($roll->objectCode == RollbackEnum::ANTICIPED_PENSION){
                $model = AnticipedPension::find($id);
                $model = (new AnticipedPensionConstraint())->updatingData($model, $oldModel);
                $model->save();
            }
            else if($roll->objectCode == RollbackEnum::SURVIVOR_PENSION){
                $model = SurvivorPension::find($id);
                $model = (new SurvivorPensionConstraint())->updatingData($model, $oldModel);
                $model->save();
            }
            else if($roll->objectCode == RollbackEnum::PASSPORT_REQUEST){
                $model = PassportRequest::find($id);
                $model = (new PassportRequestConstraint())->updatingData($model, $oldModel);
                $model->save();
            }
        }
    }
    
    private static function restoreFiles(): void
    {
        foreach(self::$rolls as $roll){
            if($roll->action != RollbackEnum::UPDATE_FILE) continue;
            $sender = $roll->value; //de type UpdateFileSender
            $oldFillPath = $sender->oldFillPath;
            $currentFillPath = $sender->currentFillPath;
            // FileSystemService::delete($fillPath);
            // FileSystemService::delete($fillPath);
        }
    }
}