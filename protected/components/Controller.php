<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='/layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    /**
     * RBAC based common access checking method
     * @param string  $operations The operation names created by authManager
     * @param array   $params     Parameters used by CWebUser::checkAccess()
     * @param string  $msg        Message to be thrown in the exception
     **/
    protected function checkAccess($operations, $params=null, $msg=null)
    {
        $checkAnd = true;
        $opers = array($operations);
        if (strstr($operations, '&')) {
            $opers = explode('&', $operations);
        }
        if (strstr($operations, '|')) {
            $opers = explode('|', $operations);
            $checkAnd = false;
        }

        if ($msg===null)
            $msg = Yii::t("yii", "You are not authorized to perform this action.");

        foreach ($opers as $operation) {
            if (!Yii::app()->user->checkAccess($operation, $params)) {
                // Throw exception on the first checking failure when operations have an AND relation
                if ($checkAnd === true) {
                    throw new CHttpException(403, $msg);
                }
            } else {
                // Pass checking on the first checking success when operations have an OR relation
                if ($checkAnd === false) {
                    return;
                }
            }
        }
        // Throw exception when all checkings failed and operations have an OR relation
        if ($checkAnd === false) {
            throw new CHttpException(403, $msg);
        }
    }
}
