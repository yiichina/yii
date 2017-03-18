<?php
/**
 * CHttpException class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CHttpException 表示由终端用户的非法操作异常。
 *
 * The HTTP error code can be obtained via {@link statusCode}.
 * Error handlers may use this status code to decide how to format the error page.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.base
 * @since 1.0
 */
class CHttpException extends CException
{
	/**
	 * @var integer HTTP 状态码，比如 403，404，500，等等。
	 */
	public $statusCode;

	/**
	 * 构造器
	 * @param integer $status HTTP 状态码，比如 403，404，500，等等。
	 * @param string $message 错误信息
	 * @param integer $code 错误代码
	 */
	public function __construct($status,$message=null,$code=0)
	{
		$this->statusCode=$status;
		parent::__construct($message,$code);
	}
}
