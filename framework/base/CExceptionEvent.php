<?php
/**
 * CExceptionEvent class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CExceptionEvent 表示 {@link CApplication::onException onException} 参数的事件。
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.base
 * @since 1.0
 */
class CExceptionEvent extends CEvent
{
	/**
	 * @var CException 关于这个事件的异常
	 */
	public $exception;

	/**
	 * 构造器。
	 * @param mixed $sender 事件的发起者
	 * @param CException $exception 异常
	 */
	public function __construct($sender,$exception)
	{
		$this->exception=$exception;
		parent::__construct($sender);
	}
}