<?php
/**
 * 
 **/
abstract class ArtActiveRecord extends CActiveRecord
{
    protected function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->create_time = $this->update_time = new CDbExpression('NOW()');
            $this->create_user_id = $this->update_user_id = Yii::app()->user->id;
        } else {
            $this->update_time = new CDbExpression('NOW()');
            $this->update_user_id = Yii::app()->user->id;
        }

        return parent::beforeValidate();
    }

    /**
     * Check if the current model is in one of the given scenarios
     * @param string $scenes the scenarios list, seperated by ","
     **/
    public function inScenarios($scenes)
    {
        $tmparr = array();
        foreach (explode(',', $scenes) as $scene) {
            $tmparr[] = trim($scene);
        }
        return in_array($this->getScenario(), $tmparr);
    }
}
