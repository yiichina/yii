<?php
/**
 * CErrorEvent class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CErrorEvent 表示 {@link CApplication::onError onError} 参数的事件。
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.base
 * @since 1.0
 */
class CErrorEvent extends CEvent
{
	/**
	 * @var string 错误代码
	 */
	public $code;
	/**
	 * @var string 错误信息
	 */
	public $message;
	/**
	 * @var string 错误文件
	 */
	public $file;
	/**
	 * @var string 错误行号
	 */
	public $line;

	/**
	 * 构造器。
	 * @param mixed $sender 事件发起者
	 * @param string $code 错误代码
	 * @param string $message 错误信息
	 * @param string $file 错误文件
	 * @param integer $line 错误行号
	 */
	public function __construct($sender,$code,$message,$file,$line)
	{
		$this->code=$code;
		$this->message=$message;
		$this->file=$file;
		$this->line=$line;
		parent::__construct($sender);
	}
}
