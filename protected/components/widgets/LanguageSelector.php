<?php
class LanguageSelector extends CWidget
{
    public function run()
    {
        $currentLang = Yii::app()->language;
        $languages = Yii::app()->params->languages;
        $this->render('application.components.widgets.views.languageSelector', array('currentLang' => $currentLang, 'languages'=>$languages));
    }
}
?>