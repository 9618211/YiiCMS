<?php
/**
 * SettingsForm class.
 * SettingsForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SettingsForm extends CFormModel
{
    private static $_instance;
	public $language;
    public $site_name;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
            array('site_name, language', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'site_name'=>Yii::t('settings', 'Site Name'),
            'language'=>Yii::t('settings', 'Language'),
		);
	}

    /**
     * Load settings
     */
    public static function load($category='common')
    {
        if (is_null(self::$_instance) || !isset(self::$_instance)) {
            self::$_instance = new self();
        }

        $settings = Yii::app()->settings->get($category);
        foreach($settings as $k=>$v) {
            self::$_instance->$k = $v;
        }

        return self::$_instance;
    }

    /**
     * Save Settings
     */
    public function save()
    {
        Yii::app()->settings->set('common', 'site_name', $this->site_name);
        Yii::app()->settings->set('common', 'language', $this->language);

        Yii::app()->language = Yii::app()->settings->get('common', 'language');
        Yii::app()->user->setFlash('success', Yii::t('settings', 'Settings has been saved.'));
    }
}
